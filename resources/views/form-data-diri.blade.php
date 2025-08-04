@extends('layouts.master')
@section('title', 'Form Data Diri - Carbon Offset')

@push('styles')
<style>
.form-container {
  max-width: 700px;
  margin: 32px auto;
  padding: 0 16px;
}

.form-header {
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
  padding: 32px 24px;
  margin-bottom: 24px;
  text-align: center;
}

.form-title {
  font-size: 24px;
  font-weight: 700;
  color: #222;
  margin-bottom: 8px;
}

.form-subtitle {
  color: #666;
  font-size: 14px;
  line-height: 1.5;
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

.order-summary {
  background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
  border: 1.5px solid #7AC142;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 24px;
}

.order-summary-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.order-summary-item h4 {
  font-size: 12px;
  color: #666;
  margin: 0 0 4px 0;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.order-summary-item p {
  font-size: 18px;
  font-weight: 700;
  margin: 0;
}

.order-summary-item.total p {
  color: #7AC142;
}

.order-summary-location {
  padding-top: 12px;
  border-top: 1px solid rgba(122, 193, 66, 0.3);
  font-size: 12px;
  color: #666;
}

.form-card {
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
  padding: 32px 32px 24px 32px;
  margin-bottom: 24px;
}

.form-card-title {
  font-size: 20px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 32px;
  color: #222;
}

.form-group {
  margin-bottom: 24px;
}

.form-label {
  display: flex;
  align-items: center;
  font-size: 14px;
  font-weight: 600;
  color: #333;
  margin-bottom: 8px;
}

.form-label svg {
  width: 16px;
  height: 16px;
  margin-right: 8px;
  color: #666;
}

.form-label .optional {
  color: #999;
  font-size: 12px;
  font-weight: 400;
  margin-left: 8px;
}

.form-label .required {
  color: #ef4444;
  margin-left: 4px;
}

.form-input {
  width: 100%;
  padding: 14px 16px;
  border: 1.5px solid #EAEAEA;
  border-radius: 8px;
  font-size: 15px;
  transition: all 0.2s;
  background: #fff;
}

.form-input:focus {
  outline: none;
  border-color: #7AC142;
  box-shadow: 0 0 0 3px rgba(122, 193, 66, 0.1);
}

.form-input::placeholder {
  color: #999;
}

.submit-btn {
  width: 100%;
  background: #7AC142;
  color: #fff;
  border: none;
  border-radius: 12px;
  padding: 16px 0;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s;
  margin-top: 16px;
  box-shadow: 0 4px 12px rgba(122, 193, 66, 0.3);
}

.submit-btn:hover {
  background: #6bb13b;
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(122, 193, 66, 0.4);
}

.submit-btn:disabled {
  background: #ccc;
  cursor: not-allowed;
  transform: none;
  box-shadow: none;
}

.loading-spinner {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 2px solid #ffffff;
  border-radius: 50%;
  border-top-color: transparent;
  animation: spin 1s ease-in-out infinite;
  margin-right: 8px;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.terms-text {
  text-align: center;
  font-size: 12px;
  color: #666;
  margin-top: 16px;
  line-height: 1.4;
}

.terms-text a {
  color: #7AC142;
  text-decoration: none;
}

.terms-text a:hover {
  text-decoration: underline;
}

.security-notice {
  text-align: center;
  margin-top: 24px;
}

.security-badge {
  display: inline-flex;
  align-items: center;
  background: #eff6ff;
  color: #1d4ed8;
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
}

.security-badge::before {
  content: '';
  width: 8px;
  height: 8px;
  background: #3b82f6;
  border-radius: 50%;
  margin-right: 8px;
}

@media (max-width: 768px) {
  .form-container {
    padding: 0 12px;
  }
  
  .form-card {
    padding: 24px 20px;
  }
  
  .order-summary-content {
    flex-direction: column;
    gap: 16px;
    text-align: center;
  }
}
</style>
@endpush

@section('content')
<div class="form-container">
  <!-- Back Button -->
  <a href="/offset" class="back-btn">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
    Kembali ke Ringkasan
  </a>

  <!-- Header -->
  <div class="form-header">
    <h1 class="form-title">Lengkapi Data Diri Anda</h1>
    <p class="form-subtitle">Isi data diri untuk melanjutkan proses carbon offset Anda</p>
  </div>

  <!-- Order Summary -->
  <div class="order-summary">
    <div class="order-summary-content">
      <div class="order-summary-item">
        <h4>Total Emisi</h4>
        <p>{{ number_format($total_emisi ?? 0, 2, ',', '.') }} Kg CO2</p>
      </div>
      <div class="order-summary-item total">
        <h4>Biaya Offset</h4>
        <p>Rp {{ number_format($biaya_offset ?? 0, 0, ',', '.') }}</p>
      </div>
    </div>
    <!-- <div class="order-summary-location">
      <strong>Lokasi:</strong> {{ $lokasi_terpilih ?? 'Proyek Mangrove di Teluk Benoa Bali' }}
    </div> -->
  </div>

  <!-- Form Card -->
  <div class="form-card">
    <h2 class="form-card-title">Data Diri</h2>
    <form id="formDataDiri" method="POST" action="{{ route('submit-data-diri') }}">
      @csrf
      <!-- Hidden fields untuk data emisi -->
      <input type="hidden" name="lokasi_terpilih" value="{{ $lokasi_terpilih }}">
      <input type="hidden" name="lokasi_gambar" value="{{ $lokasi_gambar }}">
      <input type="hidden" name="bahan_bakar" value="{{ $bahan_bakar }}">
      <input type="hidden" name="total_emisi" value="{{ $total_emisi }}">
      <input type="hidden" name="biaya_offset" value="{{ $biaya_offset }}">

      <!-- Nama Perusahaan -->
      <div class="form-group">
        <label for="nama_perusahaan" class="form-label">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          Nama Perusahaan/Organisasi
          <span class="required">*</span>
        </label>
        <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-input"
          placeholder="Masukkan nama perusahaan atau organisasi" required value="{{ old('nama_perusahaan') }}">
        @error('nama_perusahaan')
        <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
        @enderror
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email" class="form-label">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          Email
          <span class="required">*</span>
        </label>
        <input type="email" id="email" name="email" class="form-input" placeholder="contoh@email.com" required
          value="{{ old('email') }}">
        @error('email')
        <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
        @enderror
      </div>

      <!-- Nama Lengkap -->
      <div class="form-group">
        <label for="nama_lengkap" class="form-label">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          Nama Lengkap
          <span class="required">*</span>
        </label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input"
          placeholder="Masukkan nama lengkap Anda" required value="{{ old('nama_lengkap') }}">
        @error('nama_lengkap')
        <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
        @enderror
      </div>

      <!-- Nomor HP -->
      <div class="form-group">
        <label for="nomor_hp" class="form-label">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
          Nomor HP
          <span class="required">*</span>
        </label>
        <input type="tel" id="nomor_hp" name="nomor_hp" class="form-input" placeholder="08xxxxxxxxxx" required
          value="{{ old('nomor_hp') }}">
        @error('nomor_hp')
        <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
        @enderror
      </div>

      <!-- Submit Button -->
      <button type="submit" class="submit-btn" id="submitBtn">
        <span id="btnText">Melanjutkan Pembayaran</span>
        <span id="btnLoading" style="display: none;">
          <span class="loading-spinner"></span>
          Memproses...
        </span>
      </button>

      <!-- Terms -->
      <div class="terms-text">
        Dengan melanjutkan, Anda menyetujui
        <a href="#">Syarat & Ketentuan</a> dan
        <a href="#">Kebijakan Privasi</a> kami
      </div>
    </form>
  </div>

  <!-- Security Notice -->
  <div class="security-notice">
    <div class="security-badge">
      Data Anda dilindungi dengan enkripsi SSL 256-bit
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('formDataDiri').addEventListener('submit', function(e) {
  const submitBtn = document.getElementById('submitBtn');
  const btnText = document.getElementById('btnText');
  const btnLoading = document.getElementById('btnLoading');
  
  // Show loading state
  submitBtn.disabled = true;
  btnText.style.display = 'none';
  btnLoading.style.display = 'inline-flex';
});
</script>
@endpush
