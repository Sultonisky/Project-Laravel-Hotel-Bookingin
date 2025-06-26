<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/logo-putih.png') }}">
    <title>Bookingin | @yield('title')</title>
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/style/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/style/css/profile.css') }}" rel="stylesheet">
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

    <script type="text/javascript">
        // Konfirmasi untuk membatalkan reservasi
        $(document).on('click', '.show_cancel', function(event) {
            var form = $(this).closest("form");
            var konfCancel = $(this).data("konf-cancel");
            event.preventDefault();
            Swal.fire({
                title: 'Confirm to Cancel Reservation?',
                html: "Reservation for <strong>" + konfCancel + "</strong> will be cancelled.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel',
                cancelButtonText: 'No, keep it',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Cancelled!', 'Reservation has been successfully cancelled.', 'success')
                        .then(() => {
                            form.submit();
                        });
                }
            });
        });
    </script>


    <script src="{{ asset('frontend/style/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
