<footer class="footer-pro py-4 mt-5 text-white position-relative">
    <div class="footer-gradient position-absolute top-0 start-0 w-100 h-100" style="z-index:0;"></div>
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center gy-4">
            <!-- Brand & Tagline -->
            <div class="col-md-4 text-center text-md-start">
                <div class="d-flex flex-column align-items-center align-items-md-start gap-2">
                    <img src="{{ asset('backend/images/logo-putih.png') }}" alt="Bookingin Logo" style="height: 38px; width: auto;">
                    <span class="fw-bold fs-5">Bookingin</span>
                    <span class="small opacity-75">Temukan kamar impian &amp; nikmati suasana tanpa batas</span>
                </div>
            </div>
            <!-- Kontak & Alamat -->
            <div class="col-md-4 text-center">
                <div class="mb-2 small">
                    <i class="bi bi-geo-alt-fill me-1"></i> Jl. Contoh Alamat No. 123, Jakarta, Indonesia
                </div>
                <div class="mb-2 small">
                    <a href="mailto:info@bookingin.com" class="footer-link"><i class="bi bi-envelope me-1"></i>info@bookingin.com</a>
                </div>
                <div class="mb-2 small">
                    <a href="https://wa.me/6281234567890" class="footer-link"><i class="bi bi-whatsapp me-1"></i>+62 812-3456-7890</a>
                </div>
            </div>
            <!-- Social Media -->
            <div class="col-md-4 text-center text-md-end">
                <div class="d-flex justify-content-center justify-content-md-end gap-3 mb-2">
                    <a href="https://instagram.com/yourhotel" target="_blank" class="footer-icon" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="https://facebook.com/yourhotel" target="_blank" class="footer-icon" title="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="footer-icon" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>
                <span class="small opacity-75">Follow us for updates</span>
            </div>
        </div>
        <hr class="border-light opacity-25 my-3" style="margin:0 auto;">
        <div class="text-center small opacity-75">
            &copy; {{ date('Y') }} Bookingin. All rights reserved.
        </div>
    </div>
    <style>
        .footer-pro {
            background: transparent;
            overflow: hidden;
        }
        .footer-gradient {
            background: linear-gradient(135deg, #024aff 0%, #007bff 100%);
            opacity: 0.97;
            pointer-events: none;
        }
        .footer-icon {
            color: #fff;
            font-size: 2.1rem;
            margin: 0 6px;
            transition: color 0.2s, transform 0.2s;
            display: inline-block;
        }
        .footer-icon:hover {
            color: #010101;
            transform: scale(1.15) rotate(-6deg);
            text-shadow: 0 2px 12px #fff2;
        }
        .footer-link {
            color: #fff;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-link:hover {
            color: #010101;
            text-decoration: underline;
        }
        .footer-pro hr {
            border-top: 1.5px solid #fff;
            opacity: 0.2;
        }
        @media (max-width: 767.98px) {
            .footer-pro .row > div {
                text-align: center !important;
            }
            .footer-pro .d-flex {
                justify-content: center !important;
                align-items: center !important;
            }
        }
        @media (max-width: 576px) {
            .footer-icon { font-size: 1.4rem; }
            .footer-pro .fw-bold.fs-5 { font-size: 1.1rem; }
        }
    </style>
</footer>
