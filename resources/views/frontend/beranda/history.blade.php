<!-- resources/views/notifikasi.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BerbagiLagi - Notifikasi</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/history.css') }}">
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
                    <img src="{{ asset('admin_assets/icons/history-white.png') }}" alt="Notif"
                        class="notif-icon"></a>
                <button class="btn-primary">{{ Auth::user()->role }}</button>
                <a href="" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"><img
                        src="{{ asset('admin_assets/icons/logout.png') }}" alt="Logout" class="logout-icons"></a>
            </div>
        </div>
    </nav>

    <div class="request-list">
        <!-- Header -->
        <div class="request-header">
            <span>Gambar</span>
            <span>Nama</span>
            <span>Tanggal Acc</span>
            <span>Waktu Acc</span>
            <span>Claimed At</span>
            <span>Claimed By</span>
            <span>Status</span>
        </div>

        @foreach ($claims as $claim)
            <div class="request-card">
                <img src="{{ asset('storage/img-items/' . $claim->item->foto) }}" alt="Item" class="item-image">
                <div class="item-nama">{{ $claim->item->name }}</div>
                <div class="item-tanggal">{{ $claim->approved_at ? $claim->approved_at->format('d M Y') : '-' }}</div>
                <div class="item-waktu">{{ $claim->approved_at ? $claim->approved_at->format('H:i') : '-' }}</div>
                <div class="item-claimed-by">{{ $claim->claimed_at ? $claim->claimed_at->format('d M Y H:i') : '-' }}
                </div>
                <div class="item-claimed-by">{{ $claim->user->nama ?? '-' }}</div>
                <div class="item-status">
                    @if ($claim->status == 'menunggu')
                        <span class="badge badge-warning">Menunggu</span>
                    @elseif($claim->status == 'disetujui')
                        <span class="badge badge-success">Disetujui</span>
                    @elseif($claim->status == 'ditolak')
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                </div>
            </div>
        @endforeach

        <form id="keluar-app" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>


</body>

</html>
