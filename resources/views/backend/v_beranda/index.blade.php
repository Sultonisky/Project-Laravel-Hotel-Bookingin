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
                                    Administrator
                                @elseif(Auth::User()->role == 0)
                                    Staff
                                @elseif(Auth::User()->role == 2)
                                    User
                                @endif
                            </b>, This page is designed as the main control center for the <b>Hotel Bookingin
                                application</b>.
                        </p>

                        <hr>
                        <p class="mb-0"><b>Bookingin Hotel</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
