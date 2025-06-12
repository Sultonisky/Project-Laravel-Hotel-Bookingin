<!-- resources/views/tentang-kami.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BerbagiLagi - Home</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/about.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="{{ asset('admin_assets/img/logo_berbagilagi.png') }}" width="250">
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('beranda') }}">Home</a></li>
                <li><a href="{{ route('items') }}">Barang</a></li>
                <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                <li><a href="{{ route('contact') }}">Kontak Kami</a></li>
            </ul>
            <div class="nav-icons">
                <a href="{{ route('history') }}">
                    <img src="{{ asset('admin_assets/icons/history.png') }}" alt="Notif" class="notif-icon"></a>
                <button class="btn-primary">{{ Auth::user()->role }}</button>
                <a href="" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"><img
                        src="{{ asset('admin_assets/icons/logout.png') }}" alt="Logout" class="logout-icons"></a>
            </div>
        </div>
    </nav>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- Body Content -->
    <main class="about-page">
        <section class="hero-section">
            <div class="hero-content">
                <h2>Siapa Kami?</h2>
                <p>Kami adalah komunitas yang percaya bahwa kebaikan bisa dimulai dari hal-hal sederhana—seperti berbagi
                    barang yang tak lagi terpakai, tapi masih penuh arti.</p>
            </div>
        </section>

        <section class="section two-column">
            <div class="image">
                <img src="{{ asset('admin_assets/img/tentang1.png') }}" alt="Relawan">
            </div>
            <div class="text">
                <h3>Mengapa Kami Bergerak</h3>
                <p>Kami hadir untuk mempertemukan kebaikan hati mereka yang ingin membantu, kesulitan yang dihadapi
                    mereka yang membutuhkan, dengan sistem distribusi berbagi yang transparan, empati, dan mudah diakses
                    berbagai kalangan.</p>
            </div>
        </section>

        <section class="section two-column reverse">
            <div class="image">
                <img src="{{ asset('admin_assets/img/tentang1.png') }}" alt="Relawan">
            </div>
            <div class="text">
                <h3>Cara Kami Menyalurkan Donasi</h3>
                <div class="donation-step">
                    <img src="{{ asset('admin_assets/icons/step-1.png') }}" alt="Step 1">
                    <div class="step-text">
                        <strong>Terima Donasi</strong>
                        <p>Barang dikumpulkan dari donatur melalui drop-off atau pengambilan.</p>
                    </div>
                </div>

                <div class="donation-step">
                    <img src="{{ asset('admin_assets/icons/step-2.png') }}" alt="Step 2">
                    <div class="step-text">
                        <strong>Sortir & Cek Kualitas</strong>
                        <p>Hanya barang layak pakai yang akan disalurkan.</p>
                    </div>
                </div>

                <div class="donation-step">
                    <img src="{{ asset('admin_assets/icons/step-3.png') }}" alt="Step 3">
                    <div class="step-text">
                        <strong>Pilah Sesuai Kebutuhan</strong>
                        <p>Barang dikategorikan berdasarkan jenis dan penerima.</p>
                    </div>
                </div>

                <div class="donation-step">
                    <img src="{{ asset('admin_assets/icons/step-4.png') }}" alt="Step 4">
                    <div class="step-text">
                        <strong>Salurkan ke Penerima</strong>
                        <p>Didistribusikan melalui mitra atau langsung ke penerima.</p>
                    </div>
                </div>

                <div class="donation-step">
                    <img src="{{ asset('admin_assets/icons/step-5.png') }}" alt="Step 5">
                    <div class="step-text">
                        <strong>Laporan & Evaluasi</strong>
                        <p>Kami dokumentasikan dan terus perbaiki setiap prosesnya.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <form id="keluar-app" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <footer class="footer">
        <hr class="footer-divider" />
        <div class="footer-content">
            <img src="{{ asset('admin_assets/img/logo_berbagilagi.png') }}" alt="Logo BerbagiLagi"
                class="footer-logo" />

            <p class="footer-description">
                BerbagiLagi adalah platform untuk berbagi kebutuhan kepada yang membutuhkan.
            </p>

            <div class="footer-socials">
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>
