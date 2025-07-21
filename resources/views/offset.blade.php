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
    nama: 'Sertifikat PLTM Gunung Wugul',
    gambar: '/assets/images/lokasiCarbon/gambar-1.jpg',
    deskripsi: 'PLTM Gunung Wugul adalah pembangkit listrik tenaga mini-hidro dengan kapasitas total 3 MW (2 x 1,5 MW) yang berlokasi di Banjarnegara, Jawa Tengah. Proyek ini merupakan inisiatif energi bersih yang memanfaatkan aliran Sungai Urang untuk menghasilkan listrik terbarukan.',
    detail: 'Sertifikat (REC) Renewable Energy Certificate PLTMG'
  },
  {
    nama: 'Proyek Mangrove di Teluk Benoa Bali',
    gambar: '/assets/images/lokasiCarbon/gambar-2.webp',
    deskripsi: 'Teluk Benoa, Bali adalah kawasan kaya biodiversitas dengan hutan bakau, terumbu karang, dan padang lamun. Meski menghadapi reklamasi dan polusi, wilayah ini berperan penting sebagai penyerap karbon, penyaring polutan, dan pelindung alami dari abrasi dan tsunami.',
    detail: 'Menanam Pohon Mangrove di Teluk Benoa Bali'
  },
  {
    nama: 'Sertifikat (REC) Renewable Energy Certificate zonaebt',
    gambar: '/assets/images/lokasiCarbon/gambar-3.webp',
    deskripsi: '"Sertifikat (REC) Renewable Energy Certificate Zonaebt adalah sertifikat digital yang membuktikan kepemilikan atas energi terbarukan (renewable energy) yang dihasilkan dari sumber-sumber ramah lingkungan seperti tenaga Panas Bumi/Geothermal. 1 REC setara dengan 1 MWh (Megawatt-hour).',
    detail: 'Sertifikat (REC) Renewable Energy Certificate SGE'
  },
  {
    nama: 'Sertifikat (REC) Renewable Energy Certificate Geothermal',
    gambar: '/assets/images/lokasiCarbon/gambar-4.webp',
    deskripsi: 'Sertifikat (REC) Renewable Energy Certificate ZonaEBT adalah sertifikat digital yang membuktikan kepemilikan atas energi terbarukan (renewable energy) yang dihasilkan dari sumber-sumber ramah lingkungan seperti tenaga surya, angin, hidro, atau biomassa. 1 REC setara dengan 1 MWh (Megawatt-hour) listrik hijau yang disuntikkan ke dalam grid.',
    detail: 'Sertifikat (REC) Renewable Energy Certificate Geothermal'
  },
];

function renderLokasiCards(filteredList = lokasiList) {
  const lokasiCards = document.getElementById('lokasiCards');
  lokasiCards.innerHTML = '';
  if (filteredList.length === 0) {
    lokasiCards.innerHTML = '<div style="grid-column:1 / -1; text-align:center; color:#999;">Tidak ada lokasi ditemukan</div>';
    return;
  }

  filteredList.forEach((lokasi, idx) => {
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
      <button class="offset-btn-lokasi" data-idx="${lokasiList.indexOf(lokasi)}" style="margin:12px 12px 12px 12px;background:#7AC142;color:#fff;border:none;border-radius:7px;padding:8px 0;font-size:14px;font-weight:600;cursor:pointer;">Pilih Lokasi</button>
    `;
    lokasiCards.appendChild(card);
  });

  document.querySelectorAll('.offset-btn-lokasi').forEach(btn => {
    btn.addEventListener('click', function () {
      const idx = this.getAttribute('data-idx');
      document.getElementById('lokasiTerpilih').innerText = lokasiList[idx].nama;
      document.getElementById('lokasiTerpilih').scrollIntoView({ behavior: 'smooth' });
    });
  });
}

document.addEventListener('DOMContentLoaded', function () {
  renderLokasiCards();

  document.getElementById('searchLokasi').addEventListener('input', function () {
    const keyword = this.value.toLowerCase();
    const filtered = lokasiList.filter(l => l.nama.toLowerCase().includes(keyword));
    renderLokasiCards(filtered);
  });

  document.querySelector('.offset-btn').addEventListener('click', function () {
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
      if (res.invoice_url) {
        window.location.href = res.invoice_url;
      }
    });
  });
});
</script>
@endpush
