<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookingin | @yield('title')</title>
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/style/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>

    @include('frontend.partials.navbar')

    <main>
        @yield('content')
    </main>

    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Bookingin%2C%20saya%20butuh%20bantuan" class="wa-float"
        target="_blank" title="Butuh bantuan? Chat kami!">
        <i class="bi bi-headset"></i>
    </a>



    @include('frontend.partials.footer')

    <!-- form keluar app -->
    <form id="keluar-app" action="{{ route('backend.logout') }}" method="POST">
        @csrf
    </form>
    <!-- form keluar app end -->

    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- konfirmasi success-->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Successfully!',
                text: @json(session('success')),
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Error!!',
                text: @json(session('error'))
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <!-- konfirmasi success End-->

    <script src="{{ asset('frontend/style/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
