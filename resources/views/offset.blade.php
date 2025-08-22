@extends('layouts.master')
@section('title', 'Lokasi Carbon Offset')

@push('styles')
<style>
.offset-container {
  max-width: 700px;
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

/* Progress Indicator */
.progress-container {
  margin-bottom: 32px;
}

.progress-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.progress-title-section {
  display: flex;
  align-items: center;
  gap: 12px;
}

.progress-title {
  font-size: 18px;
  font-weight: 600;
  color: #222;
}

.progress-nav-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 2px solid #e0e0e0;
  background: white;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
  font-size: 16px;
  color: #666;
  font-weight: bold;
}

.progress-nav-btn:hover:not(:disabled) {
  border-color: #FFE066;
  background: #FFFBE6;
  color: #222;
}

.progress-nav-btn:disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.progress-counter {
  background: #FFE066;
  color: #222;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 14px;
  font-weight: 600;
}

.progress-bar {
  background: #f0f0f0;
  height: 8px;
  border-radius: 4px;
  overflow: hidden;
  margin-bottom: 12px;
  position: relative;
}

.progress-fill {
  background: linear-gradient(90deg, #7AC142, #4CAF50);
  height: 100%;
  transition: width 0.3s ease;
  border-radius: 4px;
}

/* Current Vehicle Card */
.current-vehicle-card {
  background: linear-gradient(135deg, #E8F5E8, #F0F8F0);
  border: 2px solid #4CAF50;
  border-radius: 15px;
  padding: 20px;
  margin-bottom: 24px;
}

.vehicle-info {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 16px;
}

.vehicle-icon {
  width: 48px;
  height: 48px;
  background: #4CAF50;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}

.vehicle-details h3 {
  font-size: 18px;
  font-weight: 700;
  color: #222;
  margin: 0 0 4px 0;
}

.vehicle-details p {
  font-size: 14px;
  color: #666;
  margin: 0;
}

.vehicle-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  gap: 12px;
  background: white;
  padding: 16px;
  border-radius: 10px;
  border: 1px solid #e0e0e0;
}

.stat-item {
  text-align: center;
}

.stat-label {
  font-size: 12px;
  color: #666;
  margin-bottom: 4px;
}

.stat-value {
  font-size: 16px;
  font-weight: 700;
  color: #222;
}

/* Lokasi Cards */
#lokasiCards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.lokasi-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
}

.lokasi-card.selected {
  border-color: #FFE066;
  background: #FFFBE6;
  transform: translateY(-4px);
}

.lokasi-image {
  width: 100%;
  aspect-ratio: 16 / 9;
  object-fit: cover;
  display: block;
  border-top-left-radius: 12px;
  border-top-right-radius: 12px;
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
  transition: all 0.2s;
}

.lokasi-card-btn:hover {
  background: #6bb13b;
}

.lokasi-card.selected .lokasi-card-btn {
  background: #FFE066;
  color: #222;
}

/* Main Action Button */
.main-action-btn {
  width: 100%;
  padding: 16px 0;
  border-radius: 10px;
  border: none;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s;
  margin-top: 24px;
}

.main-action-btn.disabled {
  background: #e0e0e0;
  color: #999;
  cursor: not-allowed;
}

.main-action-btn.enabled {
  background: #7AC142;
  color: white;
}

.main-action-btn.enabled:hover {
  background: #6bb13b;
  transform: translateY(-2px);
}

/* Final Summary Section */
.final-summary {
  background: linear-gradient(135deg, #FFFBE6, #FFF8D6);
  border: 2px solid #FFE066;
  border-radius: 15px;
  padding: 24px;
  margin-top: 32px;
}

.final-summary-title {
  font-size: 20px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 24px;
  color: #222;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.summary-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
  margin-bottom: 24px;
}

.summary-item {
  background: white;
  padding: 16px;
  border-radius: 10px;
  text-align: center;
  border: 1px solid #e0e0e0;
}

.summary-label {
  font-size: 14px;
  color: #666;
  margin-bottom: 8px;
}

.summary-value {
  font-size: 18px;
  font-weight: 700;
  color: #222;
}

/* Vehicle Locations List */
.vehicle-locations {
  background: white;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 20px;
  border: 1px solid #e0e0e0;
}

.vehicle-locations h4 {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 16px;
  color: #222;
}

.location-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid #f0f0f0;
}

.location-item:last-child {
  border-bottom: none;
}

.location-icon {
  width: 40px;
  height: 40px;
  background: #f8f8f8;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}

.location-details {
  flex: 1;
}

.location-vehicle {
  font-size: 14px;
  font-weight: 600;
  color: #222;
  margin-bottom: 2px;
}

.location-name {
  font-size: 13px;
  color: #666;
}

.location-emission {
  text-align: right;
  font-size: 14px;
  font-weight: 600;
  color: #4CAF50;
}

@media (max-width: 768px) {
  .offset-container {
    margin: 16px;
    padding: 24px 16px;
  }
  
  .progress-title-section {
    gap: 8px;
  }
  
  .progress-nav-btn {
    width: 28px;
    height: 28px;
    font-size: 14px;
  }
  
  .vehicle-stats {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .summary-grid {
    grid-template-columns: 1fr;
  }
  
  .location-item {
    flex-direction: column;
    text-align: center;
    gap: 8px;
  }
}
</style>
@endpush

@section('content')
<div class="offset-container">
  <!-- Back Button -->
  <a href="/kalkulator" class="back-btn">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
    Kembali ke Kalkulator
  </a>

  <div class="offset-title">Pilih Lokasi Offset Karbon Anda</div>
  <div class="offset-subtitle">Pilih jenis proyek karbon yang paling sesuai untuk mengoffset emisi Anda dan berkontribusi pada pencapaian target NDC Indonesia dalam mengurangi emisi karbon.</div>

  <!-- Progress Indicator -->
  <div class="progress-container" id="progressContainer">
    <div class="progress-header">
      <div class="progress-title-section">
        <button class="progress-nav-btn" id="prevVehicleBtn" onclick="navigateVehicle(-1)">‹</button>
        <div class="progress-title" id="progressTitle">Kendaraan 1 dari 1</div>
        <button class="progress-nav-btn" id="nextVehicleBtn" onclick="navigateVehicle(1)">›</button>
      </div>
      <div class="progress-counter" id="progressCounter">1/1</div>
    </div>
    <div class="progress-bar">
      <div class="progress-fill" id="progressFill" style="width: 100%"></div>
    </div>
  </div>

  <!-- Current Vehicle Card -->
  <div class="current-vehicle-card" id="currentVehicleCard">
    <div class="vehicle-info">
      <div class="vehicle-icon" id="vehicleIcon">🚗</div>
      <div class="vehicle-details">
        <h3 id="vehicleName">Mobil - Pertalite</h3>
        <p id="vehicleTransport">Transportasi Darat</p>
      </div>
    </div>
    <div class="vehicle-stats" id="vehicleStats">
      <!-- Stats will be populated by JavaScript -->
    </div>
  </div>

  <!-- Search -->
  <div style="margin-bottom:24px;">
    <input type="text" id="searchLokasi" placeholder="Cari Lokasi Penanaman"
      style="width:100%;padding:12px 16px;border-radius:10px;border:1px solid #ddd;font-size:15px;">
  </div>

  <!-- Location Cards -->
  <div id="lokasiCards"></div>

  <!-- Main Action Button -->
  <button class="main-action-btn disabled" id="mainActionBtn" disabled>
    Pilih lokasi untuk semua kendaraan terlebih dahulu
  </button>

  <!-- Final Summary Section (Hidden initially) -->
  <div class="final-summary" id="finalSummary" style="display: none;">
    <div class="final-summary-title">
      <span>📊</span> Detail Offset Emisi Anda
    </div>
    
    <div class="summary-grid">
      <div class="summary-item">
        <div class="summary-label">Total Kendaraan</div>
        <div class="summary-value" id="totalVehiclesCount">0</div>
      </div>
      <div class="summary-item">
        <div class="summary-label">Total Emisi Keseluruhan</div>
        <div class="summary-value" id="totalEmissionValue">0 kg CO₂</div>
      </div>
      <div class="summary-item">
        <div class="summary-label">Estimasi Biaya Keseluruhan</div>
        <div class="summary-value" id="totalCostValue">Rp 0</div>
      </div>
    </div>

    <div class="vehicle-locations" id="vehicleLocationsList">
      <h4>Offset Emisi:</h4>
      <!-- Vehicle locations will be populated here -->
    </div>

    <button class="main-action-btn enabled" onclick="proceedToCheckout()">
      Tebus Sekarang 🚀
    </button>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Get vehicles data from session
  const offsetData = @json(session('offset_data', null));

  console.log('=== DEBUG SESSION DATA ===');
  console.log('Offset Data:', offsetData);
  console.log('All Session Keys:', @json(array_keys(session()->all())));
  console.log('Session All:', @json(session()->all()));
  console.log('==========================');

  let vehiclesData = [];
  let totalEmission = 0;
  let totalCost = 0;

  if (offsetData && offsetData.vehicles) {
    vehiclesData = offsetData.vehicles;
    totalEmission = offsetData.total_emission || 0;
    totalCost = offsetData.total_cost || 0;
    
    console.log('Using offset_data from session');
    console.log('Vehicles found:', vehiclesData.length);
  } else {
    console.error('No offset_data found in session!');
    console.log('Available session keys:', @json(array_keys(session()->all())));
  }
  
  // Data sudah dalam format yang benar, tidak perlu normalize
  console.log('Final Data:');
  console.log('- Vehicles:', vehiclesData);
  console.log('- Count:', vehiclesData.length);
  console.log('- Total Emission:', totalEmission);
  console.log('- Total Cost:', totalCost);
  
  let currentVehicleIndex = 0;
  let selectedLocations = {};
  
  const lokasiList = [
    {
      nama: 'Sertifikat PLTM Gunung Wugul',
      gambar: '/assets/images/lokasiCarbon/gambar-1.jpg',
      deskripsi: 'PLTM Gunung Wugul adalah pembangkit listrik tenaga mini-hidro dengan kapasitas total 3 MW (2 x 1,5 MW) yang berlokasi di Banjarnegara, Jawa Tengah. Proyek ini merupakan bagian dari upaya pemanfaatan aliran Sungai Urang untuk menghasilkan energi terbarukan yang bersih.',
      jenis: 'Energi Terbarukan'
    },
    {
      nama: 'Proyek Lahendong Unit 5 & 6',
      gambar: '/assets/images/lokasiCarbon/gambar-2.png',
      deskripsi: 'Proyek Lahendong Unit 5 & 6 merupakan inisiatif pengembangan pembangkit listrik tenaga panas bumi oleh PT Pertamina Geothermal Energy Tbk di Sulawesi Utara. Setiap unit memiliki kapasitas sekitar 20 MW untuk mendukung penyediaan energi bersih nasional.',
      jenis: 'Penanaman Pohon'
    },
    {
      nama: 'Sertifikat (REC) Renewable Energy Certificate – ZonaEBT',
      gambar: '/assets/images/lokasiCarbon/gambar-3.webp',
      deskripsi: 'Sertifikat (REC) Renewable Energy Certificate ZonaEBT merupakan bukti digital kepemilikan atas energi terbarukan (renewable energy) yang berasal dari sumber-sumber energi ramah lingkungan, seperti tenaga surya, angin, hidro, biomassa, atau panas bumi (geothermal). Setiap 1 REC mewakili 1 MWh (Megawatt-hour) energi hijau yang masuk ke dalam jaringan listrik.',
      jenis: 'Sertifikat Digital'
    },
    {
      nama: 'Sertifikat (REC) Renewable Energy Certificate – Geothermal',
      gambar: '/assets/images/lokasiCarbon/gambar-4.webp',
      deskripsi: 'Sertifikat (REC) Renewable Energy Certificate ZonaEBT merupakan sertifikat digital yang menjadi bukti kepemilikan atas energi terbarukan (renewable energy) yang dihasilkan dari sumber daya ramah lingkungan seperti tenaga surya, angin, hidro, biomassa, maupun panas bumi (geothermal). Setiap 1 REC setara dengan 1 MWh (Megawatt-hour) listrik hijau yang disalurkan ke dalam jaringan listrik.',
      jenis: 'Energi Geothermal'
    }
  ];

  // Transport icons mapping
  const transportIcons = {
    'darat': {
      'Mobil': '🚗',
      'Motor': '🏍️', 
      'Bus': '🚌',
      'Kereta': '🚆'
    },
    'laut': {
      'Kapal Ferry': '🚢'
    },
    'udara': {
      'Pesawat Domestik': '✈️',
    },
    'rumah': {
      'AC': '❄️',
      'Kulkas': '🧊',
      'Lampu': '💡',
      'Mesin Cuci': '🧺'
    }
  };

  const transportNames = {
    'darat': 'Transportasi Darat',
    'laut': 'Transportasi Laut',
    'udara': 'Transportasi Udara', 
    'rumah': 'Peralatan Rumah Tangga'
  };

  function updateProgress() {
    const totalVehicles = vehiclesData.length;
    const progressPercentage = ((currentVehicleIndex + 1) / totalVehicles) * 100;
    
    document.getElementById('progressFill').style.width = progressPercentage + '%';
    document.getElementById('progressTitle').textContent = `Kendaraan ${currentVehicleIndex + 1} dari ${totalVehicles}`;
    document.getElementById('progressCounter').textContent = `${currentVehicleIndex + 1}/${totalVehicles}`;
    
    // Update navigation buttons
    document.getElementById('prevVehicleBtn').disabled = currentVehicleIndex === 0;
    document.getElementById('nextVehicleBtn').disabled = currentVehicleIndex === totalVehicles - 1;
  }

  function updateCurrentVehicleCard() {
    const vehicle = vehiclesData[currentVehicleIndex];
    if (!vehicle) {
      console.error('No vehicle data at index:', currentVehicleIndex);
      return;
    }

    console.log('Updating card for vehicle:', vehicle);

    // Get appropriate icon dengan fallback yang lebih baik
    let vehicleIcon = '🚗'; // default
    if (transportIcons[vehicle.jenis] && transportIcons[vehicle.jenis][vehicle.jenis_kendaraan]) {
      vehicleIcon = transportIcons[vehicle.jenis][vehicle.jenis_kendaraan];
    }
    
    document.getElementById('vehicleIcon').textContent = vehicleIcon;
    document.getElementById('vehicleName').textContent = `${vehicle.jenis_kendaraan} - ${vehicle.bahan_bakar}`;
    document.getElementById('vehicleTransport').textContent = transportNames[vehicle.jenis] || 'Transportasi';

    // Update stats based on transport type
    const statsContainer = document.getElementById('vehicleStats');
    if (vehicle.jenis === 'rumah') {
      statsContainer.innerHTML = `
        <div class="stat-item">
          <div class="stat-label">Daya</div>
          <div class="stat-value">${vehicle.daya || 0} W</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Jumlah</div>
          <div class="stat-value">${vehicle.jumlah_alat || 1} unit</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Durasi</div>
          <div class="stat-value">${vehicle.durasi || 0} jam</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Emisi</div>
          <div class="stat-value">${parseFloat(vehicle.emisi || 0).toFixed(2)} kg CO₂</div>
        </div>
      `;
    } else {
      statsContainer.innerHTML = `
        <div class="stat-item">
          <div class="stat-label">Jarak</div>
          <div class="stat-value">${vehicle.jarak || 0} km</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Penumpang</div>
          <div class="stat-value">${vehicle.penumpang || 1} orang</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Frekuensi</div>
          <div class="stat-value">${vehicle.frekuensi || 1} hari</div>
        </div>
        <div class="stat-item">
          <div class="stat-label">Emisi</div>
          <div class="stat-value">${parseFloat(vehicle.emisi || 0).toFixed(2)} kg CO₂</div>
        </div>
      `;
    }
  }

  function renderLokasiCards(originalList = lokasiList) {
  const container = document.getElementById('lokasiCards');
  container.innerHTML = '';

  const currentVehicle = vehiclesData[currentVehicleIndex];
  if (!currentVehicle) {
    container.innerHTML = '<p style="text-align:center;color:#999;padding:40px;">Kendaraan tidak ditemukan.</p>';
    return;
  }

  // FILTER lokasi sesuai jenis kendaraan
  let filteredList = [];

  if (currentVehicle.jenis === 'rumah') {
    // Untuk rumah: tampilkan yang mengandung 'REC' atau jenisnya 'Sertifikat Digital'
    filteredList = originalList.filter(l =>
      l.nama.toLowerCase().includes('rec') || l.jenis === 'Sertifikat Digital'
    );
  } else {
    // Untuk kendaraan (darat/laut/udara): tampilkan selain 'REC' dan selain 'Sertifikat Digital'
    filteredList = originalList.filter(l =>
      !l.nama.toLowerCase().includes('rec') && l.jenis !== 'Sertifikat Digital'
    );
  }

  if (!filteredList.length) {
    container.innerHTML = '<p style="text-align:center;color:#999;padding:40px;">Tidak ada lokasi tersedia untuk jenis ini.</p>';
    return;
  }

  filteredList.forEach((lokasi, idx) => {
    const isSelected = selectedLocations[currentVehicleIndex] === lokasiList.indexOf(lokasi);
    const card = document.createElement('div');
    card.className = `lokasi-card ${isSelected ? 'selected' : ''}`;
    card.innerHTML = `
      <img src="${lokasi.gambar}" alt="${lokasi.nama}" onerror="this.src='/placeholder.svg?height=140&width=280&text=${encodeURIComponent(lokasi.nama)}'">
      <div class="lokasi-card-body">
        <div class="lokasi-card-title">${lokasi.nama}</div>
        <div class="lokasi-card-desc">${lokasi.deskripsi}</div>
        <button class="lokasi-card-btn" data-idx="${lokasiList.indexOf(lokasi)}">
          ${isSelected ? '✓ Terpilih' : 'Pilih Lokasi'}
        </button>
      </div>
    `;
    container.appendChild(card);
  });

  // Add click handlers
  document.querySelectorAll('.lokasi-card-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const idx = parseInt(this.dataset.idx);
      selectedLocations[currentVehicleIndex] = idx;

      document.querySelectorAll('.lokasi-card').forEach(card => card.classList.remove('selected'));
      this.closest('.lokasi-card').classList.add('selected');

      document.querySelectorAll('.lokasi-card-btn').forEach(b => b.textContent = 'Pilih Lokasi');
      this.textContent = '✓ Terpilih';

      updateMainActionButton();
    });
  });
}


  function updateMainActionButton() {
    const allSelected = vehiclesData.every((_, index) => selectedLocations[index] !== undefined);
    const mainBtn = document.getElementById('mainActionBtn');
    
    if (allSelected) {
      mainBtn.className = 'main-action-btn enabled';
      mainBtn.disabled = false;
      mainBtn.textContent = 'Lihat Detail Offset Emisi';
      mainBtn.onclick = showFinalSummary;
    } else {
      const selectedCount = Object.keys(selectedLocations).length;
      mainBtn.className = 'main-action-btn disabled';
      mainBtn.disabled = true;
      mainBtn.textContent = `Pilih lokasi untuk ${vehiclesData.length - selectedCount} kendaraan lagi`;
    }
  }

  function showFinalSummary() {
    // Hide main selection interface
    document.getElementById('progressContainer').style.display = 'none';
    document.getElementById('currentVehicleCard').style.display = 'none';
    document.querySelector('#searchLokasi').parentElement.style.display = 'none';
    document.getElementById('lokasiCards').style.display = 'none';
    document.getElementById('mainActionBtn').style.display = 'none';
    
    // Show final summary
    document.getElementById('finalSummary').style.display = 'block';

    // Update summary data
    document.getElementById('totalVehiclesCount').textContent = vehiclesData.length;
    document.getElementById('totalEmissionValue').textContent = parseFloat(totalEmission).toFixed(2) + ' kg CO₂';
    document.getElementById('totalCostValue').textContent = 'Rp ' + parseInt(totalCost).toLocaleString('id-ID');

    // Populate vehicle locations list
    const locationsList = document.getElementById('vehicleLocationsList');
    const locationsHTML = vehiclesData.map((vehicle, index) => {
      const locationIdx = selectedLocations[index];
      const location = lokasiList[locationIdx];
      const vehicleIcon = transportIcons[vehicle.jenis]?.[vehicle.jenis_kendaraan] || '🚗';
      
      return `
        <div class="location-item">
          <div class="location-icon">${vehicleIcon}</div>
          <div class="location-details">
            <div class="location-vehicle">${vehicle.jenis_kendaraan} - ${vehicle.bahan_bakar}</div>
            <div class="location-name">Lokasi offset emisi ${index + 1}: ${location ? location.nama : 'Belum dipilih'}</div>
          </div>
          <div class="location-emission">${parseFloat(vehicle.emisi || 0).toFixed(2)} kg CO₂</div>
        </div>
      `;
    }).join('');
    
    locationsList.innerHTML = `<h4>Offset Emisi:</h4>${locationsHTML}`;
  }

  // Navigation functions
  window.navigateVehicle = function(direction) {
    const newIndex = currentVehicleIndex + direction;
    if (newIndex >= 0 && newIndex < vehiclesData.length) {
      currentVehicleIndex = newIndex;
      updateProgress();
      updateCurrentVehicleCard();
      renderLokasiCards();
      updateMainActionButton();
    }
  };

  // Search functionality
  document.getElementById('searchLokasi').addEventListener('input', function(e) {
    const keyword = e.target.value.toLowerCase();
    const filtered = lokasiList.filter(l => l.nama.toLowerCase().includes(keyword));
    renderLokasiCards(filtered);
  });

  // Proceed to checkout
  window.proceedToCheckout = function() {
    // Prepare data for checkout
    const checkoutData = {
      vehicles: vehiclesData.map((vehicle, index) => ({
        ...vehicle,
        selected_location: lokasiList[selectedLocations[index]]
      })),
      total_emission: totalEmission,
      total_cost: totalCost,
      selected_locations: selectedLocations
    };
    
    // Create form and submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/form-data-diri';
    
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'checkout_data';
    input.value = JSON.stringify(checkoutData);
    
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    form.appendChild(input);
    form.appendChild(csrfInput);
    document.body.appendChild(form);
    form.submit();
  };

  // Initialize
  if (vehiclesData.length > 0) {
    updateProgress();
    updateCurrentVehicleCard();
    renderLokasiCards(); // Langsung tampilkan semua lokasi
    updateMainActionButton();
  } else {
    // Handle case when no vehicles data
    document.getElementById('progressContainer').innerHTML = `
      <div style="text-align:center;color:#999;padding:40px;">
        <h3>Tidak ada data kendaraan</h3>
        <p>Debug info: Found ${vehiclesData.length} vehicles</p>
        <p>Session keys: ${Object.keys(@json(session()->all())).join(', ')}</p>
        <button onclick="window.location.href='/'" style="margin-top:16px;padding:8px 16px;background:#7AC142;color:white;border:none;border-radius:4px;">
          Kembali ke Kalkulator
        </button>
      </div>
    `;
  }
});
</script>
@endpush
