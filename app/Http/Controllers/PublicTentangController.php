<?php

namespace App\Http\Controllers;

use App\Models\Tentang;

class PublicTentangController extends Controller
{
    public function index()
    {
        $tentang = Tentang::first(); // Ambil satu record karena hanya ada satu isi
        return view('tentang', compact('tentang'));
    }
}
