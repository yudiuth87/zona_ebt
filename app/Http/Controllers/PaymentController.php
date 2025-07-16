<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        require_once base_path('vendor/autoload.php');
        Xendit::setApiKey(env('XENDIT_API_KEY'));

        $params = [
            'external_id' => 'order-' . uniqid(),
            'payer_email' => $request->email ?? 'user@email.com',
            'description' => 'Pembayaran Offset Karbon',
            'amount' => $request->amount ?? 50000,
            'success_redirect_url' => url('/offset?success=1'),
            'failure_redirect_url' => url('/offset?failed=1'),
        ];

        $invoice = \Xendit\Invoice::create($params);

        return response()->json(['invoice_url' => $invoice['invoice_url']]);
    }
} 