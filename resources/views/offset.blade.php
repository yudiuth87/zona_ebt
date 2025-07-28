@extends('layouts.master')
@section('title', 'Lokasi Carbon Offset')

@push('styles')
<style>
.offset-container {
  max-width: 600px;
  margin: 32px auto;
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
  padding: 32px 24px 24px;
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

/* Lokasi Cards */
#lokasiCards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin-bottom: 32px;
}

.lokasi-card {
  background: #fafafa;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
  display: flex;
  flex-direction: column;
  transition: transform 0.3s, box-shadow 0.3s;
}

.lokasi-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
}

.lokasi-card img {
  width: 100%;
  height: 140px;
  object-fit: cover;
}

.lokasi-card-body {
  padding: 16px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.lokasi-card-title {
  font-size: 16px;
  font-weight: 600;
  color: #222;
  margin-bottom: 8px;
}

.lokasi-card-desc {
  font-size: 14px;
  color: #555;
  flex: 1;
  margin-bottom: 12px;
  line-height: 1.5;
}

.lokasi-card-btn {
  background: #7AC142;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 0;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  text-align: center;
  transition: background 0.2s;
}

.lokasi-card-btn:hover {
  background: #6bb13b;
}

/* Summary & Detail unchanged */
.offset-summary,
.offset-detail {
  background: #fff;
  border: 1.5px solid #EAEAEA;
  border-radius: 12px;
  padding: 18px 20px 10px;
  margin-bottom: 18px;
}

.offset-summary-title,
.offset-detail-title {
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
  margin: 24px 0 18px;
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
  <div class="offset-subtitle">Pilih lokasi terbaik untuk melakukan aksi penanaman pohon sebagai upaya mengimbangi jejak
    karbon Anda. Setiap lokasi membawa dampak nyata bagi lingkungan.</div>
  <div style="margin-bottom:24px;">
    <input type="text" id="searchLokasi" placeholder="Cari Lokasi Penanaman"
      style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid #ddd;font-size:15px;">
  </div>
  <div id="lokasiCards"></div>

  <div class="offset-title" style="margin-top:32px;">Lokasi Offset</div>
  <div class="offset-total">Total Emisi : {{ number_format($total_emisi ?? 0, 2, ',', '.') }} Kg CO2</div>

  <div class="offset-summary">
    <div class="offset-summary-title">Ringkasan Emisi Anda</div>
    <table class="offset-table">
      <tr>
        <td>Jenis Kendaraan</td>
        <td>{{ $jenis_kendaraan ?? '-' }}</td>
      </tr>
      <tr>
        <td>Jarak Tempuh</td>
        <td>{{ isset($jarak) ? $jarak . ' KM' : '-' }}</td>
      </tr>
      <tr>
        <td>Jumlah Orang</td>
        <td>{{ $penumpang ?? '-' }}</td>
      </tr>
      <tr>
        <td>Frekuensi</td>
        <td>{{ $frekuensi ?? '-' }}</td>
      </tr>
      <tr>
        <td>Bahan Bakar</td>
        <td>{{ $bahan_bakar ?? '-' }}</td>
      </tr>
    </table>
  </div>

  <div class="offset-detail">
    <div class="offset-detail-title">Detail Offset Emisi Anda</div>
    <table class="offset-table">
      <tr>
        <td>Lokasi Penanaman</td>
        <td id="lokasiTerpilih">Proyek Mangrove di Teluk Benoa Bali</td>
      </tr>
      <tr>
        <td>Jenis Kegiatan Offset</td>
        <td>Menanam Pohon</td>
      </tr>
      <tr>
        <td>Jenis Pohon</td>
        <td>Mangrove</td>
      </tr>
      <tr>
        <td>Total Emisi</td>
        <td>{{ number_format($total_emisi ?? 0, 2, ',', '.') }} Kg CO2</td>
      </tr>
      <tr>
        <td>Estimasi Biaya</td>
        <td>Rp. {{ number_format($biaya_offset ?? 0, 0, ',', '.') }}</td>
      </tr>
    </table>
  </div>

  <button class="offset-btn">Tebus Sekarang</button>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const lokasiList = [{
      nama: 'Sertifikat PLTM Gunung Wugul',
      gambar: '/assets/images/lokasiCarbon/gambar-1.jpg',
      deskripsi: 'PLTM Gunung Wugul adalah pembangkit listrik tenaga mini-hidro dengan kapasitas total 3 MW'
    },
    {
      nama: 'Proyek Mangrove di Teluk Benoa Bali',
      gambar: '/assets/images/lokasiCarbon/gambar-2.webp',
      deskripsi: 'Teluk Benoa, Bali adalah kawasan kaya biodiversitas dengan hutan bakau'
    },
    {
      nama: 'REC Zonaebt',
      gambar: '/assets/images/lokasiCarbon/gambar-3.webp',
      deskripsi: 'Sertifikat digital pembuktian kepemilikan energi terbarukan'
    },
    {
      nama: 'REC Geothermal',
      gambar: '/assets/images/lokasiCarbon/gambar-4.webp',
      deskripsi: 'Sertifikat energi ramah lingkungan seperti surya, angin, hidro'
    }
  ];

  function renderLokasiCards(list) {
    const container = document.getElementById('lokasiCards');
    container.innerHTML = '';
    if (!list.length) {
      container.innerHTML = '<p style="text-align:center;color:#999;">Tidak ada lokasi ditemukan</p>';
      return;
    }
    list.forEach((lokasi, idx) => {
      const card = document.createElement('div');
      card.className = 'lokasi-card';
      card.innerHTML = `
        <img src="${lokasi.gambar}" alt="${lokasi.nama}">
        <div class="lokasi-card-body">
          <div class="lokasi-card-title">${lokasi.nama}</div>
          <div class="lokasi-card-desc">${lokasi.deskripsi}</div>
          <button class="lokasi-card-btn" data-idx="${idx}">Pilih Lokasi</button>
        </div>
      `;
      container.appendChild(card);
    });
    document.querySelectorAll('.lokasi-card-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.getElementById('lokasiTerpilih').innerText = lokasiList[this.dataset.idx].nama;
      });
    });
  }

  document.getElementById('searchLokasi').addEventListener('input', function(e) {
    const keyword = e.target.value.toLowerCase();
    renderLokasiCards(lokasiList.filter(l => l.nama.toLowerCase().includes(keyword)));
  });

  document.querySelector('.offset-btn').addEventListener('click', function() {
    const params = new URLSearchParams({
      total_emisi: @json($total_emisi ?? 0),
      biaya_offset: @json($biaya_offset ?? 0),
      jenis_kendaraan: @json($jenis_kendaraan ?? ''),
      jarak: @json($jarak ?? 0),
      penumpang: @json($penumpang ?? 1),
      frekuensi: @json($frekuensi ?? 1),
      bahan_bakar: @json($bahan_bakar ?? ''),
      lokasi_terpilih: document.getElementById('lokasiTerpilih').innerText
    });
    window.location.href = '/form-data-diri?' + params.toString();
  });

  renderLokasiCards(lokasiList);
});
</script>
@endpush