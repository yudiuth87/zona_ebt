@extends('layouts.master')
@section('title', 'Lokasi Carbon Offset')
@push('styles')
<style>
.offset-container {
  max-width: 600px;
  margin: 32px auto;
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.07);
  padding: 32px 24px 24px 24px;
}
.offset-title {
  font-size: 22px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 8px;
}
.offset-subtitle {
  text-align: center;
  color: #888;
  font-size: 15px;
  margin-bottom: 24px;
}
.offset-summary, .offset-detail {
  background: #fff;
  border: 1.5px solid #EAEAEA;
  border-radius: 12px;
  padding: 18px 20px 10px 20px;
  margin-bottom: 18px;
}
.offset-summary-title, .offset-detail-title {
  font-weight: 700;
  font-size: 16px;
  margin-bottom: 10px;
}
.offset-table {
  width: 100%;
  font-size: 15px;
  margin-bottom: 0;
}
.offset-table td {
  padding: 4px 0;
  color: #222;
}
.offset-table td:first-child {
  color: #888;
  width: 48%;
}
.offset-total {
  text-align: center;
  font-size: 18px;
  font-weight: 700;
  margin: 24px 0 18px 0;
}
.offset-btn {
  display: block;
  width: 100%;
  background: #7AC142;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 14px 0;
  font-size: 16px;
  font-weight: 700;
  margin-top: 10px;
  cursor: pointer;
  transition: background 0.2s;
}
.offset-btn:hover {
  background: #6bb13b;
}
</style>
@endpush
@section('content')
<div class="offset-container">
  <div class="offset-title">Lokasi Offset</div>
  <div class="offset-total">Total Emisi : {{ number_format($total_emisi ?? 0, 2, ',', '.') }} Kg CO2</div>
  <div class="offset-summary">
    <div class="offset-summary-title">Ringkasan Emisi Anda</div>
    <table class="offset-table">
      <tr><td>Jenis Kendaraan</td><td>{{ $jenis_kendaraan ?? '-' }}</td></tr>
      <tr><td>Jarak Tempuh</td><td>{{ isset($jarak) ? $jarak . ' KM' : '-' }}</td></tr>
      <tr><td>Jumlah Orang</td><td>{{ $penumpang ?? '-' }}</td></tr>
      <tr><td>Frekuensi</td><td>{{ $frekuensi ?? '-' }}</td></tr>
      <tr><td>Bahan Bakar</td><td>{{ $bahan_bakar ?? '-' }}</td></tr>
    </table>
  </div>
  <div class="offset-detail">
    <div class="offset-detail-title">Detail Offset Emisi Anda</div>
    <table class="offset-table">
      <tr><td>Lokasi Penanaman</td><td>Proyek Mangrove di Teluk Benoa Bali</td></tr>
      <tr><td>Jenis Kegiatan Offset</td><td>Menanam Pohon</td></tr>
      <tr><td>Jenis Pohon</td><td>Mangrove</td></tr>
      <tr><td>Total Emisi</td><td>{{ number_format($total_emisi ?? 0, 2, ',', '.') }} Kg CO2</td></tr>
      <tr><td>Estimasi Biaya</td><td>Rp. {{ number_format($biaya_offset ?? 0, 0, ',', '.') }}</td></tr>
    </table>
  </div>
  <button class="offset-btn">Tebus Sekarang</button>
</div>
@endsection 