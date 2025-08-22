@extends('layouts.master')
@section('title', 'Kalkulator Karbon')

@push('styles')
<style>
html,body {
  height: 100%;
  width: 100%;
  margin: 0;
  padding: 0;
  background: #F7F9FB !important;
}

body {
  min-height: 100vh;
  min-width: 100vw;
  box-sizing: border-box;
}

.calculator-wrapper {
  background-color: #fff;
  padding: 40px 48px 32px 48px;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
  width: calc(100vw - 32px);
  max-width: 900px;
  margin: 40px auto;
}

@media (max-width: 1000px) {
  .calculator-wrapper {
    width: 100vw;
    max-width: 100vw;
    margin: 0;
    border-radius: 0;
    padding: 24px 4vw 24px 4vw;
  }
}

.calculator-title {
  text-align: center;
  margin-bottom: 10px;
}

.calculator-title h2 {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 8px;
}

.calculator-title p {
  color: #888;
  font-size: 14px;
  margin-bottom: 0;
}

/* Vehicle Form Styles */
.vehicle-form {
  background: #fff;
  border: 2px solid #EAEAEA;
  border-radius: 15px;
  padding: 24px;
  margin-bottom: 24px;
  position: relative;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
  transition: all 0.3s ease;
}

.vehicle-form:hover {
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  border-color: #FFE066;
}

.vehicle-form-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 12px;
  border-bottom: 2px solid #F0F0F0;
}

.vehicle-form-title {
  font-size: 18px;
  font-weight: 700;
  color: #222;
  display: flex;
  align-items: center;
  gap: 8px;
}

.vehicle-number {
  background: #FFE066;
  color: #222;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  font-weight: 700;
}

.remove-vehicle-btn {
  background: #fff;
  border: 2px solid #ff4444;
  color: #ff4444;
  padding: 8px 16px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 12px;
  font-weight: 600;
  transition: all 0.2s;
  display: flex;
  align-items: center;
  gap: 4px;
}

.remove-vehicle-btn:hover {
  background: #ff4444;
  color: white;
  transform: translateY(-1px);
}

.vehicle-tabs {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 8px;
  margin-bottom: 20px;
  background: #F8F8F8;
  padding: 4px;
  border-radius: 12px;
}

.vehicle-tab-btn {
  background: transparent;
  border: none;
  padding: 10px 8px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 600;
  color: #888;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
  transition: all 0.2s;
  outline: none;
}

.vehicle-tab-btn.active {
  background: #FFE066;
  color: #222;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transform: translateY(-1px);
}

.vehicle-tab-btn span {
  font-size: 16px;
}

.tabs {
  display: flex;
  justify-content: space-between;
  gap: 10px;
  margin: 28px 0 24px 0;
}

.tab-btn {
  flex: 1;
  background: #F6F6F3;
  border: none;
  padding: 12px 0;
  border-radius: 10px;
  font-size: 15px;
  font-weight: 600;
  color: #888;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: background 0.2s, color 0.2s;
  outline: none;
}

.tab-btn.active {
  background: #FFE066;
  color: #222;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.tab-btn span {
  font-size: 20px;
}

.section-title {
  font-size: 16px;
  font-weight: 700;
  margin: 20px 0 12px 0;
  text-align: left;
  color: #333;
}

.selection-grid {
  display: flex;
  gap: 12px;
  justify-content: flex-start;
  margin-bottom: 16px;
  flex-wrap: wrap;
}

.selection-card {
  flex: 1;
  min-width: 80px;
  background: #fff;
  border: 2px solid #EAEAEA;
  border-radius: 12px;
  padding: 12px 8px;
  text-align: center;
  cursor: pointer;
  transition: all 0.2s;
  font-size: 13px;
  color: #222;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
}

.selection-card.selected {
  border-color: #FFE066;
  background: #FFFBE6;
  color: #222;
  font-weight: 600;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(255, 224, 102, 0.3);
}

.selection-card .icon {
  font-size: 20px;
  margin-bottom: 2px;
}

.divider {
  border: none;
  border-top: 1.5px solid #EAEAEA;
  margin: 24px 0 18px 0;
}

.input-label {
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 4px;
  color: #222;
}

.input-row {
  display: flex;
  gap: 12px;
  margin-bottom: 12px;
}

#input-transportasi-group {
  display: grid !important;
  grid-template-columns: 1fr;
  row-gap: 12px;
  margin-bottom: 12px;
}

