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

    public function showConfirmation(Request $request)
    {
        $form = session('form_data', []);
        $offset = session('offset_data', []);
        
        // Langsung gunakan form_data
        $lokasi = $form['lokasi_terpilih'];
        $gambar = asset($form['lokasi_gambar']);
        $fuel = $form['bahan_bakar'];
        $totalEmisi = $form['total_emisi'] ?? 0;
        $biayaOffset = $form['biaya_offset'] ?? 0;
        
        $data = [
            'invoice_number' => 'ZEBT-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
            'project_image' => $gambar,
            'project_name' => "Penanaman Pohon Mangrove – {$lokasi}",
            'description' => "Donasi Tebus Emisi Karbon – Penanaman Pohon Mangrove di {$lokasi}, Bali.",
            'co2' => number_format($totalEmisi, 2, ',', '.') . ' Kg CO₂',
            'fuel' => $fuel,
            'due_date' => now()->addDays(7)->format('F j, Y \\a\\t H:i A'),
            'amount' => $biayaOffset,
        ];
        
        return view('confirmation', $data);
    }
}
