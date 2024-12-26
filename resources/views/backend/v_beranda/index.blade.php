@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-top">
                    <h5 class="card-title"> {{ $judul }}</h5>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading"> Welcome Back, {{ Auth::user()->nama }}</h4>
                        <p>Selamat datang di <b>Dashboard Admin Hotel Bookingin</b>! 🌟</p>
                        <p>Dengan hak akses yang Anda miliki sebagai
                            <b>
                                @if (Auth::user()->role == 1)
                                    Super Admin
                                @elseif(Auth::user()->role == 0)
                                    Admin
                                @endif
                            </b>, halaman ini dirancang sebagai pusat kendali utama aplikasi <b>Hotel Bookingin</b>.
                        </p>
                        <p>Nikmati kemudahan mengelola reservasi, data tamu, dan fitur lainnya yang mendukung operasional
                            hotel Anda secara profesional. Mari wujudkan pengalaman reservasi terbaik untuk semua pelanggan!
                            🚀</p>
                        <hr>
                        <p class="mb-0">Booking Hotel..? Yaa Bookingin !!!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Site Analysis</h4>
                            <h5 class="card-subtitle">Overview of Latest Month</h5>
                        </div>
                    </div>
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-user m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">2540</h5>
                                        <small class="font-light">Total Users</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-plus m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">120</h5>
                                        <small class="font-light">New Users</small>
                                    </div>
                                </div>
                                <div class="col-6 m-t-15">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-cart-plus m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">656</h5>
                                        <small class="font-light">Total Shop</small>
                                    </div>
                                </div>
                                <div class="col-6 m-t-15">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-tag m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">9540</h5>
                                        <small class="font-light">Total Orders</small>
                                    </div>
                                </div>
                                <div class="col-6 m-t-15">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-table m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">100</h5>
                                        <small class="font-light">Pending Orders</small>
                                    </div>
                                </div>
                                <div class="col-6 m-t-15">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-globe m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">8540</h5>
                                        <small class="font-light">Online Orders</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- column -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- contentAkhir -->
@endsection
