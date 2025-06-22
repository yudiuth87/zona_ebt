<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTentangController;

//route yang kita pake
Route::get('/', fn() => view('beranda'))->name('beranda');
Route::get('/kalkulator', fn() => view('calculator'))->name('kalkulator');
Route::get('/tentang', [PublicTentangController::class, 'index'])->name('tentang');

// Kalkulator routes
Route::get('/kalkulator/transportasi-darat', fn() => view('kalkulator.transportasi-darat'))->name('transportasi-darat');
Route::get('/kalkulator/transportasi-udara', fn() => view('kalkulator.transportasi-udara'))->name('transportasi-udara');
Route::get('/kalkulator/transportasi-laut', fn() => view('kalkulator.transportasi-laut'))->name('transportasi-laut');
Route::get('/kalkulator/peralatan-rumah-tangga', fn() => view('kalkulator.peralatan-rumah-tangga'))->name('peralatan-rumah-tangga');
