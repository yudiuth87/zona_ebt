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

.back-btn {
  display: inline-flex;
  align-items: center;
  color: #666;
  text-decoration: none;
  font-size: 14px;
  margin-bottom: 24px;
  padding: 8px 0;
  transition: color 0.2s;
}

.back-btn:hover {
  color: #333;
}

.back-btn svg {
  width: 16px;
  height: 16px;
  margin-right: 8px;
}

.payment-header h2 {
  font-size: 22px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 8px;
}

.payment-header .invoice {
  color: #555;
  margin-top: 4px;
  text-align: center;
  margin-bottom: 24px;
}

/* New section for vehicle list */
.vehicle-summary-list {
  background: #f8f8f8;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 20px;
  border: 1px solid #e0e0e0;
}

.vehicle-summary-list h3 {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 16px;
  color: #222;
  text-align: center;
}

.vehicle-summary-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid #f0f0f0;
}

.vehicle-summary-item:last-child {
  border-bottom: none;
}

.vehicle-item-icon {
  width: 40px;
  height: 40px;
  background: #e8f5e8; /* Light green background */
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}

.vehicle-item-details {
  flex: 1;
}

.vehicle-item-name {
  font-size: 14px;
  font-weight: 600;
  color: #222;
  margin-bottom: 2px;
}

.vehicle-item-location {
  font-size: 13px;
  color: #666;
}

.vehicle-item-emission {
  text-align: right;
  font-size: 14px;
  font-weight: 600;
  color: #4CAF50;
  flex-shrink: 0;
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

@media (max-width: 768px) {
  .payment-container {
    margin: 20px;
    padding: 24px 16px;
  }
  .vehicle-summary-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }
  .vehicle-item-emission {
    width: 100%;
    text-align: left;
  }
}
</style>
@endpush

@section('content')
<div class="payment-container">
  <!-- Back Button -->
  <a href="/form-data-diri" class="back-btn">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
    Kembali ke Form Data Diri
  </a>

  <div class="payment-header">
    <h2>Ringkasan Pesan</h2>
    <div class="invoice">Invoice #: {{ $invoice_number }}</div>
  </div>

  <!-- Vehicle Summary List -->
  <div class="vehicle-summary-list">
    <h3>Detail Emisi per Kendaraan/Peralatan</h3>
    @if (!empty($vehicles_details))
      @foreach ($vehicles_details as $vehicle)
        <div class="vehicle-summary-item">
          <div class="vehicle-item-icon">
            @php
              $icon = '';
              $transportType = $vehicle['jenis'] ?? '';
              $vehicleType = $vehicle['jenis_kendaraan'] ?? '';
              $transportIcons = [
                'darat' => ['Mobil' => '🚗', 'Motor' => '🏍️', 'Bus' => '🚌', 'Kereta' => '🚆'],
                'laut' => ['Kapal Penumpang' => '⛴️', 'Kapal Barang' => '🚢'],
                'udara' => ['Pesawat Komersil' => '✈️'],
                'rumah' => ['AC' => '❄️', 'Kulkas' => '🧊', 'Lampu' => '💡', 'Mesin Cuci' => '🧺']
              ];
              if (isset($transportIcons[$transportType][$vehicleType])) {
                $icon = $transportIcons[$transportType][$vehicleType];
              } else {
                $icon = '❓'; // Default icon if not found
              }
            @endphp
            {{ $icon }}
          </div>
          <div class="vehicle-item-details">
            <div class="vehicle-item-name">{{ $vehicle['jenis_kendaraan'] }} - {{ $vehicle['bahan_bakar'] }}</div>
            <div class="vehicle-item-location">Lokasi: {{ $vehicle['selected_location']['nama'] ?? 'Belum dipilih' }}</div>
          </div>
          <div class="vehicle-item-emission">{{ number_format($vehicle['emisi'] ?? 0, 2, ',', '.') }} kg CO₂</div>
        </div>
      @endforeach
    @else
      <p style="text-align: center; color: #888;">Tidak ada detail kendaraan yang tersedia.</p>
    @endif
  </div>

  <div class="payment-footer">
    <div class="line-item">
      <span>Total Emisi Keseluruhan:</span>
      <span>{{ $co2 }}</span>
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
