<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'PPSDM')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <style>
  /* Atur tinggi minimum, biar footer bisa muncul setelah konten */
  html {
    box-sizing: border-box;
  }

  *,
  *::before,
  *::after {
    box-sizing: inherit;
  }

  body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    /* pastikan minimal setinggi viewport */
    background-color: #f4f7fa;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 50px;
    background-color: #fff;
    border-bottom: 1px solid #e0e0e0;
    flex-shrink: 0;
  }

  .branding {
    display: flex;
    align-items: center;
    font-weight: bold;
    font-size: 24px;
    color: #333;
  }

  .branding .logo-z {
    color: #C0D461;
  }

  .branding .logo-e {
    color: #87C34E;
  }

  nav {
    display: flex;
    gap: 40px;
  }

  nav a {
    color: #555;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    position: relative;
    padding-bottom: 5px;
  }

  nav a:hover,
  nav a.active {
    color: #000;
  }

  nav a.active::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background-color: #87C34E;
  }

  .search-icon img {
    height: 24px;
    cursor: pointer;
  }

  main {
    flex: 1 0 auto;
    /* bisa tumbuh, tapi tidak memaksa memperkecil footer */
    width: 100%;
    margin: 0;
    padding: 0;
    background: none;
    box-shadow: none;
  }

  /* pastikan section yang berisi hero dan konten lain tidak menutup footer */
  .next-section {
    height: auto !important;
    min-height: 100vh;
  }

  /* styling dasar footer */
  footer {
    flex-shrink: 0;
    background-color: #fff;
    padding: 20px 50px;
    border-top: 1px solid #e0e0e0;
    margin-top: 0;
  }
  </style>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

  @stack('styles')
</head>

<body>

  {{-- Header --}}
  <div class="header">
    <div class="branding">
      <span class="logo-z">Z</span><span class="logo-e">E</span>onaEBT
    </div>

    <nav>
      <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
      <a href="{{ route('kalkulator') }}" class="{{ request()->routeIs('kalkulator') ? 'active' : '' }}">Kalkulator</a>
      <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
    </nav>

    <div class="search-icon">
      <img src="{{ asset('assets/images/search.png') }}" alt="Search">
    </div>
  </div>

  {{-- Konten Halaman --}}
  <main>
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('components.footer')

  @stack('scripts')
</body>

</html>