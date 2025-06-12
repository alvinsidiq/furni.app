<?php

namespace App\Http\Controllers;

use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class XenditWebhookController extends Controller
{
    protected $xenditService;

    public function __construct(XenditService $xenditService)
    {
        $this->xenditService = $xenditService;
    }

    public function handleInvoice(Request $request)
    {
        try {
            // Verify webhook token (optional but recommended)
            $webhookToken = $request->header('x-callback-token');
            if ($webhookToken !== config('services.xendit.webhook_token')) {
                Log::warning('Invalid webhook token received');
                return response('Unauthorized', 401);
            }

            $payload = $request->all();
            
            Log::info('Xendit Invoice Webhook Received', $payload);

            // Handle the webhook
            $result = $this->xenditService->handleWebhook($payload);

            if ($result) {
                return response('OK', 200);
            } else {
                return response('Failed to process webhook', 400);
            }

        } catch (\Exception $e) {
            Log::error('Xendit Webhook Processing Error: ' . $e->getMessage());
            return response('Internal Server Error', 500);
        }
    }
}