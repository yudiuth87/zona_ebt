<style>
/* Footer Container */
.footer-container {
  background-color: #766402; /* Darker, modern blue-grey */
  color: #F0F0F0; /* Light grey for text */
  padding: 60px 0;
  font-family: 'Poppins', sans-serif;
  position: relative;
  overflow: hidden;
} 

/* Background Pattern (Subtle) */
.footer-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 10 90 A 80 80 0 0 1 90 10' stroke='%23333333' stroke-width='15' fill='none'/%3E%3Cpath d='M 20 95 A 75 75 0 0 1 95 20' stroke='%23333333' stroke-width='15' fill='none'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right -150px bottom -150px;
  opacity: 0.1; /* More subtle opacity */
  transform: rotate(180deg);
  z-index: 0; /* Ensure it's behind content */
}

/* Main Content Grid */
.footer-content {
  max-width: 1200px;
  margin: auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Adjusted min-width for better flow */
  gap: 40px; /* Increased gap */
  position: relative;
  z-index: 1;
}

/* Individual Footer Sections */
.footer-section {
  padding-right: 0; /* Remove padding-right */
}

.footer-section h4 {
  font-size: 18px;
  margin-bottom: 20px;
  font-weight: 700;
  color: #F0F0F0; /* Consistent heading color */
}

.footer-section p, .footer-section ul li {
  font-size: 14px;
  line-height: 1.8;
  color: #E0E0E0; /* Slightly darker text for readability */
}

.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  margin-bottom: 10px; /* Spacing for list items */
}

.footer-section ul li a {
  color: #E0E0E0;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer-section ul li a:hover {
  color: #7AC142; /* Highlight color on hover */
}

/* Branding */
.branding {
  font-size: 32px; /* Slightly larger logo */
  font-weight: 700;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
}

.branding .logo-z {
  color: #C0D461;
}

.branding .logo-e {
  color: #87C34E;
}

/* Social Icons */
.social-icons {
  display: flex;
  gap: 15px;
  margin-top: 20px; /* More space */
}

.social-icons a {
  color: #F0F0F0;
  font-size: 24px; /* Larger icons */
  transition: color 0.3s ease, transform 0.2s ease;
}

.social-icons a:hover {
  color: #7AC142; /* Highlight color on hover */
  transform: translateY(-3px);
}

/* Komdigi Section */
.komdigi-section {
  grid-column: span 2; /* Span 2 columns on larger screens */
  margin-top: 0; /* Adjust margin */
}

.komdigi-section h4 {
  margin-bottom: 15px;
}

.komdigi-section img {
  height: 60px; /* Larger logo */
  background: #fff;
  padding: 8px; /* More padding */
  border-radius: 8px; /* Slightly more rounded */
  box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Subtle shadow */
}

.komdigi-section p {
  font-size: 13px; /* Slightly larger text */
  margin-top: 15px;
  line-height: 1.6;
}

/* Payment Section */
.payment-section {
  grid-column: span 2; /* Span 2 columns on larger screens */
  margin-top: 0; /* Adjust margin */
  text-align: center;
}

.payment-section h4 {
  font-size: 16px; /* Slightly larger heading */
  font-weight: 600;
  color: #F0F0F0;
  margin-bottom: 20px;
}

.payment-logos {
  background-color: #fff;
  border-radius: 15px;
  padding: 25px; /* More padding */
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 25px; /* Increased gap between logos */
  box-shadow: 0 8px 20px rgba(0,0,0,0.15); /* More prominent shadow */
}

.payment-logos img {
  height: 30px; /* Larger logos */
  transition: all 0.3s ease;
}

.payment-logos img:hover {
  transform: scale(1.05);
}

/* Footer Bottom */
.footer-bottom {
  text-align: center;
  margin-top: 60px; /* More space from content */
  padding-top: 30px; /* More padding */
  border-top: 1px solid #333333; /* Darker, subtle border */
}

.footer-bottom p {
  font-size: 13px; /* Slightly larger text */
  color: #E0E0E0;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .footer-content {
    grid-template-columns: 1fr; /* Single column on small screens */
    gap: 30px;
    padding: 0 15px;
  }

  .komdigi-section,
  .payment-section {
    grid-column: auto; /* Reset grid-column for single column layout */
    text-align: left; /* Align text left on small screens */
  }

  .payment-logos {
    padding: 20px;
    gap: 20px;
  }

  .payment-logos img {
    height: 25px;
  }

  .footer-bottom {
    margin-top: 40px;
    padding-top: 20px;
  }
}

