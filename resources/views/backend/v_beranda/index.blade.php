@extends('backend.v_layouts.app')
@section('content')
    <!-- contentAwal -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-top">
                    <h5 class="card-title"> {{ $judul }}</h5>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading"> Welcome Back, <span style="color: rgb(25, 130, 25);">
                                {{ Auth::user()->name }}</span>
                        </h4>
                        <p>Welcome to <b>Hotel Bookingin Admin Dashboard</b>!
                            With the access rights you have as
                            <b>
                                @if (Auth::User()->role == 1)
                                    <h3 style="color: rgb(90, 1, 1);">Administrator</h3>
                                @elseif(Auth::User()->role == 0)
                                    <h3 style="color: rgb(30, 7, 71);">Staff</h3>
                                @endif
                            </b>This page is designed as the main control center for the <b>Hotel Bookingin
                                application</b>.
                        </p>

                        <hr>
                        <p class="mb-0"><b>Bookingin Hotel || {{ Auth::user()->name }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
