@extends('layouts.master')
@section('title', 'Ringkasan Pesan')

@push('styles')
<style>
.payment-container {
  max-width: 600px;
  margin: 40px auto;
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
  padding: 32px 24px;
}

.payment-header h2 {
  font-size: 22px;
  font-weight: 700;
}

.payment-header .invoice {
  color: #555;
  margin-top: 4px;
}

.payment-body {
  display: flex;
  gap: 16px;
  margin: 24px 0;
}

.payment-body img {
  width: 80px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
}

.payment-desc .title {
  font-size: 14px;
  font-weight: 600;
}

.payment-desc p {
  margin: 4px 0;
}

.payment-desc .co2 {
  color: #7AC142;
  font-weight: 600;
}

.payment-footer {
  border-top: 1px solid #eee;
  padding-top: 20px;
}

.payment-footer .line-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 12px;
}

.payment-footer .total {
  font-weight: 700;
  font-size: 18px;
}

.pay-btn {
  display: block;
  width: 100%;
  background: #7AC142;
  color: #fff;
  border: none;
  border-radius: 12px;
  padding: 14px 0;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.2s;
  margin-top: 16px;
}

.pay-btn:hover {
  background: #6bb13b;
}
</style>
@endpush

@section('content')
<div class="payment-container">
  <div class="payment-header">
    <h2>Ringkasan Pesan</h2>
    <div class="invoice">Invoice #: {{ $invoice_number }}</div>
  </div>
  <div class="payment-body">
    <img src="{{ $project_image }}" alt="{{ $project_name }}">
    <div class="payment-desc">
      <div class="title">{{ $project_name }}</div>
      <p>{{ $description }}</p>
      <p class="co2">{{ $co2 }}</p>
      <p><i class="bx bx-gas-pump"></i> {{ $fuel }}</p>
      <p><i class="bx bx-calendar"></i> Pay before: {{ $due_date }}</p>
    </div>
  </div>
  <div class="payment-footer">
    <div class="line-item">
      <span>1 × Rp {{ number_format($amount,0,',','.') }}</span>
      <span>Rp {{ number_format($amount,0,',','.') }}</span>
    </div>
    <div class="line-item">
      <span>Subtotal :</span>
      <span>Rp {{ number_format($amount,0,',','.') }}</span>
    </div>
    <div class="line-item total">
      <span>Total yang harus dibayar:</span>
      <span>Rp {{ number_format($amount,0,',','.') }}</span>
    </div>
    <form method="POST" action="{{ route('bayar.offset') }}">
      @csrf
      <button type="submit" class="pay-btn">Konfirmasi & Bayar</button>
    </form>
  </div>
</div>
@endsection