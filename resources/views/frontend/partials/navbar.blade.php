<style>
    .navbar-toggler {
        border: none;
        outline: none;
        box-shadow: none;
        padding: 0.25rem 0.5rem;
    }

    .navbar-toggler:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary shadow-sm sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-white" href="{{ route('beranda') }}">
            Bookingin
        </a>

        <!-- Toggle Button (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!-- Navbar Menu -->
        <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarNav">
            <ul class="navbar-nav mx-lg-auto fw-bold text-lg-start">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('beranda') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('room') }}">Room</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('contact') }}">Contact</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('history') }}">Booking</a></li>
            </ul>

            <!-- User Dropdown -->
            @auth
                <div class="dropdown text-center text-lg-end mt-3 mt-lg-0">
                    <button class="btn dropdown-toggle fw-bold text-white d-flex align-items-center" type="button"
                        id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">

                        @if (Auth::user()->foto)
                            <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user"
                                class="rounded-circle me-2" width="22">
                        @else
                            <img src="{{ asset('img/img_default.jpg') }}" alt="user" class="rounded-circle me-2"
                                width="22">
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu shadow">
                        <li><a class="dropdown-item text-primary" href="{{ route('profile') }}"><i class="bi bi-person"></i>
                                Profile</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href=""
                                onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>
