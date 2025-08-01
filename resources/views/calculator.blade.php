@extends('layouts.master')

@section('title', 'Kalkulator Karbon')

@push('styles')
<style>
html,
body {
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
  font-size: 18px;
  font-weight: 700;
  margin: 24px 0 12px 0;
  text-align: left;
}

.selection-grid {
  display: flex;
  gap: 16px;
  justify-content: flex-start;
  margin-bottom: 8px;
}

.selection-card {
  flex: 1;
  min-width: 80px;
  background: #fff;
  border: 2px solid #EAEAEA;
  border-radius: 12px;
  padding: 14px 0 10px 0;
  text-align: center;
  cursor: pointer;
  transition: border 0.2s, background 0.2s;
  font-size: 14px;
  color: #222;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
}

.selection-card.selected {
  border-color: #FFE066;
  background: #FFFBE6;
  color: #222;
  font-weight: 600;
}

.selection-card .icon {
  font-size: 22px;
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
  /* background-color: #f5f5f5; */
  background: #FFFBE6;
  border: 1.5px solid #FFE066;
  padding: 10px 12px;
  /* border: 1px solid #ddd; */
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
  color: #222;
  border: 1.5px solid #EAEAEA;
}

.btn-add:hover {
  background: #F6F6F3;
}

.btn-submit {
  background-color: #7AC142;
  color: white;
}

