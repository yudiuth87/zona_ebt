<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;
use Illuminate\Support\Facades\Log;

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
        $formData = $request->session()->get('form_data', []);
        $checkoutData = $request->session()->get('checkout_data', []); // Ambil data checkout lengkap

        $totalEmisi = $checkoutData['total_emission'] ?? 0;
        $biayaOffset = $checkoutData['total_cost'] ?? 0;
        $vehiclesDetails = $checkoutData['vehicles'] ?? []; // Ini adalah array kendaraan lengkap

        // Untuk ringkasan utama, kita bisa menggunakan lokasi/bahan bakar dari kendaraan pertama sebagai representasi
        $firstVehicle = $vehiclesDetails[0] ?? null;
        $representativeLocationName = $firstVehicle['selected_location']['nama'] ?? 'Proyek Mangrove di Teluk Benoa Bali';
        $representativeLocationImage = $firstVehicle['selected_location']['gambar'] ?? '/assets/images/lokasiCarbon/gambar-2.webp';
        $representativeFuel = $firstVehicle['bahan_bakar'] ?? 'Pertalite';

        $data = [
            'invoice_number' => 'ZEBT-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
            'project_image' => asset($representativeLocationImage),
            'project_name' => "Ringkasan Offset Karbon", // Judul lebih umum
            'description' => "Detail emisi dan lokasi offset untuk aktivitas Anda.", // Deskripsi lebih umum
            'co2' => number_format($totalEmisi, 2, ',', '.') . ' Kg CO₂',
            'fuel' => $representativeFuel, // Tetap representatif
            'due_date' => now()->addDays(7)->format('F j, Y \\a\\t H:i A'),
            'amount' => $biayaOffset,
            'vehicles_details' => $vehiclesDetails, // Kirim array kendaraan lengkap
        ];
        
        Log::info('Confirmation data:', $data);

        return view('confirmation', $data);
    }
}