.output-label {
  background: #FFFBE6;
  border: 1.5px solid #FFE066;
  padding: 10px 12px;
  border-radius: 6px;
  font-size: 16px;
  color: #333;
  min-height: 40px;
  display: flex;
  align-items: center;
}

.error-msg {
  color: red;
  font-size: 12px;
  margin-top: 4px;
  display: none;
}

.input-group input.invalid {
  border-color: red;
}

.input-group {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.input-group input {
  padding: 8px 10px;
  border-radius: 7px;
  border: 1px solid #EAEAEA;
  background: #F8F8F8;
  font-size: 14px;
}

.input-group input.readonly {
  background: #F3F3F3;
  color: #888;
}

.result-card {
  background: #FFFBE6;
  border: 1.5px solid #FFE066;
  border-radius: 10px;
  padding: 18px 18px 10px 18px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 18px 0 12px 0;
  font-size: 15px;
  font-weight: 600;
}

.result-card .result-label {
  color: #888;
  font-size: 13px;
  font-weight: 500;
}

.result-card .result-value {
  color: #222;
  font-size: 16px;
  font-weight: 700;
}

.vehicle-result-card {
  background: #E8F5E8;
  border: 1.5px solid #4CAF50;
  border-radius: 10px;
  padding: 15px;
  margin-top: 15px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 14px;
}

.vehicle-result-label {
  color: #666;
  font-size: 12px;
  font-weight: 500;
}

.vehicle-result-value {
  color: #222;
  font-size: 16px;
  font-weight: 700;
}

.button-row {
  display: flex;
  gap: 12px;
  margin-top: 10px;
}

.btn-calc {
  flex: 1;
  padding: 12px 0;
  border-radius: 8px;
  border: none;
  font-weight: 700;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-add {
  background: #fff;
  color: #666;
  border: 2px dashed #EAEAEA;
  padding: 12px 0;
  border-radius: 10px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.2s;
  margin: 20px 0;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

.btn-add:hover {
  border-color: #FFE066;
  background: #FFFBE6;
  color: #222;
  transform: translateY(-2px);
}

.submit-container {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}

.btn-submit {
  background-color: #7AC142;
  color: white;
  padding: 12px 24px;
  border-radius: 8px;
  border: none;
  font-weight: 700;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-submit:hover {
  background: #6bb13b;
  transform: translateY(-1px);
}

/* Total Results - More Compact Version */
.total-results {
  background: linear-gradient(135deg, #FFFBE6 0%, #FFF8D6 100%);
  border: 2px solid #FFE066;
  border-radius: 12px;
  padding: 16px;
  margin: 20px 0;
  text-align: center;
  box-shadow: 0 4px 16px rgba(255, 224, 102, 0.2);
}

.total-results h3 {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 12px;
  color: #222;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

.total-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

.total-item {
  background: white;
  padding: 12px;
  border-radius: 10px;
  border: 1px solid #EAEAEA;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.total-label {
  font-size: 12px;
  color: #666;
  margin-bottom: 4px;
  font-weight: 500;
}

.total-value {
  font-size: 16px;
  font-weight: 700;
}

.total-emission {
  color: #4CAF50;
}

.total-offset {
  color: #2196F3;
}

.select-group select,
.select-group input[type="text"],
.select-group input[type="number"] {
  width: 100%;
  padding: 8px 10px;
  border-radius: 7px;
  border: 1px solid #EAEAEA;
  background: #F8F8F8;
  font-size: 14px;
  margin-bottom: 8px;
}

.select-group {
  margin-bottom: 12px;
}

.select-group label {
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 4px;
  color: #222;
  display: block;
}

.select-group .input-suffix {
  display: flex;
  align-items: center;
  gap: 4px;
}

.select-group .input-suffix input {
  flex: 1;
}

.select-group .input-suffix span {
  font-size: 13px;
  color: #888;
  background: #F3F3F3;
  border-radius: 4px;
  padding: 2px 8px;
}

.debug-section {
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 8px;
  padding: 16px;
  margin: 20px 0;
}

.debug-section h4 {
  margin: 0 0 12px 0;
  color: #495057;
  font-size: 14px;
}

.debug-btn {
  background: #6c757d;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 12px;
  cursor: pointer;
  margin-right: 8px;
  margin-bottom: 8px;
}

.debug-btn:hover {
  background: #5a6268;
}

@media (max-width: 600px) {
  .calculator-wrapper {
    padding: 18px 2vw;
  }
  
  .vehicle-tabs {
    grid-template-columns: repeat(2, 1fr);
    gap: 6px;
  }
  
  .tabs {
    flex-direction: column;
    gap: 8px;
  }
  
  .selection-grid {
    flex-direction: column;
    gap: 10px;
  }
  
  .input-row {
    flex-direction: column;
    gap: 8px;
  }
  
  .result-card {
    flex-direction: column;
    gap: 8px;
    align-items: flex-start;
  }
  
  .vehicle-result-card {
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
  }
  
  .button-row {
    flex-direction: column;
    gap: 8px;
  }
  
  .total-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  
  .vehicle-form {
    padding: 16px;
    margin-bottom: 16px;
  }
  
  .total-results {
    padding: 12px;
    margin: 16px 0;
  }
  
  .total-results h3 {
    font-size: 14px;
    margin-bottom: 10px;
  }
  
  .total-value {
    font-size: 14px;
  }
  
  .btn-add {
    padding: 10px 0;
    font-size: 13px;
    margin: 16px 0;
  }
  
  .submit-container {
    justify-content: center;
  }
  
  .btn-submit {
    width: 100%;
    max-width: 200px;
  }
}

.hide {
  display: none !important;
}

/* Animation for adding vehicles */
@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.vehicle-form {
  animation: slideIn 0.3s ease-out;
}
</style>
@endpush

@section('content')
<div class="calculator-wrapper">
  <div class="calculator-title">
    <h2>Masukan Data Aktivitas Karbonmu</h2>
    <p>Bagikan detail kendaraan dan kebiasaan harian Anda<br>untuk menghitung emisi CO2 secara otomatis dengan mudah.</p>
  </div>

  <!-- Debug Section -->
  <!-- <div class="debug-section">
    <h4>🔧 Debug Tools</h4>
    <button class="debug-btn" onclick="testServer()">Test Server</button>
    <button class="debug-btn" onclick="checkSession()">Check Session</button>
    <button class="debug-btn" onclick="showVehicleData()">Show Vehicle Data</button>
  </div> -->

  <!-- Global tabs - hidden, only for initial reference -->
  <div class="tabs" style="display: none;">
    <button class="tab-btn active" data-target="darat"><span>🚗</span> Transportasi Darat</button>
    <button class="tab-btn" data-target="laut"><span>🚢</span> Transportasi Laut</button>
    <button class="tab-btn" data-target="udara"><span>✈️</span> Transportasi Udara</button>
    <button class="tab-btn" data-target="rumah"><span>🏠</span> Peralatan Rumah Tangga</button>
  </div>

  <!-- Vehicles Container -->
  <div id="vehicles-container">
    <!-- Vehicle forms will be dynamically added here -->
  </div>

  <!-- Add Vehicle Button -->
  <button class="btn-add" id="addVehicleBtn">
    <span>➕</span> Tambah Kendaraan Lain
  </button>

  <!-- Total Results -->
  <div class="total-results">
    <h3><span>📊</span> Total Keseluruhan</h3>
    <div class="total-grid">
      <div class="total-item">
        <div class="total-label">Total Emisi</div>
        <div class="total-value total-emission" id="totalEmission">0,00 ton CO₂e</div>
      </div>
      <div class="total-item">
        <div class="total-label">Perkiraan Biaya Offset</div>
        <div class="total-value total-offset" id="totalOffset">Rp. 0</div>
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="submit-container">
    <button class="btn-submit" id="submitBtn">Lanjutkan</button>
  </div>
</div>
@endsection

@push('scripts')
<script>
// Debug functions
window.testServer = function() {
  console.log('Testing server connection...');
  
  fetch('/test-server', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      test: 'data',
      timestamp: new Date().toISOString()
    })
  })
  .then(response => {
    console.log('Server test response status:', response.status);
    return response.json();
  })
  .then(data => {
    console.log('Server test response:', data);
    alert('Server test: ' + (data.success ? 'SUCCESS' : 'FAILED'));
  })
  .catch(error => {
    console.error('Server test error:', error);
    alert('Server test failed: ' + error.message);
  });
};

window.checkSession = function() {
  console.log('Checking session...');
  
  fetch('/debug-session')
  .then(response => response.json())
  .then(data => {
    console.log('Session data:', data);
    alert('Session ID: ' + data.session_id + '\nOffset data: ' + (data.offset_data ? 'EXISTS' : 'NOT FOUND'));
  })
  .catch(error => {
    console.error('Session check error:', error);
    alert('Session check failed: ' + error.message);
  });
};

window.showVehicleData = function() {
  console.log('Current vehicles data:', vehicles);
  alert('Vehicles count: ' + vehicles.length + '\nCheck console for details');
};

const transportasiData = {
  'darat': {
    vehicles: [
      { name: 'Mobil', icon: '🚗' },
      { name: 'Motor', icon: '🏍️' },
      { name: 'Bus', icon: '🚌' },
      { name: 'Kereta', icon: '🚆' }
    ],
    fuels: [
      { name: 'Pertalite' },
      { name: 'Pertamax' },
      { name: 'Solar' },
      { name: 'Electric' },
      { name: 'Diesel' },
      { name: 'Bensin (BBM)' }
    ],
    emissionFactors: {
      'Mobil': {
        'Pertalite': 0.17,
        'Pertamax': 0.18,
        'Diesel': 0.18,
        'Electric': 0.09
      },
      'Motor': {
        'Bensin (BBM)': 0.05
      },
      'Bus': {
        'Solar': 0.60
      },
      'Kereta': {
        'Electric': 0.05
      }
    }
  },
  'laut': {
    vehicles: [
      { name: 'Kapal Ferry', icon: '🚢' }
    ],
    fuels: [
      { name: 'Solar' }
    ],
    emissionFactors: {
      'Kapal Ferry': {
        'Solar': 0.11
      }
    }
  },
  'udara': {
    vehicles: [
      { name: 'Pesawat Domestik', icon: '✈️' },
    ],
    fuels: [
      { name: 'Avtur' }
    ],
    emissionFactors: {
      'Pesawat Domestik': {
        'Avtur': 0.25
      },
    }
  },
  'rumah': {
    vehicles: [
      { name: 'AC', icon: '❄️' },
      { name: 'Kulkas', icon: '🧊' },
      { name: 'Lampu', icon: '💡' },
      { name: 'Mesin Cuci', icon: '🧺' }
    ],
    fuels: [
      { name: 'Listrik' }
    ],
    emissionFactors: {
      'AC': {
        'Listrik': 0.10
      },
      'Kulkas': {
        'Listrik': 0.08
      },
      'Lampu': {
        'Listrik': 0.02
      },
      'Mesin Cuci': {
        'Listrik': 0.06
      }
    }
  }
};

let vehicles = [];
let vehicleCounter = 0;

function generateVehicleId() {
  return 'vehicle_' + (++vehicleCounter);
}

function createVehicleForm(vehicleId, transportType = 'darat') {
  const vehicleIndex = vehicles.length;
  
  const vehicleForm = document.createElement('div');
  vehicleForm.className = 'vehicle-form';
  vehicleForm.id = vehicleId;
  
  vehicleForm.innerHTML = `
    <div class="vehicle-form-header">
      <div class="vehicle-form-title">
        <div class="vehicle-number">${vehicleIndex + 1}</div>
        <span>Kendaraan/Peralatan</span>
      </div>
      ${vehicles.length > 0 ? `<button class="remove-vehicle-btn" onclick="removeVehicle('${vehicleId}')"><span>🗑️</span> Hapus</button>` : ''}
    </div>
    
    <div class="vehicle-tabs">
      <button class="vehicle-tab-btn ${transportType === 'darat' ? 'active' : ''}" data-transport="darat" onclick="switchVehicleTransport('${vehicleId}', 'darat', this)">
        <span>🚗</span> <span class="tab-text">Darat</span>
      </button>
      <button class="vehicle-tab-btn ${transportType === 'laut' ? 'active' : ''}" data-transport="laut" onclick="switchVehicleTransport('${vehicleId}', 'laut', this)">
        <span>🚢</span> <span class="tab-text">Laut</span>
      </button>
      <button class="vehicle-tab-btn ${transportType === 'udara' ? 'active' : ''}" data-transport="udara" onclick="switchVehicleTransport('${vehicleId}', 'udara', this)">
        <span>✈️</span> <span class="tab-text">Udara</span>
      </button>

    </div>
    
    <div class="section-title" id="vehicleTitle_${vehicleId}">Jenis Kendaraan</div>
    <div class="selection-grid" id="vehicleGrid_${vehicleId}"></div>
    
    <div class="section-title" id="fuelTitle_${vehicleId}">Jenis Bahan Bakar</div>
    <div class="selection-grid" id="fuelGrid_${vehicleId}"></div>
    
    <hr class="divider">
    
    <div style="font-size:14px;font-weight:600;text-align:center;margin-bottom:12px;" id="infoText_${vehicleId}">
        <h2>Masukkan Informasi Perjalanan untuk Menghitung Estimasi Emisi Karbonmu</h2>
        <p>Isi data perjalanan Anda untuk mendapatkan perkiraan emisi karbon yang akurat dan langkah offset yang tepat.</p>
    </div>
    
    <!-- Rumah Tangga Fields -->
    <div id="input-rumah-group_${vehicleId}" style="display:none;">
      <div class="select-group">
        <label for="daya_${vehicleId}">Daya (Watt)</label>
        <input type="number" id="daya_${vehicleId}" placeholder="Contoh: 100" oninput="calculateVehicleEmission('${vehicleId}')">
      </div>
      <div class="select-group">
        <label for="jumlah_alat_${vehicleId}">Jumlah Peralatan</label>
        <input type="number" id="jumlah_alat_${vehicleId}" placeholder="Contoh: 1" oninput="calculateVehicleEmission('${vehicleId}')">
      </div>
      <div class="select-group">
        <label for="durasi_${vehicleId}">Durasi Pemakaian (Jam/Hari)</label>
        <input type="number" id="durasi_${vehicleId}" placeholder="Contoh: 8" oninput="calculateVehicleEmission('${vehicleId}')">
      </div>
      <div class="select-group">
        <label for="frekuensi_rumah_${vehicleId}">Frekuensi (Hari/Minggu)</label>
        <input type="number" id="frekuensi_rumah_${vehicleId}" placeholder="Contoh: 7" oninput="calculateVehicleEmission('${vehicleId}')">
      </div>
    </div>
    
    <!-- Transportation Fields -->
    <div class="input-row" id="input-transportasi-group_${vehicleId}">
      <div class="input-group" id="input-jarak_${vehicleId}">
        <label class="input-label" for="jarak_${vehicleId}">Jarak Tempuh (km)</label>
        <input type="number" id="jarak_${vehicleId}" placeholder="Contoh: 50" oninput="calculateVehicleEmission('${vehicleId}')">
        <div class="error-msg" id="error-jarak_${vehicleId}"></div>
      </div>
      <div class="input-group" id="input-penumpang_${vehicleId}">
        <label class="input-label" for="penumpang_${vehicleId}">Jumlah Penumpang</label>
        <input type="number" id="penumpang_${vehicleId}" placeholder="Contoh: 1" oninput="calculateVehicleEmission('${vehicleId}')">
        <div class="error-msg" id="error-penumpang_${vehicleId}"></div>
      </div>
      <div class="input-group" id="input-frekuensi_${vehicleId}">
        <label class="input-label" for="frekuensi_${vehicleId}">Frekuensi (Hari/Minggu)</label>
        <input type="number" id="frekuensi_${vehicleId}" placeholder="Contoh: 5" oninput="calculateVehicleEmission('${vehicleId}')">
        <div class="error-msg" id="error-frekuensi_${vehicleId}"></div>
      </div>
    </div>
    
    <div class="input-row">
      <div class="input-group">
        <label class="input-label" for="emisi_per_km_${vehicleId}" id="label-emisi_${vehicleId}">Faktor Emisi (kg CO₂/km)</label>
        <div class="output-label" id="emisi_per_km_${vehicleId}">0.00</div>
      </div>
      <div class="input-group">
        <label class="input-label" for="total_emisi_${vehicleId}">Total Emisi (kg)</label>
        <div class="output-label" id="total_emisi_${vehicleId}">0.00</div>
      </div>
    </div>
    
    <div class="vehicle-result-card">
      <div>
        <div class="vehicle-result-label" id="resultLabel_${vehicleId}">Emisi Kendaraan Ini</div>
        <div class="vehicle-result-value" id="resultEmisi_${vehicleId}">0,00 ton CO₂e</div>
      </div>
      <div>
        <div class="vehicle-result-label">Biaya Offset</div>
        <div class="vehicle-result-value" id="resultOffset_${vehicleId}">Rp. 0</div>
      </div>
    </div>
  `;
  
  return vehicleForm;
}

function addVehicle(transportType = 'darat') {
  const vehicleId = generateVehicleId();
  const vehicleData = {
    id: vehicleId,
    transportType: transportType,
    vehicleType: null,
    fuelType: null,
    emission: 0,
    // Add detailed data fields
    jarak: 0,
    penumpang: 1,
    frekuensi: 1,
    daya: 0,
    jumlah_alat: 1,
    durasi: 0,
    emissionFactor: 0
  };
  
  vehicles.push(vehicleData);
  
  const vehicleForm = createVehicleForm(vehicleId, transportType);
  document.getElementById('vehicles-container').appendChild(vehicleForm);
  
  switchVehicleTransport(vehicleId, transportType);
  updateVehicleNumbers();
  updateRemoveButtons();
}

function removeVehicle(vehicleId) {
  vehicles = vehicles.filter(v => v.id !== vehicleId);
  document.getElementById(vehicleId).remove();
  updateVehicleNumbers();
  updateRemoveButtons();
  calculateTotalEmissions();
}

function updateVehicleNumbers() {
  vehicles.forEach((vehicle, index) => {
    const form = document.getElementById(vehicle.id);
    if (form) {
      const numberElement = form.querySelector('.vehicle-number');
      if (numberElement) {
        numberElement.textContent = index + 1;
      }
    }
  });
}

function updateRemoveButtons() {
  vehicles.forEach((vehicle) => {
    const form = document.getElementById(vehicle.id);
    if (form) {
      const header = form.querySelector('.vehicle-form-header');
      const existingBtn = header.querySelector('.remove-vehicle-btn');
      
      if (vehicles.length > 1) {
        if (!existingBtn) {
          const removeBtn = document.createElement('button');
          removeBtn.className = 'remove-vehicle-btn';
          removeBtn.innerHTML = '<span>🗑️</span> Hapus';
          removeBtn.onclick = () => removeVehicle(vehicle.id);
          header.appendChild(removeBtn);
        }
      } else {
        if (existingBtn) {
          existingBtn.remove();
        }
      }
    }
  });
}

function switchVehicleTransport(vehicleId, transportType, buttonElement = null) {
  // Update vehicle data
  const vehicle = vehicles.find(v => v.id === vehicleId);
  if (vehicle) {
    vehicle.transportType = transportType;
    vehicle.vehicleType = null;
    vehicle.fuelType = null;
    vehicle.emission = 0;
    vehicle.emissionFactor = 0;
  }
  
  // Update tab active state
  if (buttonElement) {
    const form = document.getElementById(vehicleId);
    form.querySelectorAll('.vehicle-tab-btn').forEach(btn => btn.classList.remove('active'));
    buttonElement.classList.add('active');
  }
  
  // Update titles and labels
  const isRumah = transportType === 'rumah';
  document.getElementById(`vehicleTitle_${vehicleId}`).textContent = isRumah ? 'Jenis Peralatan' : 'Jenis Kendaraan';
  document.getElementById(`fuelTitle_${vehicleId}`).textContent = isRumah ? 'Sumber Energi' : 'Jenis Bahan Bakar';
  document.getElementById(`label-emisi_${vehicleId}`).textContent = `Faktor Emisi (kg CO₂/${isRumah ? 'kWh' : 'km'})`;
  document.getElementById(`resultLabel_${vehicleId}`).textContent = `Emisi ${isRumah ? 'Peralatan' : 'Kendaraan'} Ini`;
  
  // Update input fields visibility
  updateVehicleInputFields(vehicleId, transportType);
  
  // Render vehicle and fuel options
  renderVehicleOptions(vehicleId, transportType);
}

function updateVehicleInputFields(vehicleId, transportType) {
  const isRumah = transportType === 'rumah';
  
  // Show/hide appropriate input groups
  document.getElementById(`input-rumah-group_${vehicleId}`).style.display = isRumah ? '' : 'none';
  document.getElementById(`input-transportasi-group_${vehicleId}`).style.display = isRumah ? 'none' : '';
}

function renderVehicleOptions(vehicleId, transportType) {
  const transportData = transportasiData[transportType];
  const vehicleGrid = document.getElementById(`vehicleGrid_${vehicleId}`);
  const fuelGrid = document.getElementById(`fuelGrid_${vehicleId}`);
  
  vehicleGrid.innerHTML = '';
  fuelGrid.innerHTML = '';
  
  // Render vehicles
  transportData.vehicles.forEach((vehicle, index) => {
    const div = document.createElement('div');
    div.className = 'selection-card' + (index === 0 ? ' selected' : '');
    div.innerHTML = `<span class="icon">${vehicle.icon}</span>${vehicle.name}`;
    div.onclick = () => selectVehicle(vehicleId, vehicle.name, div);
    vehicleGrid.appendChild(div);
    
    if (index === 0) {
      selectVehicle(vehicleId, vehicle.name, div);
    }
  });
}

function selectVehicle(vehicleId, vehicleName, element) {
  // Update selection
  element.parentNode.querySelectorAll('.selection-card').forEach(card => 
    card.classList.remove('selected'));
  element.classList.add('selected');
  
  // Update vehicle data
  const vehicle = vehicles.find(v => v.id === vehicleId);
  if (vehicle) {
    vehicle.vehicleType = vehicleName;
  }
  
  renderFuelOptions(vehicleId, vehicleName);
}

function renderFuelOptions(vehicleId, vehicleName) {
  const vehicle = vehicles.find(v => v.id === vehicleId);
  if (!vehicle) return;
  
  const transportData = transportasiData[vehicle.transportType];
  const fuelGrid = document.getElementById(`fuelGrid_${vehicleId}`);
  const emissionFactors = transportData.emissionFactors[vehicleName];
  
  fuelGrid.innerHTML = '';
  
  if (!emissionFactors) return;
  
  const availableFuels = transportData.fuels.filter(fuel => 
    emissionFactors[fuel.name] !== undefined);
  
  availableFuels.forEach((fuel, index) => {
    const div = document.createElement('div');
    div.className = 'selection-card' + (index === 0 ? ' selected' : '');
    div.innerHTML = `<span class="icon"><i class="fa fa-gas-pump"></i></span>${fuel.name}`;
    div.onclick = () => selectFuel(vehicleId, fuel.name, div);
    fuelGrid.appendChild(div);
    
    if (index === 0) {
      selectFuel(vehicleId, fuel.name, div);
    }
  });
}

function selectFuel(vehicleId, fuelName, element) {
  // Update selection
  element.parentNode.querySelectorAll('.selection-card').forEach(card => 
    card.classList.remove('selected'));
  element.classList.add('selected');
  
  // Update vehicle data
  const vehicle = vehicles.find(v => v.id === vehicleId);
  if (vehicle) {
    vehicle.fuelType = fuelName;
  }
  
  updateEmissionFactor(vehicleId);
}

function updateEmissionFactor(vehicleId) {
  const vehicle = vehicles.find(v => v.id === vehicleId);
  if (!vehicle || !vehicle.vehicleType || !vehicle.fuelType) return;
  
  const transportData = transportasiData[vehicle.transportType];
  const emissionFactors = transportData.emissionFactors[vehicle.vehicleType];
  const factor = emissionFactors ? emissionFactors[vehicle.fuelType] || 0 : 0;
  
  vehicle.emissionFactor = factor;
  document.getElementById(`emisi_per_km_${vehicleId}`).textContent = factor.toFixed(2);
  calculateVehicleEmission(vehicleId);
}

function calculateVehicleEmission(vehicleId) {
  const vehicle = vehicles.find(v => v.id === vehicleId);
  if (!vehicle) return;
  
  const emissionFactor = vehicle.emissionFactor || 0;
  let totalEmission = 0;
  
  if (vehicle.transportType === 'rumah') {
    const daya = parseFloat(document.getElementById(`daya_${vehicleId}`)?.value) || 0;
    const jumlahAlat = parseFloat(document.getElementById(`jumlah_alat_${vehicleId}`)?.value) || 1;
    const durasi = parseFloat(document.getElementById(`durasi_${vehicleId}`)?.value) || 0;
    const frekuensi = parseFloat(document.getElementById(`frekuensi_rumah_${vehicleId}`)?.value) || 1;
    
    // Update vehicle data
    vehicle.daya = daya;
    vehicle.jumlah_alat = jumlahAlat;
    vehicle.durasi = durasi;
    vehicle.frekuensi = frekuensi;
    
    // Calculate emission for household appliances
    const totalKwh = (daya * jumlahAlat * durasi * frekuensi) / 1000;
    totalEmission = totalKwh * emissionFactor;
  } else {
    const jarak = parseFloat(document.getElementById(`jarak_${vehicleId}`)?.value) || 0;
    const penumpang = parseFloat(document.getElementById(`penumpang_${vehicleId}`)?.value) || 1;
    const frekuensi = parseFloat(document.getElementById(`frekuensi_${vehicleId}`)?.value) || 1;
    
    // Update vehicle data
    vehicle.jarak = jarak;
    vehicle.penumpang = penumpang;
    vehicle.frekuensi = frekuensi;
    
    // Calculate emission for transportation
    totalEmission = jarak * emissionFactor * frekuensi * penumpang;
  }
  
  vehicle.emission = totalEmission;

  document.getElementById(`total_emisi_${vehicleId}`).textContent = totalEmission.toFixed(2);

  if (vehicle.transportType === 'rumah') {
    document.getElementById(`resultEmisi_${vehicleId}`).textContent = (totalEmission / 1000).toFixed(2) + ' ton CO₂e';
    const offset = Math.round((totalEmission / 1000) * 190000);
    document.getElementById(`resultOffset_${vehicleId}`).textContent = 'Rp. ' + offset.toLocaleString('id-ID');
  } else {
    // Tampilkan dengan 2 desimal untuk konsistensi
    document.getElementById(`resultEmisi_${vehicleId}`).textContent = totalEmission.toFixed(2) + ' kg CO₂';
    const offset = totalEmission * 500;
    document.getElementById(`resultOffset_${vehicleId}`).textContent = 'Rp. ' + offset.toLocaleString('id-ID');
  }
  
  calculateTotalEmissions();
}

function calculateTotalEmissions() {
  let totalEmission = 0;
  let totalOffset = 0;
  
  vehicles.forEach(vehicle => {
    const emission = vehicle.emission || 0;
    totalEmission += emission;
    
    if (vehicle.transportType === 'rumah') {
      totalOffset += Math.round((emission / 1000) * 190000);
    } else {
      totalOffset += Math.round(emission * 500);
    }
  });
  
  document.getElementById('totalEmission').textContent = (totalEmission).toFixed(2) + ' ton CO₂e';
  document.getElementById('totalOffset').textContent = 'Rp. ' + totalOffset.toLocaleString('id-ID');
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
  // Add vehicle button
  document.getElementById('addVehicleBtn').addEventListener('click', () => addVehicle());
  
  // Submit button
  document.getElementById('submitBtn').addEventListener('click', function() {
    console.log('=== SUBMITTING DATA ===');
    console.log('Total vehicles:', vehicles.length);
    console.log('All vehicles data:', vehicles);
    
    // Validate that we have at least one vehicle with complete data
    if (vehicles.length === 0) {
      alert('Silakan tambahkan minimal satu kendaraan');
      return;
    }
    
    // Check if all vehicles have required data
    const incompleteVehicles = vehicles.filter(v => 
      !v.vehicleType || !v.fuelType || v.emission <= 0
    );
    
    if (incompleteVehicles.length > 0) {
      alert('Silakan lengkapi data semua kendaraan terlebih dahulu');
      return;
    }
    
    // Collect all vehicle data with complete information
    const allVehicleData = vehicles.map(vehicle => ({
      jenis: vehicle.transportType,
      jenis_kendaraan: vehicle.vehicleType,
      bahan_bakar: vehicle.fuelType,
      jarak: vehicle.jarak || 0,
      penumpang: vehicle.penumpang || 1,
      frekuensi: vehicle.frekuensi || 1,
      daya: vehicle.daya || 0,
      jumlah_alat: vehicle.jumlah_alat || 1,
      durasi: vehicle.durasi || 0,
      emisi: vehicle.emission || 0,
      emisi_per_km: vehicle.emissionFactor || 0
    }));
    
    const totalEmission = vehicles.reduce((sum, v) => sum + (v.emission || 0), 0);
    
    const submitData = {
      vehicles: allVehicleData,
      total_emission: totalEmission
    };
    
    console.log('Formatted submit data:', submitData);
    
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
      alert('CSRF token tidak ditemukan. Silakan refresh halaman.');
      return;
    }
    
    console.log('CSRF Token:', csrfToken.getAttribute('content'));
    
    // Send to server
    fetch('/offset/calculate', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
        'Accept': 'application/json'
      },
      body: JSON.stringify(submitData)
    })
    .then(response => {
      console.log('Response status:', response.status);
      console.log('Response headers:', Object.fromEntries(response.headers.entries()));
      
      // Try to get response text first
      return response.text().then(text => {
        console.log('Raw response text:', text);
        
        try {
          const data = JSON.parse(text);
          return { data, status: response.status, ok: response.ok };
        } catch (e) {
          console.error('Failed to parse JSON:', e);
          throw new Error('Server returned invalid JSON: ' + text.substring(0, 200));
        }
      });
    })
    .then(({ data, status, ok }) => {
      console.log('Parsed response data:', data);
      
      if (!ok) {
        throw new Error(`HTTP ${status}: ${data.message || 'Unknown error'}`);
      }
      
      if (data.success) {
        console.log('Success! Redirecting to offset page...');
        window.location.href = '/offset';
      } else {
        alert('Gagal menyimpan data: ' + (data.message || 'Unknown error'));
      }
    })
    .catch(error => {
      console.error('Fetch error:', error);
      alert('Terjadi kesalahan saat menyimpan data: ' + error.message);
    });
  });
  
  // Initialize with first vehicle
  addVehicle();
});
</script>
@endpush