.btn-submit:hover {
  background: #6bb13b;
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

@media (max-width: 600px) {
  .calculator-wrapper {
    padding: 18px 2vw;
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

  .button-row {
    flex-direction: column;
    gap: 8px;
  }
}

.hide {
  display: none !important;
}
</style>
@endpush

@section('content')
<div class="calculator-wrapper">
  <div class="calculator-title">
    <h2>Masukan Data Aktivitas Karbonmu</h2>
    <p>Isi informasi kendaraan dan aktivitas sehari-harimu<br>untuk menghitung emisi CO2 secara otomatis.</p>
  </div>
  <div class="tabs">
    <button class="tab-btn active" data-target="darat"><span>🚗</span> Transportasi Darat</button>
    <button class="tab-btn" data-target="laut"><span>🚢</span> Transportasi Laut</button>
    <button class="tab-btn" data-target="udara"><span>✈️</span> Transportasi Udara</button>
    <button class="tab-btn" data-target="rumah"><span>🏠</span> Peralatan Rumah Tangga</button>
  </div>
  <div class="section-title" id="jenisKendaraanTitle">Jenis Kendaraan</div>
  <div class="selection-grid" id="vehicleGrid"></div>
  <div class="section-title" id="jenisBahanBakarTitle">Jenis Bahan Bakar</div>
  <div class="selection-grid" id="fuelGrid"></div>
  <hr class="divider">
  <div style="font-size:15px;font-weight:600;text-align:center;margin-bottom:10px;">Masukan Informasi Perjalanan Untuk
    Menghitung Estimasi Emisi Karbonmu</div>
  <form id="carbonForm" onsubmit="return false;">
    <div id="input-rumah-group" style="display:none;">
      <div class="select-group">
        <label for="lokasi">Lokasi</label>
        <select id="lokasi">
          <option value="">Pilih Lokasi</option>
          <option value="Sumatera">Sumatera</option>
          <option value="Jawa">Jawa</option>
          <option value="Kalimantan">Kalimantan</option>
          <option value="Sulawesi">Sulawesi</option>
          <option value="Papua">Papua</option>
        </select>
      </div>
      <div class="select-group">
        <label for="output_solar">Output Solar PV</label>
        <div class="input-suffix">
          <input type="number" id="output_solar" placeholder="Contoh: 1000">
          <span>kWh/Wp</span>
        </div>
      </div>
      <div class="select-group">
        <label for="golongan_tarif">Golongan Tarif</label>
        <select id="golongan_tarif">
          <option value="">Pilih Golongan Tarif</option>
          <option value="R-1">R-1</option>
          <option value="R-2">R-2</option>
          <option value="R-3">R-3</option>
          <option value="B-2">B-2</option>
        </select>
      </div>
      <div class="select-group">
        <label for="daya_pln">Daya Terpasang PLN</label>
        <select id="daya_pln">
          <option value="">Pilih Daya Terpasang PLN</option>
          <option value="450">450 VA</option>
          <option value="900">900 VA</option>
          <option value="1300">1300 VA</option>
          <option value="2200">2200 VA</option>
          <option value="3500">3500 VA</option>
        </select>
      </div>
      <div class="select-group">
        <label for="tipe">Tipe</label>
        <select id="tipe">
          <option value="VA">VA</option>
          <option value="Wp">Wp</option>
        </select>
      </div>
      <div class="select-group">
        <label for="tagihan">Tagihan Rata - Rata (bulanan)</label>
        <div class="input-suffix">
          <input type="number" id="tagihan" placeholder="Contoh: 500000">
          <span>kWh</span>
        </div>
      </div>
      <div class="select-group">
        <label for="tipe_modul">Tipe Modul</label>
        <select id="tipe_modul">
          <option value="">Pilih Tipe Modul</option>
          <option value="Mono">Mono</option>
          <option value="Poly">Poly</option>
        </select>
      </div>
      <div class="select-group">
        <label for="jenis_kalkulator">Jenis Kalkulator</label>
        <select id="jenis_kalkulator">
          <option value="">Pilih Jenis Kalkulator</option>
          <option value="PLN">PLN</option>
          <option value="Mandiri">Mandiri</option>
        </select>
      </div>
    </div>
    <div class="input-row" id="input-transportasi-group">
      <div class="input-group" id="input-jarak">
        <label class="input-label" for="jarak">Jarak Tempuh (km)</label>
        <input type="number" id="jarak" placeholder="Contoh: 50">
        <div class="error-msg" id="error-jarak"></div>
      </div>
      <div class="input-group" id="input-daya" style="display:none;">
        <label class="input-label" for="daya">Daya (Watt)</label>
        <input type="number" id="daya" placeholder="Contoh: 100">
      </div>
      <div class="input-group" id="input-penumpang">
        <label class="input-label" for="penumpang">Jumlah Penumpang</label>
        <input type="number" id="penumpang" placeholder="Contoh: 1">
        <div class="error-msg" id="error-penumpang"></div>
      </div>
      <div class="input-group" id="input-jumlah-alat" style="display:none;">
        <label class="input-label" for="jumlah_alat">Jumlah Peralatan</label>
        <input type="number" id="jumlah_alat" placeholder="Contoh: 1">
      </div>
      <div class="input-group" id="input-frekuensi">
        <label class="input-label" for="frekuensi">Frekuensi (Hari/Minggu)</label>
        <input type="number" id="frekuensi" placeholder="Contoh: 5">
        <div class="error-msg" id="error-frekuensi"></div>
      </div>
      <div class="input-group" id="input-durasi" style="display:none;">
        <label class="input-label" for="durasi">Durasi Pemakaian (Jam/Hari)</label>
        <input type="number" id="durasi" placeholder="Contoh: 8">
      </div>
    </div>
    <div class="input-row">
      <div class="input-group">
        <label class="input-label" for="emisi_per_km" id="label-emisi">Faktor Emisi (kg CO₂/km)</label>
        <div class="output-label" id="emisi_per_km">0.00</div>
      </div>
      <div class="input-group">
        <label class="input-label" for="total_emisi">Total Emisi (kg)</label>
        <div class="output-label" id="total_emisi">0.00</div>
      </div>
    </div>

    <div class="result-card">
      <div>
        <div class="result-label">Total Emisi (ton)</div>
        <div class="result-value" id="resultEmisi">0,00 ton CO2e</div>
      </div>
      <div>
        <div class="result-label">Perkiraan Biaya Offset</div>
        <div class="result-value" id="resultOffset">Rp. 0</div>
      </div>
    </div>
    <div class="button-row">
      <button class="btn-calc btn-add">+ Tambah Kendaraan Lain</button>
      <button class="btn-calc btn-submit">Lanjutkan</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
const transportasiData = {
  'darat': {
    vehicles: [{
        name: 'Mobil',
        icon: '🚗'
      },
      {
        name: 'Motor',
        icon: '🏍️'
      },
      {
        name: 'Bus',
        icon: '🚌'
      },
      {
        name: 'Kereta',
        icon: '🚆'
      }
    ],
    fuels: [{
        name: 'Pertalite'
      },
      {
        name: 'Pertamax'
      },
      {
        name: 'Solar'
      },
      {
        name: 'Electric'
      },
      {
        name: 'Diesel'
      },
      {
        name: 'Bensin (BBM)'
      }
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
    vehicles: [{
        name: 'Kapal Penumpang',
        icon: '⛴️'
      },
      {
        name: 'Kapal Barang',
        icon: '🚢'
      }
    ],
    fuels: [{
        name: 'Solar'
      },
      {
        name: 'LNG'
      }
    ],
    emissionFactors: {
      'Kapal Penumpang': {
        'Solar': 0.25,
        'LNG': 0.18
      },
      'Kapal Barang': {
        'Solar': 0.30,
        'LNG': 0.22
      }
    }
  },
  'udara': {
    vehicles: [{
        name: 'Pesawat Komersil',
        icon: '✈️'
      },
      {
        name: 'Pesawat Pribadi',
        icon: '🛩️'
      }
    ],
    fuels: [{
      name: 'Avtur'
    }],
    emissionFactors: {
      'Pesawat Komersil': {
        'Avtur': 0.90
      },
      'Pesawat Pribadi': {
        'Avtur': 1.20
      }
    }
  },
  'rumah': {
    vehicles: [{
        name: 'AC',
        icon: '❄️'
      },
      {
        name: 'Kulkas',
        icon: '🧊'
      },
      {
        name: 'Lampu',
        icon: '💡'
      },
      {
        name: 'Mesin Cuci',
        icon: '🧺'
      }
    ],
    fuels: [{
      name: 'Listrik'
    }],
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

let currentTransport = 'darat';
let selectedVehicle = null;
let selectedFuel = null;

function renderVehicleAndFuel() {
  const vehicleGrid = document.getElementById('vehicleGrid');
  const fuelGrid = document.getElementById('fuelGrid');
  vehicleGrid.innerHTML = '';
  fuelGrid.innerHTML = '';
  // Render kendaraan
  transportasiData[currentTransport].vehicles.forEach((v, idx) => {
    const div = document.createElement('div');
    div.className = 'selection-card' + (idx === 0 ? ' selected' : '');
    div.setAttribute('data-vehicle', v.name);
    div.innerHTML = `<span class='icon'>${v.icon || ''}</span>${v.name}`;
    div.onclick = function() {
      document.querySelectorAll('#vehicleGrid .selection-card').forEach(card => card.classList.remove(
        'selected'));
      div.classList.add('selected');
      selectedVehicle = v.name;
      renderFuelOptions();
      updateEmissionFactor();
    };
    vehicleGrid.appendChild(div);
    if (idx === 0) selectedVehicle = v.name;
  });
  // Render bahan bakar
  renderFuelOptions();
}

function renderFuelOptions() {
  const fuelGrid = document.getElementById('fuelGrid');
  fuelGrid.innerHTML = '';
  const fuels = transportasiData[currentTransport].fuels;
  let firstFuel = null;
  fuels.forEach((f, idx) => {
    // Cek apakah kendaraan ini support bahan bakar ini
    const ef = transportasiData[currentTransport].emissionFactors[selectedVehicle];
    if (ef && ef[f.name] !== undefined) {
      const div = document.createElement('div');
      div.className = 'selection-card' + (firstFuel === null ? ' selected' : '');
      div.setAttribute('data-fuel', f.name);
      div.innerHTML = `<span class='icon'><i class='fa fa-gas-pump'></i></span>${f.name}`;
      div.onclick = function() {
        document.querySelectorAll('#fuelGrid .selection-card').forEach(card => card.classList.remove('selected'));
        div.classList.add('selected');
        selectedFuel = f.name;
        updateEmissionFactor();
      };
      fuelGrid.appendChild(div);
      if (firstFuel === null) {
        selectedFuel = f.name;
        firstFuel = f.name;
      }
    }
  });
  updateEmissionFactor();
}

function updateEmissionFactor() {
  const ef = transportasiData[currentTransport].emissionFactors[selectedVehicle];
  let value = (ef && selectedFuel && ef[selectedFuel]) ? ef[selectedFuel] : 0;
  document.getElementById('emisi_per_km').textContent = value.toFixed(2);
  calculateTotalEmission();
}

function updateInputFields() {
  if (currentTransport === 'rumah') {
    document.getElementById('input-jarak').style.display = 'none';
    document.getElementById('input-penumpang').style.display = 'none';
    document.getElementById('input-daya').style.display = '';
    document.getElementById('input-jumlah-alat').style.display = '';
    document.getElementById('input-durasi').style.display = '';
    document.getElementById('label-emisi').innerText = 'Emisi/kWh (kg CO2 e)';
    document.getElementById('input-rumah-group').style.display = '';
    document.getElementById('input-transportasi-group').style.display = 'none';
  } else {
    document.getElementById('input-jarak').style.display = '';
    document.getElementById('input-penumpang').style.display = '';
    document.getElementById('input-daya').style.display = 'none';
    document.getElementById('input-jumlah-alat').style.display = 'none';
    document.getElementById('input-durasi').style.display = 'none';
    document.getElementById('label-emisi').innerText = 'Emisi/km (kg CO2 e)';
    document.getElementById('input-rumah-group').style.display = 'none';
    document.getElementById('input-transportasi-group').style.display = '';
  }
}

function validatePositiveInput(id, label) {
  const input = document.getElementById(id);
  const errorDiv = document.getElementById(`error-${id}`);
  const value = parseFloat(input.value);

  if (isNaN(value) || value <= 0) {
    input.classList.add('invalid');
    errorDiv.innerText = 'Input tidak valid';
    errorDiv.style.display = 'block';
    return false;
  } else {
    input.classList.remove('invalid');
    errorDiv.innerText = '';
    errorDiv.style.display = 'none';
    return true;
  }
}



function calculateTotalEmission() {
  if (currentTransport === 'rumah') {
    // Contoh rumus: emisi = output_solar * faktor_emisi (misal 0.85)
    const output = parseFloat(document.getElementById('output_solar').value) || 0;
    const faktor = 0.85; // bisa diubah sesuai kebutuhan
    const total = output * faktor;
    document.getElementById('total_emisi').textContent = total.toFixed(2);
    document.getElementById('resultEmisi').innerText = (total / 1000).toFixed(2) + ' ton CO2e';
    let offset = Math.round((total / 1000) * 190000);
    document.getElementById('resultOffset').innerText = 'Rp. ' + offset.toLocaleString('id-ID');
    return;
  }
  const jarak = parseFloat(document.getElementById('jarak').value) || 0;
  const penumpang = parseFloat(document.getElementById('penumpang').value) || 1;
  const frekuensi = parseFloat(document.getElementById('frekuensi').value) || 1;
  const emisiPerKm = parseFloat(document.getElementById('emisi_per_km').textContent) || 0;
  let total = jarak * emisiPerKm * frekuensi * penumpang;
  // if (currentTransport !== 'rumah') {
  //   total = total / penumpang;
  // }
  document.getElementById('total_emisi').textContent = total.toFixed(2);
  document.getElementById('resultEmisi').innerText = (total).toFixed(2) + ' ton CO2e';
  let offset = Math.round(total * 500);
  document.getElementById('resultOffset').innerText = 'Rp. ' + offset.toLocaleString('id-ID');
}

document.addEventListener('DOMContentLoaded', function() {
  // Tab switching
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      currentTransport = this.getAttribute('data-target');
      renderVehicleAndFuel();
      // Reset input
      document.getElementById('jarak').value = '';
      document.getElementById('penumpang').value = '';
      document.getElementById('frekuensi').value = '';
      document.getElementById('total_emisi').textContent = '';
      document.getElementById('emisi_per_km').textContent = '';
      document.getElementById('resultEmisi').innerText = '0,00 ton CO2e';
      document.getElementById('resultOffset').innerText = 'Rp. 0';
      // Judul
      document.getElementById('jenisKendaraanTitle').innerText = currentTransport === 'rumah' ?
        'Jenis Peralatan' : 'Jenis Kendaraan';
      document.getElementById('jenisBahanBakarTitle').innerText = currentTransport === 'rumah' ?
        'Sumber Energi' : 'Jenis Bahan Bakar';
      updateInputFields();
    });
  });
  // Input listeners
  ['jarak', 'penumpang', 'frekuensi', 'daya', 'jumlah_alat', 'durasi'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('input', function() {
      if (['jarak', 'penumpang', 'frekuensi'].includes(id)) {
        if (parseFloat(this.value) <= 0) {
          this.style.borderColor = 'red';
        } else {
          this.style.borderColor = '#EAEAEA';
        }
      }
      calculateTotalEmission();
    });
  });
  ['output_solar', 'lokasi', 'golongan_tarif', 'daya_pln', 'tipe', 'tagihan', 'tipe_modul', 'jenis_kalkulator']
  .forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('input', calculateTotalEmission);
    if (el && el.tagName === 'SELECT') el.addEventListener('change', calculateTotalEmission);
  });
  updateInputFields();
  renderVehicleAndFuel();
  document.querySelector('.btn-submit').addEventListener('click', function(e) {
    e.preventDefault();

    const validJarak = validatePositiveInput('jarak', 'Jarak Tempuh');
    const validPenumpang = validatePositiveInput('penumpang', 'Jumlah Penumpang');
    const validFrekuensi = validatePositiveInput('frekuensi', 'Frekuensi');

    if (!validJarak || !validPenumpang || !validFrekuensi) return;

    // Kumpulkan data
    let jenis = currentTransport;
    let kendaraan = document.querySelector('#vehicleGrid .selection-card.selected')?.innerText.trim() || '';
    let bahan_bakar = document.querySelector('#fuelGrid .selection-card.selected')?.innerText.trim() || '';
    let data = {
      jenis: jenis,
      jenis_kendaraan: kendaraan,
      bahan_bakar: bahan_bakar,
      jarak: document.getElementById('jarak')?.value || 0,
      penumpang: document.getElementById('penumpang')?.value || 1,
      frekuensi: document.getElementById('frekuensi')?.value || 1,
      emisi_per_km: document.getElementById('emisi_per_km').textContent || 0,
      daya: document.getElementById('daya')?.value || 0,
      jumlah_alat: document.getElementById('jumlah_alat')?.value || 1,
      durasi: document.getElementById('durasi')?.value || 0
    };
    fetch('/offset/calculate', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then(res => {
        if (res.success) {
          window.location.href = '/offset';
        }
      });
  });
});
</script>
@endpush