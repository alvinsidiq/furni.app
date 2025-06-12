<?php

namespace App\Services;

use Xendit\Xendit;
use Xendit\Invoice;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class XenditService
{
    public function __construct()
    {
        Xendit::setApiKey(config('services.xendit.secret_key'));
    }

    public function createInvoice(Order $order, array $customerData)
    {
        try {
            $params = [
                'external_id' => 'order-' . $order->id . '-' . time(),
                'amount' => $order->total_amount,
                'description' => 'Pembayaran untuk Order #' . $order->id,
                'invoice_duration' => 86400, // 24 hours
                'customer' => [
                    'given_names' => $customerData['first_name'],
                    'surname' => $customerData['last_name'] ?? '',
                    'email' => $customerData['email'],
                ],
                'customer_notification_preference' => [
                    'invoice_created' => ['email'],
                    'invoice_reminder' => ['email'],
                    'invoice_paid' => ['email'],
                    'invoice_expired' => ['email']
                ],
                'success_redirect_url' => route('checkout.success'),
                'failure_redirect_url' => route('checkout.failed'),
                'currency' => 'IDR',
                'items' => $this->getOrderItems($order)
            ];

            $invoice = Invoice::create($params);

            // Update order dengan data invoice
            $order->update([
                'xendit_invoice_id' => $invoice['id'],
                'xendit_invoice_url' => $invoice['invoice_url'],
                'payment_status' => 'pending'
            ]);

            return $invoice;

        } catch (\Exception $e) {
            Log::error('Xendit Invoice Creation Error: ' . $e->getMessage());
            throw new \Exception('Gagal membuat invoice pembayaran: ' . $e->getMessage());
        }
    }

    private function getOrderItems(Order $order)
    {
        $items = [];
        foreach ($order->orderItems as $item) {
            $items[] = [
                'name' => $item->furniture->name ?? 'Produk',
                'quantity' => $item->quantity,
                'price' => $item->price,
                'category' => 'Furniture'
            ];
        }
        return $items;
    }

    public function getInvoice($invoiceId)
    {
        try {
            return Invoice::retrieve($invoiceId);
        } catch (\Exception $e) {
            Log::error('Xendit Get Invoice Error: ' . $e->getMessage());
            return null;
        }
    }

    public function handleWebhook($payload)
    {
        try {
            $invoiceId = $payload['id'];
            $status = $payload['status'];
            $externalId = $payload['external_id'];

            // Extract order ID from external_id (format: order-{id}-{timestamp})
            preg_match('/order-(\d+)-/', $externalId, $matches);
            if (!isset($matches[1])) {
                throw new \Exception('Invalid external_id format');
            }

            $orderId = $matches[1];
            $order = Order::find($orderId);

            if (!$order) {
                throw new \Exception('Order not found');
            }

            // Update order status based on invoice status
            switch ($status) {
                case 'PAID':
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing',
                        'paid_at' => now(),
                        'payment_method' => $payload['payment_method'] ?? null
                    ]);
                    break;

                case 'EXPIRED':
                    $order->update([
                        'payment_status' => 'expired',
                        'status' => 'cancelled'
                    ]);
                    break;

                case 'FAILED':
                    $order->update([
                        'payment_status' => 'failed',
                        'status' => 'cancelled'
                    ]);
                    break;
            }

            return true;

        } catch (\Exception $e) {
            Log::error('Xendit Webhook Error: ' . $e->getMessage());
            return false;
        }
    }
}