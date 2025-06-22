@extends('layouts.master')

@section('title', 'Kalkulator Karbon')

@push('styles')
<style>
    .calculator-container {
        text-align: center;
        padding: 40px 0;
    }
    .calculator-title {
        background-color: #FFFBEB;
        padding: 15px 30px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 50px;
    }
    .calculator-title h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #333;
    }
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        justify-items: center;
    }
    .category-card {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        transition: transform 0.3s;
    }
    .category-card:hover {
        transform: translateY(-5px);
    }
    .category-card img {
        width: 120px;
        height: 120px;
        object-fit: contain;
    }
    .category-card span {
        font-weight: 500;
        font-size: 16px;
    }
</style>
@endpush

@section('content')
<div class="calculator-container">
    <div class="calculator-title">
        <h1>Calculate Your Carbon!!</h1>
    </div>

    <div class="category-grid">
        <a href="{{ route('transportasi-darat') }}" class="category-card">
            <img src="{{ asset('assets/images/Roda.png') }}" alt="Transportasi Darat">
            <span>Transportasi Darat</span>
        </a>
        <a href="{{ route('transportasi-udara') }}" class="category-card">
            <img src="{{ asset('assets/images/Roda.png') }}" alt="Transportasi Udara">
            <span>Transportasi Udara</span>
        </a>
        <a href="{{ route('transportasi-laut') }}" class="category-card">
            <img src="{{ asset('assets/images/Roda.png') }}" alt="Transportasi Laut">
            <span>Transportasi Laut</span>
        </a>
        <a href="{{ route('peralatan-rumah-tangga') }}" class="category-card">
            <img src="{{ asset('assets/images/Roda.png') }}" alt="Peralatan Rumah Tangga">
            <span>Peralatan Rumah Tangga</span>
        </a>
    </div>
</div>
@endsection 