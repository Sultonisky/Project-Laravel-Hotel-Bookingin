@extends('backend.v_layouts.app')
@section('content')
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-top">
                    <h5 class="card-title">{{ $judul }}</h5>
                    <div class="alert alert-info" role="alert">
                        <h5>Welcome back, <strong>{{ Auth::user()->name }}</strong>!</h5>
                        <p class="mb-1">You're logged in as
                            <strong>
                                @if (Auth::user()->role == 1)
                                    Administrator
                                @elseif (Auth::user()->role == 2)
                                    Receptionist
                                @endif
                            </strong>.
                        </p>
                        <p>Manage your hotel operations efficiently with Bookingin.</p>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

    {{-- Informasi Ringkasan (Statistik Panel) --}}
    <div class="row">

        {{-- Hanya Admin yang bisa lihat user dan kamar --}}
        @if (Auth::user()->role == 1)
            <div class="col-md-4">
                <div class="card card-body text-center bg-light">
                    <h4>Total Users</h4>
                    <h2>{{ $totalUsers ?? '-' }}</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-body text-center bg-light">
                    <h4>Ready Rooms</h4>
                    <h2 class="text-success">{{ $totalReadyRooms ?? '-' }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-body text-center bg-light">
                    <h4>Booked Rooms</h4>
                    <h2 class="text-danger">{{ $totalBookedRooms ?? '-' }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-body text-center bg-light">
                    <h4>Total Rooms</h4>
                    <h2>{{ $totalRooms ?? '-' }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-body text-center bg-light">
                    <h4>Total Contact</h4>
                    <h2>{{ $totalContact ?? '-' }}</h2>
                </div>
            </div>
        @endif

        {{-- Admin & Resepsionis sama-sama bisa lihat jumlah reservasi --}}
        <div class="col-md-4">
            <div class="card card-body text-center bg-light">
                <h4>Summary</h4>
                <h2>IDR. {{ number_format($totalMoney, 0, ',', '.') }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body text-center bg-light">
                <h4>Total Guest</h4>
                <h2>{{ $totalGuests ?? '-' }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body text-center bg-light">
                <h4>Success Reservations</h4>
                <h2 class="text-success">{{ $totalSuccessReservations ?? '-' }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body text-center bg-light">
                <h4>Pending Reservations</h4>
                <h2 class="text-warning">{{ $totalPendingReservations ?? '-' }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body text-center bg-light">
                <h4>Total Reservations</h4>
                <h2 class="text-primary">{{ $totalReservations ?? '-' }}</h2>
            </div>
        </div>




    </div>


    {{-- Laporan Khusus Admin --}}
    @if (Auth::user()->role == 1)
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <h5 class="card-title">Quick Report Tools</h5>
                    <p>Use this section to generate printable reports of reservations.</p>
                    <a href="{{ route('backend.report.formReservation') }}" class="btn btn-primary">Open Report
                        Generator</a>
                </div>
            </div>
        </div>
    @endif
@endsection
