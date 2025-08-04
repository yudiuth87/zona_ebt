<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTentangController;
use App\Http\Controllers\OffsetController;
use App\Http\Controllers\PaymentController;

// Route yang kita pake
Route::get('/', function () {
    $cards = [
        [
            'judul' => 'Reforestasi Hutan',
            'lokasi' => 'Sumatera',
            'gambar' => 'Reforestasi.jpeg',
            'deskripsi' => 'Proyek ini bertujuan untuk memulihkan hutan tropis di wilayah Sumatera dengan penanaman pohon dan konservasi tanah untuk menyerap emisi karbon secara alami.',
        ],
        [
            'judul' => 'Pengelolaan Lahan Berkelanjutan',
            'lokasi' => 'Jawa Barat',
            'gambar' => 'Pengelolaan Lahan.jpeg',
            'deskripsi' => 'Program ini mengoptimalkan penggunaan lahan pertanian dengan teknik ramah lingkungan seperti pertanian organik, rotasi tanaman, dan konservasi air untuk menyerap karbon.',
        ],
        [
            'judul' => 'Proyek Energi Terbarukan',
            'lokasi' => 'NTT',
            'gambar' => 'Energi Terbarukan.jpeg',
            'deskripsi' => 'Proyek ini menyediakan solusi energi bersih seperti tenaga surya dan angin untuk menggantikan bahan bakar fosil dan mengurangi emisi karbon.',
        ],
    ];
    return view('beranda', compact('cards')); // Pastikan 'cards' dilewatkan ke view
})->name('beranda');

Route::get('/kalkulator', fn() => view('calculator'))->name('kalkulator');
Route::get('/tentang', [PublicTentangController::class, 'index'])->name('tentang');

// Debug route untuk test
Route::get('/debug-session', function() {
    return response()->json([
        'session_id' => session()->getId(),
        'session_data' => session()->all(),
        'offset_data' => session('offset_data'),
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version()
    ]);
});

// Test route untuk cek server
Route::post('/test-server', function(\Illuminate\Http\Request $request) {
    \Log::info('Test server request:', $request->all());
    
    return response()->json([
        'success' => true,
        'message' => 'Server working fine',
        'received_data' => $request->all(),
        'timestamp' => now()->toISOString()
    ]);
});

// Offset routes - gunakan controller
Route::get('/offset', [OffsetController::class, 'show'])->name('offset');
Route::post('/offset/calculate', [OffsetController::class, 'calculate'])->name('offset.calculate');

// Form data diri routes - gunakan controller
Route::get('/form-data-diri', [OffsetController::class, 'showFormDataDiri'])->name('form-data-diri');
Route::post('/form-data-diri', [OffsetController::class, 'showFormDataDiri'])->name('form-data-diri.post');
Route::post('/submit-data-diri', [OffsetController::class, 'submitDataDiri'])
    ->name('submit-data-diri');

// Payment route
Route::post('/bayar-offset', [PaymentController::class, 'pay'])->name('bayar.offset');

// setelah route bayar.offset
Route::get('/konfirmasi-pembayaran', [PaymentController::class, 'showConfirmation'])
    ->name('payment.confirmation');

// Kalkulator routes
Route::get('/kalkulator/transportasi-darat', fn() => view('kalkulator.transportasi-darat'))->name('transportasi-darat');
Route::get('/kalkulator/transportasi-udara', fn() => view('kalkulator.transportasi-udara'))->name('transportasi-udara');
Route::get('/kalkulator/transportasi-laut', fn() => view('kalkulator.transportasi-laut'))->name('transportasi-laut');
Route::get('/kalkulator/peralatan-rumah-tangga', fn() => view('kalkulator.peralatan-rumah-tangga'))->name('peralatan-rumah-tangga');
