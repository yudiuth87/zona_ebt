@extends('layouts.master')
@section('title', 'Beranda')

@section('content')

<style>
/* reset sederhana */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* appbar di atas */
.appbar {
  width: 100%;
  padding: 16px;
  background-color: #fff;
  display: flex;
  align-items: center;
}

.logo {
  height: 40px;
  /* sesuaikan tinggi logo */
}

/* hero section */
.hero {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  padding: 40px;
  background-color: #f5dd0f;
  /* kuning */
  min-height: calc(100vh - 72px);
  /* kurangi tinggi header */
}

.hero-text {
  flex: 1 1 320px;
  max-width: 600px;
}

/* menggunakan font Poppins, bold, warna #83A243 */
.hero-text h1 {
  font-family: "Poppins", sans-serif;
  /* font Poppins */
  font-weight: 700;
  /* bold */
  color: #83a243;
  /* warna hijau */
  font-size: 2rem;
  margin-bottom: 19px;
  margin-left: 19px;
  /* geser lebih jauh ke kanan */
  /* jarak ke <p> */
  /* text-transform: capitalize; */
}

.hero-text p {
  /* font-family: 'Poppins', sans-serif;   sama font */
  font-size: 1.5rem;
  /* heading 5 approx */
  color: #ffffff;
  /* sama warna */
  margin-bottom: 32px;
  /* jarak ke tombol atau elemen berikutnya */
  margin-left: 19px;
  line-height: 1.5;
}

.btn-container {
  position: relative;
  width: 300px;
  height: 50px;
  background: #fff;
  border-radius: 25px;
  overflow: hidden;
}

.btn-slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 150px;
  height: 50px;
  line-height: 50px;
  text-align: center;
  background: #6b8e23;
  color: #fff;
  font-family: "Poppins", sans-serif;
  font-weight: 700;
  text-decoration: none;
  border-radius: 25px;
  transition: left 0.5s ease;
  animation: pulse 2s infinite;
}

.btn-slide.slide-right {
  left: calc(100% - 150px);
}

/* wrapper untuk menumpuk gambar */
.hero-image-wrapper {
  position: relative;
  /* agar anak absolute diposisikan relatif wrapper */
  flex: 1 1 280px;
  height: 400px;
  /* atur tinggi sesuai kebutuhan */
}

/* gambar welcome1 di belakang */
.welcome-bg {
  position: absolute;
  top: 20px;
  /* geser lebih jauh ke bawah */
  transform: translateY(-70px);
  /* geser naik 20px */
  left: 490px;
  /* geser ke kanan */
  max-width: 100%;
  height: auto;
  /* width: 200px; atur ukuran */
  z-index: 1;
  /* di bawah */
}

/* gambar hero utama di atas */
.hero-image {
  position: absolute;
  top: 20px;
  /* geser lebih jauh ke bawah */
  transform: translateY(-70px);
  /* geser naik 20px */
  left: 430px;
  /* geser lebih jauh ke kanan */
  max-width: 100%;
  height: auto;
  z-index: 2;
  /* di atas welcome-bg */
}

/* section kosong setelah hero */
.next-section {
  height: 100vh;
  /* bisa disesuaikan */
}

/* responsiveness */
@media (max-width: 768px) {
  .hero {
    flex-direction: column;
    text-align: center;
  }

  .hero-text,
  .hero-image-wrapper {
    max-width: none;
  }

  .hero-image-wrapper {
    height: 300px;
  }

  .welcome-bg {
    top: 20px;
    left: 20px;
    width: 150px;
  }

  .hero-image {
    top: 60px;
    left: 60px;
  }
}

@keyframes pulse {
  0% {
    transform: scale(1);
    box-shadow: 0 0 0 rgba(107, 142, 35, 0.7);
  }

  50% {
    transform: scale(1.05);
    box-shadow: 0 0 10px rgba(107, 142, 35, 0.7);
  }

  100% {
    transform: scale(1);
    box-shadow: 0 0 0 rgba(107, 142, 35, 0.7);
  }
}
</style>


<section class="hero">
  <div class="hero-text">
    <h1>Dari Data ke Aksi, untuk Bumi</h1>
    <h1>yang Lebih Hijau.</h1>

    <p>Hitung emisi karbonmu, pelajari energi terbarukan, dan mulai perubahan hari ini.</p>

    <div class="btn-container">
      <a href="#" class="btn-slide">Mulai</a>
    </div>
  </div>

  <div class="hero-image-wrapper">
    <img src="{{ asset('assets/images/welcome1.png') }}" alt="background welcome" class="welcome-bg">
    <img src="{{ asset('assets/images/welcome.png') }}" alt="illustration" class="hero-image">
  </div>
</section>


<div class="curve">
  <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
    <path d="M0,...Z" class="shape-fill"></path>
  </svg>
</div>

@endsection

{{-- Script slide & scroll seperti semula --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.querySelector('.btn-slide');

  // reset posisi tombol tiap kali halaman dibuka
  btn.classList.remove('slide-right');

  btn.addEventListener('click', () => {
    btn.classList.add('slide-right');
  });

  btn.addEventListener('transitionend', e => {
    if (e.propertyName === 'left') {
      // Redirect ke route kalkulator setelah animasi selesai
      window.location.href = "{{ route('kalkulator') }}";
    }
  });
});
</script>
@endpush