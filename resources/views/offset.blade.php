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
  <div class="offset-title">Cari Lokasi Carbon Offsetmu</div>
  <div class="offset-subtitle">Pilih lokasi terbaik untuk melakukan aksi penanaman pohon sebagai upaya mengimbangi jejak karbon Anda. Setiap lokasi membawa dampak nyata bagi lingkungan.</div>
  <div style="margin-bottom:32px;">
    <input type="text" id="searchLokasi" placeholder="Cari Lokasi Penanaman" style="width:100%;padding:8px 12px;border-radius:8px;border:1.5px solid #EAEAEA;font-size:15px;margin-bottom:18px;">
    <div id="lokasiCards" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;"></div>
  </div>
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
      <tr><td>Lokasi Penanaman</td><td id="lokasiTerpilih">Proyek Mangrove di Teluk Benoa Bali</td></tr>
      <tr><td>Jenis Kegiatan Offset</td><td>Menanam Pohon</td></tr>
      <tr><td>Jenis Pohon</td><td>Mangrove</td></tr>
      <tr><td>Total Emisi</td><td>{{ number_format($total_emisi ?? 0, 2, ',', '.') }} Kg CO2</td></tr>
      <tr><td>Estimasi Biaya</td><td>Rp. {{ number_format($biaya_offset ?? 0, 0, ',', '.') }}</td></tr>
    </table>
  </div>
  <button class="offset-btn">Tebus Sekarang</button>
</div>
@endsection
@push('scripts')
<script>
const lokasiList = [
  {
    nama: 'Proyek Mangrove di Teluk Benoa Bali',
    gambar: 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80',
    deskripsi: 'Penanaman mangrove untuk serap karbon dan lindungi pesisir Bali.',
    detail: 'Menanam Pohon Mangrove di Teluk Benoa Bali'
  },
  {
    nama: 'Proyek Listrik Uap SGE',
    gambar: 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80',
    deskripsi: 'Offset karbon melalui energi terbarukan di Sumatera.',
    detail: 'Sertifikat (REC) Renewable Energy Certificate SGE'
  },
  {
    nama: 'Proyek PLTMG Gunung Wugul',
    gambar: 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=400&q=80',
    deskripsi: 'Offset karbon dari pembangkit listrik mikrohidro di Jawa.',
    detail: 'Sertifikat (REC) Renewable Energy Certificate PLTMG'
  },
  {
    nama: 'Sertifikat (REC) Renewable Energy Certificate Geothermal',
    gambar: 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80',
    deskripsi: 'Offset karbon dari energi panas bumi di Sulawesi.',
    detail: 'Sertifikat (REC) Renewable Energy Certificate Geothermal'
  },
  {
    nama: 'Sertifikat (REC) Renewable Energy Certificate Sumatera',
    gambar: 'https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&w=400&q=80',
    deskripsi: 'Offset karbon dari energi terbarukan di Sumatera.',
    detail: 'Sertifikat (REC) Renewable Energy Certificate Sumatera'
  }
];
function renderLokasiCards() {
  const lokasiCards = document.getElementById('lokasiCards');
  lokasiCards.innerHTML = '';
  lokasiList.forEach((lokasi, idx) => {
    const card = document.createElement('div');
    card.style.background = '#fff';
    card.style.border = '1.5px solid #EAEAEA';
    card.style.borderRadius = '12px';
    card.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
    card.style.overflow = 'hidden';
    card.style.display = 'flex';
    card.style.flexDirection = 'column';
    card.style.justifyContent = 'space-between';
    card.innerHTML = `
      <img src="${lokasi.gambar}" alt="${lokasi.nama}" style="width:100%;height:120px;object-fit:cover;">
      <div style="padding:12px 12px 0 12px;flex:1;">
        <div style="font-weight:700;font-size:15px;margin-bottom:4px;">${lokasi.nama}</div>
        <div style="font-size:13px;color:#666;margin-bottom:10px;">${lokasi.deskripsi}</div>
      </div>
      <button class="offset-btn-lokasi" data-idx="${idx}" style="margin:12px 12px 12px 12px;background:#7AC142;color:#fff;border:none;border-radius:7px;padding:8px 0;font-size:14px;font-weight:600;cursor:pointer;">Pilih Lokasi</button>
    `;
    lokasiCards.appendChild(card);
  });
  document.querySelectorAll('.offset-btn-lokasi').forEach(btn => {
    btn.addEventListener('click', function() {
      const idx = this.getAttribute('data-idx');
      document.getElementById('lokasiTerpilih').innerText = lokasiList[idx].nama;
      // Scroll ke bawah ke detail offset
      document.getElementById('lokasiTerpilih').scrollIntoView({behavior:'smooth'});
    });
  });
}
document.addEventListener('DOMContentLoaded', function() {
  renderLokasiCards();
  document.querySelector('.offset-btn').addEventListener('click', function() {
    let amount = {{ $biaya_offset ?? 50000 }};
    fetch('/bayar-offset', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ amount: amount })
    })
    .then(res => res.json())
    .then(res => {
      if(res.invoice_url) {
        window.location.href = res.invoice_url;
      }
    });
  });
});
</script>
@endpush 