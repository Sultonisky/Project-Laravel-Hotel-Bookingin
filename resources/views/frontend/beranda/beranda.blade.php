<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BerbagiLagi - Home</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/home.css') }}">
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
                <img src="{{ asset('admin_assets/icons/search-1.svg') }}" alt="Search">
                <img src="{{ asset('admin_assets/icons/bell.svg') }}" alt="Notif">
                <button class="btn-primary">{{ Auth::user()->role }}</button>
            </div>
        </div>
    </nav>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-left">
            <img src="{{ asset('admin_assets/img/hero2.png') }}" alt="Hero 1">
            <img src="{{ asset('admin_assets/img/hero1.png') }}" alt="Hero 2">
        </div>
        <div class="hero-right">
            <h1>Kita Satu, Kita Peduli</h1>
            <p>Wujudkan solidaritas dalam aksi nyata. <br>
                Bantu saudara kita meraih kehidupan yang lebih baik.</p>
            <form id="keluar-app" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a href="" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"
                class="lihat-btn">Mulai Donasi </a>
        </div>
    </section>

    <section class="produk-hero">
        <div class="produk-kiri">
            <h1>Berbagi Baju, Merajut Rasa Peduli</h1>
            <p>Semua orang layak merasa dihargai dan diperhatikan.</p>
            <a href="{{ route('items') }}" class="lihat-btn">Lihat Semua > </a>
        </div>

        @foreach ($items as $item)
            <div class="produk-kanan">
                <div class="produk-card">
                    <form action="{{ route('itemsClaim', $item->id) }}" action="POST">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <img src="{{ asset('storage/img-items/' . $item->foto) }}" alt="Produk">
                        <div class="produk-info">
                            <h3>{{ $item->category->name }} - {{ $item->name }}</h3>
                            <p>
                                @if ($item->status == 'tersedia')
                                    <span>Tersedia</span>
                                @elseif($item->status == 'proses')
                                    <span>Proses</span>
                                @elseif($item->status == 'didonasikan')
                                    <span>Didonasikan</span>
                                @endif | {{ $item->condition }}
                            </p>
                            <p>{{ $item->description }}</p>
                            <button type="submit">Ajukan Permintaan +</button>
                        </div>
                    </form>
                </div>


            </div>
        @endforeach
    </section>


    <section class="masukan-section">
        <div class="masukan-container">
            <h2 class="masukan-heading">Ada Masukan?</h2>
            <p class="masukan-subheading">Yuk, bantu kami jadi lebih baik lagi.</p>

            <div class="testimoni-wrapper">
                <div class="testimoni-card">
                    <div class="user-info">
                        <img src="{{ asset('admin_assets/img/profile1.png') }}" alt="Jacob Jones" class="user-avatar">
                        <div>
                            <strong>Jacob Jones</strong><br>
                            <small>Donatur</small>
                        </div>
                    </div>
                    <p>“Senang sekali bisa ikut berbagi lewat platform ini. Prosesnya mudah dan saya yakin bantuan saya
                        sampai ke yang benar-benar membutuhkan.”</p>
                </div>

                <div class="testimoni-card">
                    <div class="user-info">
                        <img src="{{ asset('admin_assets/img/profile2.png') }}" alt="Annette Black"
                            class="user-avatar">
                        <div>
                            <strong>Annette Black</strong><br>
                            <small>Penerima</small>
                        </div>
                    </div>
                    <p>“Kami tidak merasa dikasihani, justru merasa didukung. Terima kasih sudah membuat kami merasa
                        dihargai.”</p>
                </div>

                <div class="testimoni-card">
                    <div class="user-info">
                        <img src="{{ asset('admin_assets/img/profile3.png') }}" alt="Jenny Wilson" class="user-avatar">
                        <div>
                            <strong>Jenny Wilson</strong><br>
                            <small>Penerima</small>
                        </div>
                    </div>
                    <p>“Baju-baju yang awalnya cuma tersimpan di lemari, sekarang punya arti baru. Terima kasih sudah
                        jadi jembatan kebaikan.”</p>
                </div>

                <div class="testimoni-card">
                    <div class="user-info">
                        <img src="{{ asset('admin_assets/img/profile4.png') }}" alt="Robert Fox" class="user-avatar">
                        <div>
                            <strong>Robert Fox</strong><br>
                            <small>Penerima</small>
                        </div>
                    </div>
                    <p>“Bajunya bagus dan bersih, seperti kiriman dari teman dekat. Terima kasih sudah peduli.”</p>
                </div>
            </div>

            <a href="#" class="btn-masukan">Beri Masukan</a>
        </div>
    </section>

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
