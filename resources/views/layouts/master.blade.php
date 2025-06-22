<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PPSDM')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
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
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            flex-grow: 1;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p, ul {
            font-size: 16px;
            line-height: 1.6;
        }

        ul {
            padding-left: 20px;
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
