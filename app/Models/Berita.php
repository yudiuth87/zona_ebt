<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Berita.php
class Berita extends Model
{
    protected $fillable = ['judul', 'isi', 'gambar'];
}
