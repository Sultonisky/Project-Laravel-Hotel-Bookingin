<!-- resources/views/tentang-kami.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BerbagiLagi - Contact</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/contact.css') }}">
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
                <li><a href="{{ route('beranda') }}"
                        class="nav-link {{ Request::is('beranda') ? 'active' : '' }}">Home</a>
                </li>
                <li><a href="{{ route('items') }}"
                        class="nav-link {{ Request::is('items') ? 'active' : '' }}">Barang</a></li>
                <li><a href="{{ route('about') }}" class="nav-link {{ Request::is('about') ? 'active' : '' }}">Tentang
                        Kami</a></li>
                <li><a href="{{ route('contact') }}"
                        class="nav-link {{ Request::is('contact') ? 'active' : '' }}">Kontak Kami</a></li>
            </ul>
            <div class="nav-icons">
                <a href="{{ url('/history') }}">
                    <img src="{{ asset('admin_assets/icons/history.png') }}" alt="History" class="history-icon"></a>
                <button class="btn-primary">Penerima</button>
                <img src="{{ asset('admin_assets/icons/logout.png') }}" alt="Logout" class="logout-icons">
            </div>

        </div>

    </nav>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="contact-section">
        <div class="contact-container">
            <h1>Hubungi Kami</h1>
            <p>Punya pertanyaan, saran, atau ingin berdonasi? Kami siap membantu Anda.</p>

            <div class="contact-info">
                <a href="#" class="contact-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="contact-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="contact-icon"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="contact-icon"><i class="fab fa-youtube"></i></a>
            </div>

            <form action="{{ route('contactStore') }}" method="POST" class="feedback-form">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="messages">Kritik dan Saran</label>
                    <textarea id="messages" name="messages" rows="5" required></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </section>

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
