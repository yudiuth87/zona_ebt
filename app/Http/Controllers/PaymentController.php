<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Xendit;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
// GANTI SELURUH pay method yang ada di file Anda
public function pay(Request $request)
{
    try {
        // Ambil data dari kedua sesi yang relevan
        $formData = session('form_data');
        $checkoutData = session('checkout_data');

        if (!$formData || !$checkoutData) {
            return redirect()->route('offset')->with('error', 'Data diri atau rincian pembayaran tidak ditemukan. Silakan ulangi dari awal.');
        }

        // Load Xendit SDK
        require_once base_path('vendor/autoload.php');
        \Xendit\Xendit::setApiKey(env('XENDIT_API_KEY'));

        // Persiapkan parameter invoice
        $params = [
            'external_id' => 'order-' . uniqid(),
            'payer_email' => $formData['email'],
            'description' => 'Pembayaran Offset Karbon oleh ' . $formData['nama_lengkap'],
            'amount' => (int) $checkoutData['total_cost'], // FIX: Ambil dari checkoutData['total_cost']
            'success_redirect_url' => url('/offset?success=1'),
            'failure_redirect_url' => url('/offset?failed=1'),
            'customer' => [
                'given_names' => $formData['nama_lengkap'],
                'email' => $formData['email'],
                'mobile_number' => $formData['nomor_hp'],
            ],
            'customer_notification_preference' => [
                'invoice_created' => ['email'],
                'invoice_reminder' => ['email'],
                'invoice_paid' => ['email'],
                'invoice_expired' => ['email']
            ],
        ];

        $invoice = \Xendit\Invoice::create($params);
        return redirect($invoice['invoice_url']);

    } catch (\Exception $e) {
        \Log::error('Error in pay(): ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);

        return back()->with('error', 'Gagal membuat invoice pembayaran. Silakan coba lagi.');
    }
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