@media (max-width: 480px) {
  .footer-container {
    padding: 40px 0;
  }

  .branding {
    font-size: 28px;
  }

  .footer-section h4 {
    font-size: 16px;
  }

  .footer-section p, .footer-section ul li {
    font-size: 13px;
  }

  .social-icons a {
    font-size: 20px;
  }

  .komdigi-section img {
    height: 50px;
  }

  .komdigi-section p {
    font-size: 12px;
  }

  .payment-logos {
    padding: 15px;
    gap: 15px;
  }

  .payment-logos img {
    height: 20px;
  }

  .footer-bottom p {
    font-size: 11px;
  }
}
</style>

<footer class="footer-container">
  <div class="footer-bg"></div>
  <div class="footer-content">
    <div class="footer-section">
      <div class="branding" style="margin-bottom: 15px;">
    <img src="{{ asset('assets/images/logo.png') }}" alt="ZonaEBT Logo" style="height: 60px; object-fit: contain;">
</div>
      <p>zonaebt.com merupakan platform informasi dan edukasi energi terbarukan di Indonesia.</p>
    </div>


    <div class="footer-section">
      <h4>Layanan Kami</h4>
      <ul>
        <li><a href="https://zonaebt.com/news-media/">ZE News</a></li>
        <li><a href="https://zonaebt.com/ze-career/">ZE Career</a></li>
        <li><a href="https://zonaebt.com/ze-affiliate/">ZE Affiliate</a></li>
        <li><a href="https://zonaebt.com/ze-data/">ZE Data</a></li>
        <li><a href="https://zonaebt.com/green-jobs/">ZE Jobs</a></li>
        <li><a href="https://zonaebt.com/category/event/">ZE Academy</a></li>
        <li><a href="https://zonaebt.com/pedoman-pemberitaan-media-siber-2/">Pedoman Media Siber</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h4>Kontak Kami</h4>
      <p>
        JL. Pesanggrahan No.6, RW.5, Meruya Utara, Kec. Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11620
      </p>
      <p>
        +62 851-7587-8765<br>
        hello@zonaebt.com
      </p>
      <div class="social-icons">
        <a href="https://www.linkedin.com/company/zonaebt/" aria-label="LinkedIn"><i class="bx bx-md bxl-linkedin"></i></a>
        <a href="https://www.instagram.com/zonaebt/" aria-label="Instagram"><i class='bx bx-md bxl-instagram'></i></a>
        <a href="https://api.whatsapp.com/send/?phone=6282146020448&text&type=phone_number&app_absent=0" aria-label="WhatsApp"><i class='bx bx-md bxl-whatsapp'></i></a>
      </div>
    </div>

    <div class="footer-section">
      <h4>Bantuan</h4>
      <ul>
        <li><a href="https://zonaebt.com/syarat-dan-ketentuan-ze-academy/">Syarat dan Ketentuan ZE Academy</a></li>
        <li><a href="https://zonaebt.com/syarat-ketentuan/">Syarat dan Ketentuan ZE Jobs</a></li>
      </ul>
    </div>

    <div class="komdigi-section">
      <h4>Bisnis Terdaftar di Sistem Komdigi</h4>
      <img src="{{ asset('assets/images/ppsdm-logo.png') }}" alt="PSE Kominfo">
      <p>
        PT.Bala Biotech Indonesia<br>
        No 02334.1/DJAI.PSE/04/2025<br>
        Diterbitkan pada Tanggal 2025-04-19 oleh Menteri Komunikasi dan Informatika dan Menteri Investasi/Kepala Badan Koordinasi Penanaman Modal.
      </p>
    </div>

      <div class="payment-section">
      <h4>Transaksi aman didukung oleh</h4>
      <div class="payment-logos">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1200px-Visa_Inc._logo.svg.png" alt="Visa">
        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Shopee.svg" alt="ShopeePay">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt=qris>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/1200px-Logo_ovo_purple.svg.png" alt="OVO">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Mastercard_2019_logo.svg/1200px-Mastercard_2019_logo.svg.png" alt="Mastercard">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/LinkAja.svg/640px-LinkAja.svg.png" alt=linkaja>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1200px-Logo_dana_blue.svg.png" alt="Dana">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/BRI_2020.svg/640px-BRI_2020.svg.png" alt=bri>
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/BNI_2004.svg" alt=bni>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/640px-Gopay_logo.svg.png" alt=gopay>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Logo_Indomaret.png/640px-Logo_Indomaret.png" alt=indo>
        <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Alfamart_logo.svg" alt=alfa>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/BCA_LOGO.jpg/640px-BCA_LOGO.jpg" alt=bca>
      </div>
    </div>
  </div>



  <div class="footer-bottom">
    <p>© 2025 © zonaebt.com - PT Bala Biotech Indonesia ALL RIGHT RESERVED</p>
  </div>
</footer>
