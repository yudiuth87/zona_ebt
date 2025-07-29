<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTentangController;
use App\Http\Controllers\OffsetController;
use App\Http\Controllers\PaymentController;

//route yang kita pake
Route::get('/', fn() => view('beranda'))->name('beranda');
Route::get('/kalkulator', fn() => view('calculator'))->name('kalkulator');
Route::get('/tentang', [PublicTentangController::class, 'index'])->name('tentang');
// Offset routes - gunakan controller
Route::get('/offset', [OffsetController::class, 'show'])->name('offset');
Route::post('/offset/calculate', [OffsetController::class, 'calculate'])->name('offset.calculate');

// Form data diri routes - gunakan controller
Route::get('/form-data-diri', [OffsetController::class, 'showFormDataDiri'])->name('form-data-diri');
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