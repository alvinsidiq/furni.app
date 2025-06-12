<?php

namespace App\Http\Controllers;

use App\Models\Furnitures;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected $xenditService;

    public function __construct(XenditService $xenditService)
    {
        $this->middleware('auth');
        $this->xenditService = $xenditService;
    }

    public function index()
    {
        $cart = session('cart', []);
        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $item) {
            $furniture = Furnitures::find($item['id']);
            if ($furniture) {
                $total = $furniture->price * $item['quantity'];
                $cartItems[] = [
                    'name' => $furniture->name,
                    'quantity' => $item['quantity'],
                    'total' => $total,
                    'price' => $furniture->price,
                ];
                $subtotal += $total;
            }
        }

        return view('checkout.index', compact('cartItems', 'subtotal'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'c_email' => 'required|email',
            'c_fname' => 'required|string|max:255',
            'c_lname' => 'nullable|string|max:255',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        try {
            DB::beginTransaction();

            // Prepare cart items and calculate total
            $cartItems = [];
            $totalAmount = 0;

            foreach ($cart as $item) {
                $furniture = Furnitures::find($item['id']);
                if ($furniture) {
                    $cartItems[] = [
                        'furniture_id' => $furniture->id,
                        'quantity' => $item['quantity'],
                        'price' => $furniture->price,
                    ];
                    $totalAmount += $furniture->price * $item['quantity'];
                }
            }

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_status' => 'pending'
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'furniture_id' => $item['furniture_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Prepare customer data for Xendit
            $customerData = [
                'first_name' => $request->c_fname,
                'last_name' => $request->c_lname,
                'email' => $request->c_email,
            ];

            // Create Xendit invoice
            $invoice = $this->xenditService->createInvoice($order, $customerData);

            DB::commit();

            // Clear cart
            session()->forget('cart');

            // Redirect to Xendit payment page
            return redirect($invoice['invoice_url']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Process Error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan dalam proses pembayaran: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function failed()
    {
        return view('checkout.failed');
    }

    public function checkPaymentStatus($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            
            if ($order->user_id !== auth()->id()) {
                abort(403);
            }

            if ($order->xendit_invoice_id) {
                $invoice = $this->xenditService->getInvoice($order->xendit_invoice_id);
                
                if ($invoice) {
                    // Update order status based on current invoice status
                    switch ($invoice['status']) {
                        case 'PAID':
                            $order->update([
                                'payment_status' => 'paid',
                                'status' => 'processing',
                                'paid_at' => now()
                            ]);
                            break;
                        case 'EXPIRED':
                            $order->update([
                                'payment_status' => 'expired',
                                'status' => 'cancelled'
                            ]);
                            break;
                    }
                }
            }

            return response()->json([
                'status' => $order->payment_status,
                'order_status' => $order->status
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memeriksa status pembayaran'], 500);
        }
    }
}