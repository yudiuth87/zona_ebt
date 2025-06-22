<style>
    .footer-container {
        background-color: #8A814C;
        color: #fff;
        padding: 50px 0;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow: hidden;
    }
    .footer-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 10 90 A 80 80 0 0 1 90 10' stroke='%2399925E' stroke-width='15' fill='none'/%3E%3Cpath d='M 20 95 A 75 75 0 0 1 95 20' stroke='%2399925E' stroke-width='15' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right -150px bottom -150px;
        opacity: 0.2;
        transform: rotate(180deg);
    }
    .footer-content {
        max-width: 1200px;
        margin: auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        position: relative;
        z-index: 1;
    }
    .footer-section {
        padding-right: 20px;
    }
    .footer-section h4 {
        font-size: 18px;
        margin-bottom: 20px;
        font-weight: 700;
    }
    .footer-section p, .footer-section ul li {
        font-size: 14px;
        line-height: 1.8;
        color: #E0E0E0;
    }
    .footer-section ul {
        list-style: none;
        padding: 0;
    }
    .footer-section ul li a {
        color: #E0E0E0;
        text-decoration: none;
        transition: color 0.3s;
    }
    .footer-section ul li a:hover {
        color: #fff;
    }
    .social-icons {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }
    .social-icons a img {
        width: 20px;
        height: 20px;
    }
    .komdigi-section {
        grid-column: 1 / -1;
        margin-top: 30px;
    }
    .komdigi-section h4 {
        font-size: 18px;
        margin-bottom: 15px;
    }
    .payment-section {
        grid-column: 1 / -1;
        margin-top: 40px;
        text-align: center;
    }
    .payment-section h4 {
        font-size: 14px;
        font-weight: 400;
        color: #E0E0E0;
        margin-bottom: 20px;
    }
    .payment-logos {
        background-color: #fff;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }
    .payment-logos img {
        height: 25px;
    }
    .footer-bottom {
        text-align: center;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #99925E;
    }
    .footer-bottom p {
        font-size: 12px;
        color: #E0E0E0;
    }
</style>

<footer class="footer-container">
    <div class="footer-bg"></div>
    <div class="footer-content">
        <div class="footer-section">
            <div class="branding" style="font-size: 30px; margin-bottom: 15px;">
                <span class="logo-z" style="color:#C0D461;">Z</span><span class="logo-e" style="color:#87C34E;">E</span>onaEBT
            </div>
            <p>zonaebt.com merupakan platform informasi dan edukasi energi terbarukan di Indonesia.</p>
        </div>
        <div class="footer-section">
            <h4>Layanan Kami</h4>
            <ul>
                <li><a href="#">ZE News</a></li>
                <li><a href="#">ZE Career</a></li>
                <li><a href="#">ZE Affiliate</a></li>
                <li><a href="#">ZE Data</a></li>
                <li><a href="#">ZE Jobs</a></li>
                <li><a href="#">ZE Academy</a></li>
                <li><a href="#">Pedoman Media Siber</a></li>
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
                <a href="#"><img src="{{ asset('assets/images/facebook-logo.png') }}" alt="Facebook"></a>
                <a href="#"><img src="{{ asset('assets/images/instagram.png') }}" alt="Instagram"></a>
                <a href="#"><img src="{{ asset('assets/images/whatsapp.png') }}" alt="Whatsapp"></a>
            </div>
        </div>
        <div class="footer-section">
            <h4>Bantuan</h4>
            <ul>
                <li><a href="#">Syarat dan Ketentuan ZE Academy</a></li>
                <li><a href="#">Syarat dan Ketentuan ZE Jobs</a></li>
            </ul>
        </div>
        <div class="komdigi-section">
            <h4>Bisnis Terdaftar di Sistem Komdigi</h4>
            <img src="{{ asset('assets/images/ppsdm-logo.png') }}" alt="PSE Kominfo" style="height: 50px; background: white; padding: 5px; border-radius: 5px;">
            <p style="font-size: 12px; margin-top: 10px;">
                PT.Bala Biotech Indonesia<br>
                No 02334.1/DJAI.PSE/04/2025<br>
                Diterbitkan pada Tanggal 2025-04-19 oleh Menteri Komunikasi dan Informatika dan Menteri Investasi/Kepala Badan Koordinasi Penanaman Modal.
            </p>
        </div>
        <div class="payment-section">
            <h4>Transaksi aman didukung oleh</h4>
            <div class="payment-logos">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1200px-Visa_Inc._logo.svg.png" alt="Visa">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/ShopeePay_logo.svg/1200px-ShopeePay_logo.svg.png" alt="ShopeePay">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1200px-Logo_dana_blue.svg.png" alt="Dana">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/1200px-Logo_ovo_purple.svg.png" alt="OVO">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Mastercard_2019_logo.svg/1200px-Mastercard_2019_logo.svg.png" alt="Mastercard">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri">
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2025 © zonaebt.com - PT Bala Biotech Indonesia ALL RIGHT RESERVED</p>
    </div>
</footer>
