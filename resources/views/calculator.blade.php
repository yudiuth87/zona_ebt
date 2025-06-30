@extends('layouts.master')

@section('title', 'Kalkulator Karbon')

@push('styles')
<style>
/* Wrapper putih */
.calculator-wrapper {
  background-color: #fff;
  /* latar putih */
  padding: 40px;
  /* ruang dalam */
  border-radius: 12px;
  /* sudut melengkung */
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  /* bayangan halus */

  /* optional: batas lebar */
  /* margin: 40px auto; */
  /* center dan ruang atas/bawah */
  max-width: full-width;
}

.calculator-container {
  text-align: center;
  padding: 0;
  /* padding sudah diambil kalkulator-wrapper */
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
<div class="calculator-wrapper">
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
</div>
@endsection