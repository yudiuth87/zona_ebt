<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'PPSDM')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    /* Reset & Box-sizing */
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
      background-color: #f4f7fa;
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 50px; /* Mengurangi padding untuk mengurangi tinggi header */
      background-color: #fff;
      border-bottom: 1px solid #e0e0e0;
      flex-shrink: 0;
      position: relative;
      z-index: 100;
    }
    .branding {
      display: flex;
      align-items: center;
      font-weight: bold;
      font-size: 24px;
      color: #333;
    }


  .logo-image {
  height: 40px;  
  width: auto;
  object-fit: contain;
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
      transition: opacity 0.3s ease, width 0.3s ease;
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

    /* Main Content */
    main {
      flex: 1 0 auto;
      width: 100%;
      margin: 0;
      padding: 0;
      background: none;
      box-shadow: none;
    }
    .next-section {
      height: auto !important;
      min-height: 100vh;
    }

    /* Footer */
    footer {
      flex-shrink: 0;
      background-color: #fff;
      padding: 20px 50px;
      border-top: 1px solid #e0e0e0;
      margin-top: 0;
    }

    /* Search Area Styles */
    .search-area {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .search-input-wrapper {
      display: flex;
      align-items: center;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
      transition: max-width 0.3s ease-out, opacity 0.3s ease-out;
      border-radius: 5px;
      border: 1px solid #ddd;
      background-color: #f8f8f8;
    }

    .search-input-wrapper.active {
      max-width: 250px;
      opacity: 1;
      padding: 0 5px;
    }

    .search-input-wrapper input {
      border: none;
      padding: 8px 0;
      font-size: 15px;
      outline: none;
      background: transparent;
      width: 100%;
    }

    .search-input-wrapper input::placeholder {
      color: #999;
    }

    .search-submit-btn {
      background: none;
      border: none;
      color: #555;
      cursor: pointer;
      padding: 0 5px;
      font-size: 18px;
      transition: color 0.2s ease;
    }

    .search-submit-btn:hover {
      color: #87C34E;
    }

    .search-toggle-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 24px;
      color: #555;
      transition: opacity 0.3s ease;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .search-toggle-btn.hidden {
      opacity: 0;
      pointer-events: none;
    }

    /* Highlighted text style */
    .highlight {
      background-color: #FFE066; /* Warna kuning cerah */
      padding: 2px 0;
      border-radius: 3px;
      transition: background-color 0.2s ease;
    }

    .highlight.current-highlight {
      background-color: #FFC107; /* Warna kuning lebih gelap untuk highlight aktif */
      box-shadow: 0 0 5px rgba(255, 193, 7, 0.7);
    }

    /* Search count display */
    .search-count {
      font-size: 13px;
      color: #666;
      margin-left: 10px;
      white-space: nowrap; /* Pastikan tidak pecah baris */
      min-width: 80px; /* Beri lebar minimum agar tidak bergeser */
      text-align: right;
    }

    /* Navigation buttons for search results */
    .search-nav-buttons {
      display: flex;
      gap: 5px;
      margin-left: 10px;
    }

    .search-nav-buttons button {
      background: #f0f0f0;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 5px 8px;
      cursor: pointer;
      font-size: 14px;
      color: #555;
      transition: background 0.2s ease, border-color 0.2s ease;
    }

    .search-nav-buttons button:hover:not(:disabled) {
      background: #e0e0e0;
      border-color: #ccc;
    }

    .search-nav-buttons button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .header {
        padding: 10px 20px; /* Mengurangi padding pada mobile juga */
        flex-wrap: wrap;
        justify-content: space-between;
      }
      .branding {
        flex-grow: 1;
      }
      nav {
        display: none;
      }
      .search-area {
        order: 2;
        margin-left: auto;
        width: auto;
      }
      .search-input-wrapper.active {
        max-width: calc(100% - 40px);
        position: absolute;
        top: 50px; /* Sesuaikan posisi top karena header lebih pendek */
        left: 20px;
        right: 20px;
        background-color: #fff;
        padding: 10px 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 100;
      }
      .search-input-wrapper {
        border: none;
      }
      .search-toggle-btn {
        display: block;
      }
      .search-count, .search-nav-buttons {
        display: none; /* Sembunyikan di mobile untuk menghemat ruang */
      }
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
  <img src="{{ asset('assets/images/logo.png') }}" alt="ZonaEBT Logo" class="logo-image">
</div>
    <nav>
      <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
      <a href="{{ route('kalkulator') }}" class="{{ request()->routeIs('kalkulator') ? 'active' : '' }}">Kalkulator</a>
    </nav>
    <div class="search-area">
      <div class="search-input-wrapper" id="searchInputWrapper">
        <input type="text" id="searchInput" placeholder="Cari di halaman ini...">
        <button id="searchSubmitBtn" class="search-submit-btn" aria-label="Cari">
          <i class='bx bx-search'></i>
        </button>
      </div>
      <span class="search-count" id="searchCount"></span> <!-- Untuk menampilkan jumlah hasil -->
      <div class="search-nav-buttons" id="searchNavButtons" style="display: none;">
        <button id="prevResultBtn" aria-label="Hasil Sebelumnya">&lt;</button>
        <button id="nextResultBtn" aria-label="Hasil Selanjutnya">&gt;</button>
      </div>
      <button class="search-toggle-btn" id="searchToggleBtn" aria-label="Buka Pencarian">
        <i class='bx bx-search'></i>
      </button>
    </div>
  </div>

  {{-- Konten Halaman --}}
  <main id="mainContent"> <!-- Tambahkan ID pada main untuk target pencarian -->
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('components.footer')

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchToggleBtn = document.getElementById('searchToggleBtn');
      const searchInputWrapper = document.getElementById('searchInputWrapper');
      const searchInput = document.getElementById('searchInput');
      const searchSubmitBtn = document.getElementById('searchSubmitBtn');
      const searchCount = document.getElementById('searchCount');
      const searchNavButtons = document.getElementById('searchNavButtons');
      const prevResultBtn = document.getElementById('prevResultBtn');
      const nextResultBtn = document.getElementById('nextResultBtn');
      const mainContent = document.getElementById('mainContent');

      let originalContent = mainContent.innerHTML; // Simpan konten asli
      let highlightedElements = []; // Array untuk menyimpan semua elemen highlight
      let currentHighlightIndex = -1; // Indeks highlight yang sedang aktif

      function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
      }

      function highlightText(query) {
        // Kembalikan konten ke kondisi asli sebelum menyorot yang baru
        mainContent.innerHTML = originalContent;
        highlightedElements = []; // Reset array highlight
        currentHighlightIndex = -1; // Reset indeks
        searchCount.textContent = ''; // Reset count
        searchNavButtons.style.display = 'none'; // Sembunyikan tombol navigasi

        if (!query) {
          return;
        }

        const escapedQuery = escapeRegExp(query);
        const regex = new RegExp(`(${escapedQuery})`, 'gi');

        // Fungsi rekursif untuk memproses node teks
        function processNode(node) {
          if (node.nodeType === Node.TEXT_NODE) {
            const parentTagName = node.parentNode.tagName;
            if (parentTagName === 'SCRIPT' || parentTagName === 'STYLE' || node.parentNode.classList.contains('highlight')) {
              return;
            }

            const text = node.nodeValue;
            if (text.match(regex)) {
              const fragment = document.createDocumentFragment();
              let lastIndex = 0;
              text.replace(regex, (match, p1, offset) => {
                fragment.appendChild(document.createTextNode(text.substring(lastIndex, offset)));

                const span = document.createElement('span');
                span.className = 'highlight';
                span.textContent = match;
                fragment.appendChild(span);
                highlightedElements.push(span); // Tambahkan ke array

                lastIndex = offset + match.length;
                return match;
              });
              fragment.appendChild(document.createTextNode(text.substring(lastIndex)));
              node.parentNode.replaceChild(fragment, node);
            }
          } else if (node.nodeType === Node.ELEMENT_NODE) {
            if (node.classList.contains('highlight') || node.tagName === 'SCRIPT' || node.tagName === 'STYLE') {
              return;
            }
            for (let i = 0; i < node.childNodes.length; i++) {
              processNode(node.childNodes[i]);
            }
          }
        }

        processNode(mainContent);

        if (highlightedElements.length > 0) {
          currentHighlightIndex = 0; // Set indeks pertama
          updateHighlightDisplay(); // Perbarui tampilan highlight
          searchNavButtons.style.display = 'flex'; // Tampilkan tombol navigasi
        } else {
          searchCount.textContent = '0 hasil ditemukan';
        }
      }

      function updateHighlightDisplay() {
        // Hapus highlight aktif sebelumnya
        highlightedElements.forEach((el, idx) => {
          el.classList.remove('current-highlight');
        });

        if (highlightedElements.length > 0 && currentHighlightIndex >= 0 && currentHighlightIndex < highlightedElements.length) {
          const currentElement = highlightedElements[currentHighlightIndex];
          currentElement.classList.add('current-highlight'); // Tambahkan kelas highlight aktif
          currentElement.scrollIntoView({ behavior: 'smooth', block: 'center' }); // Scroll ke elemen aktif

          searchCount.textContent = `${currentHighlightIndex + 1} dari ${highlightedElements.length} hasil`;
        } else {
          searchCount.textContent = `${highlightedElements.length} hasil ditemukan`;
        }

        // Atur status tombol navigasi
        prevResultBtn.disabled = currentHighlightIndex <= 0;
        nextResultBtn.disabled = currentHighlightIndex >= highlightedElements.length - 1;
      }

      function navigateToHighlight(direction) {
        if (highlightedElements.length === 0) return;

        let newIndex = currentHighlightIndex + direction;
        
        // Logika melingkar
        if (newIndex >= highlightedElements.length) {
          newIndex = 0; // Kembali ke awal jika sudah di akhir
        } else if (newIndex < 0) {
          newIndex = highlightedElements.length - 1; // Kembali ke akhir jika sudah di awal
        }

        currentHighlightIndex = newIndex;
        updateHighlightDisplay();
      }

      function toggleSearch() {
        const isActive = searchInputWrapper.classList.toggle('active');
        searchToggleBtn.classList.toggle('hidden', isActive);

        if (isActive) {
          searchInput.focus();
          if (searchInput.value.trim()) {
            highlightText(searchInput.value.trim());
          }
        } else {
          searchInput.value = '';
          mainContent.innerHTML = originalContent; // Kembalikan konten asli
          searchCount.textContent = '';
          searchNavButtons.style.display = 'none'; // Sembunyikan tombol navigasi
          highlightedElements = []; // Kosongkan array highlight
          currentHighlightIndex = -1; // Reset indeks
        }
      }

      // Event listeners
      searchToggleBtn.addEventListener('click', toggleSearch);
      searchInput.addEventListener('input', function() {
        highlightText(this.value.trim());
      });
      searchSubmitBtn.addEventListener('click', function() {
        if (!searchInput.value.trim()) {
          toggleSearch();
        }
      });
      
      // MODIFIKASI UTAMA DI SINI: Perilaku tombol Enter
      searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
          event.preventDefault(); // Mencegah pengiriman form default
          
          const query = this.value.trim();
          if (query) {
            // Jika ada query, navigasi ke hasil selanjutnya (atau kembali ke awal)
            if (highlightedElements.length > 0) {
              navigateToHighlight(1); // Pindah ke hasil selanjutnya
            } else {
              // Jika belum ada highlight (mungkin baru pertama kali ketik Enter)
              // Lakukan highlight dan navigasi ke yang pertama
              highlightText(query);
            }
          } else {
            // Jika input kosong, tutup search bar
            toggleSearch();
          }
        }
      });

      prevResultBtn.addEventListener('click', () => navigateToHighlight(-1));
      nextResultBtn.addEventListener('click', () => navigateToHighlight(1));

      document.addEventListener('click', function(event) {
        if (searchInputWrapper.classList.contains('active') &&
            !searchToggleBtn.contains(event.target) &&
            !searchInputWrapper.contains(event.target) &&
            !searchNavButtons.contains(event.target)) {
          toggleSearch();
        }
      });

      searchInput.addEventListener('click', function(event) {
        event.stopPropagation();
      });

      // Simpan konten asli setelah DOM sepenuhnya dimuat
      originalContent = mainContent.innerHTML;
    });
  </script>
  @stack('scripts')
</body>
</html>
