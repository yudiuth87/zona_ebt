<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function showToPublic()
    {
        $beritas = Berita::latest()->get();
        return view('berita', compact('beritas')); // file berita.blade.php di root
    }
}
