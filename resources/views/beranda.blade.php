@extends('layouts.master')
@section('title', 'Beranda')

@push('styles')
<style>
/* Reset & box-sizing */
*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Container hero penuh layar, background image */
.hero {
  position: relative;
  width: 100%;
  height: calc(100vh - 72px);
  display: flex;
  align-items: center;
  padding: 0 7vw;
  overflow: hidden;
}

/* Pseudo-element untuk background dengan opacity 8% */
.hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background: url('{{ asset("assets/images/page1_1//bg.png") }}') center/cover no-repeat;
  opacity: 1;
  z-index: 1;
}

/* Lapisan putih di atas bg, untuk meratakan kontras */
.hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.4);
  z-index: 2;
}

/* Wrapper teks kiri */
.hero-text {
  flex: 1;
  max-width: 650px;
  color: #000;
  font-family: 'Poppins';
  z-index: 3
}

.hero-text .subtitle {
  font-size: 14px;
  font-weight: 500;
  color: #678C2D;
  margin-bottom: 8px;
  text-transform: uppercase;
  letter-spacing: 1px;
  z-index: 3;
}

.hero-text h1 {
  font-size: 3rem;
  font-weight: 450;
  line-height: 1.2;
  margin-bottom: 16px;
}

.hero-text p {
  font-size: 1rem;
  line-height: 1.6;
  color: #555;
  margin-bottom: 32px;
  max-width: 480px;
}

.hero-text .btn-start {
  display: inline-block;
  padding: 12px 32px;
  background-color: #80A33E;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  border-radius: 4px;
  text-decoration: none;
  transition: background .3s, transform .3s;
}

.hero-text .btn-start:hover {
  background-color: #5a7a1c;
  transform: translateY(-2px);
}

/* Lingkaran dekorasi */
.ellipse {
  position: absolute;
  width: 350px;
  height: 500px;
  background: url('{{ asset("assets/images/page1_1/ellipse.png") }}') center/contain no-repeat;
  pointer-events: none;
  opacity: 1;
  z-index: 3;
}

.ellipse.top-right {
  top: -40px;
  right: -30px;
}

/* Gambar kendaraan */
.img-motor,
.img-mobil {
  position: absolute;
  border-radius: 50%;
  object-fit: cover;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.img-motor {
  top: 60px;
  right: 230px;
  z-index: 4;
  width: 210px;
  height: 210px;
}

.img-mobil {
  bottom: 70px;
  right: 60px;
  width: 270px;
  height: 260px;
  z-index: 4;
}

/* ===== Section “Apa itu Carbon Footprint?” ===== */
.about {
  background-color: #FFFDE7;
  padding: 80px 0 60px 0;
  /* ruang atas dan bawah */
  position: relative;
}

.about-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  /* semua anak dirapatkan ke bawah */
  gap: 60px;
  max-width: 1200px;
  margin: 0 auto;
  padding-bottom: 0;
  /* hapus padding/margin bottom di container */
}

.about-image-wrapper {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 380px;
  /* ukuran gambar yang lebih kecil */
  height: auto;
  z-index: 2;
}

.about-circle {
  width: 100%;
  height: auto;
  display: block;
}

.about-photo {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.about-text {
  text-align: left;
  /* teks rata kiri */
  max-width: 800px;
  margin-top: 2px;
  /* beri jarak atas */
  margin-bottom: 60px;
  /* dan juga jarak bawah */
  margin-left: 410px;
}


.about-text p {
  color: #777777;
  font-family: 'Poppins';
  font-size: 1.1rem;
  line-height: 1.6;
}


/* Responsive */
@media (max-width: 1024px) {
  .hero-text h1 {
    font-size: 2.5rem;
  }

  .ellipse {
    width: 300px;
    height: 300px;
  }

  .img-motor,
  .img-mobil {
    width: 180px;
    height: 180px;
  }

  .about-image-wrapper {
    width: 250px;
  }

  .about-text {
    margin-left: 270px;
  }
}

@media (max-width: 768px) {
  .hero {
    flex-direction: column;
    justify-content: center;
    text-align: center;
  }

  .hero-text {
    max-width: 100%;
  }

  .img-motor,
  .img-mobil,
  .ellipse {
    display: none;
  }

  .about-container {
    flex-direction: column;
    text-align: center;
  }

  .about-image-wrapper {
    position: static;
    width: 100%;
    margin-bottom: 20px;
  }

  .about-photo {
    position: static;
    width: 80%;
    margin: 0 auto;
  }

  .about-text {
    margin-left: 0;
    margin-bottom: 40px;
  }



}
</style>
@endpush

@section('content')
<section class="hero">
  <div class="ellipse top-right"></div>
  <div class="hero-text">
    <div class="subtitle">Calculator Karbon</div>
    <h1>Hitung Jejak Karbon<br>Kendaraanmu Sekarang</h1>
    <p>
      Setiap perjalanan meninggalkan jejak—tapi kamu bisa bertanggung jawab. Mulai sekarang, ukur emisi kendaraanmu dan
      ambil langkah kecil untuk masa depan bumi yang lebih bersih dan lestari.
    </p>
    <a href="{{ route('kalkulator') }}" class="btn-start">Mulai Hitung Sekarang</a>
  </div>
  <img src="{{ asset('assets/images/page1_1//mobil.png') }}" alt="Mobil" class="img-mobil">
  <img src="{{ asset('assets/images/page1_1//motor.png') }}" alt="Motor" class="img-motor">
</section>

<section class="about">
  <div class="about-container">
    <div class="about-image-wrapper">
      <img src="{{ asset('assets/images/page1_2/asset1_2.2.png') }}" alt="Lingkaran Biru" class="about-circle">
      <img src="{{ asset('assets/images/page1_2/asset1_2.1.png') }}" alt="Orang & Turbin" class="about-photo">
    </div>
    <div class="about-text">
      <h2>Apa itu Carbon Footprint ?</h2> <br>
      <p>
        Jejak karbon adalah jumlah total emisi gas rumah kaca—terutama karbon dioksida (CO₂)—yang dihasilkan oleh
        aktivitas manusia.
        Contohnya, saat kita mengendarai motor atau mobil, membakar bahan bakar menghasilkan CO₂ yang ikut mencemari
        udara dan mempercepat perubahan iklim.
        Dengan menghitung jejak karbon kendaraanmu, kamu bisa lebih sadar dampak aktivitas sehari-hari terhadap
        lingkungan,
        dan ikut serta mengurangi emisi dengan langkah sederhana seperti menanam pohon atau ikut program carbon offset.
      </p>
    </div>
  </div>
</section>
@endsection