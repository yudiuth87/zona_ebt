@extends('layouts.master')
@section('title', 'Tentang')
@section('content')

<style>
    body {
        background: linear-gradient(to bottom, #82d7e9, #d0f0f8);
        font-family: 'Segoe UI', sans-serif;
    }

    .tentang-container {
        max-width: 900px;
        margin: 50px auto;
        background-color: #ffffffd0;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 4px 4px 15px rgba(0,0,0,0.2);
    }

    .tentang-container h1 {
        font-size: 30px;
        text-align: center;
        color: #004d66;
        margin-bottom: 20px;
        border-bottom: 2px solid #0077a3;
        padding-bottom: 10px;
    }

    .tentang-container p {
        font-size: 16px;
        color: #333;
        line-height: 1.7;
        text-align: justify;
    }

    @media (max-width: 768px) {
        .tentang-container {
            margin: 20px;
            padding: 20px;
        }

        .tentang-container h1 {
            font-size: 24px;
        }

        .tentang-container p {
            font-size: 15px;
        }
    }
</style>

<div class="tentang-container">
    <h1>Tentang PPSDM</h1>
    <p>
        {!! $tentang->isi ?? 'Data tentang belum tersedia.' !!}
    </p>
</div>

@endsection
