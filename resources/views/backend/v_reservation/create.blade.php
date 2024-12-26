@extends('backend.v_layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('backend.reservation.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Guest Name</label>
                                        <select class="form-control @error('guests_id') is-invalid @enderror"
                                            name="guests_id">
                                            <option value="" selected>--Select Guest--</option>
                                            @foreach ($guests as $guest)
                                                <option value="{{ $guest->id }}">{{ $guest->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('guests_id')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Room Name</label>
                                        <select class="form-control @error('rooms_id') is-invalid @enderror"
                                            name="rooms_id">
                                            <option value="" selected>--Select Room--</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->room_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('rooms_id')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Check-in Date</label>
                                        <input type="date" name="tanggal_checkin" value="{{ old('tanggal_checkin') }}"
                                            class="form-control @error('tanggal_checkin') is-invalid @enderror"
                                            placeholder="Enter Date Check-in">
                                        @error('tanggal_checkin')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Check-out Date</label>
                                        <input type="date" name="tanggal_checkout" value="{{ old('tanggal_checkout') }}"
                                            class="form-control @error('tanggal_checkout') is-invalid @enderror"
                                            placeholder="Enter Date Check-out">
                                        @error('tanggal_checkout')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Payment</label>
                                        <select class="form-control @error('payment') is-invalid @enderror" name="payment">
                                            <option value="" selected>--Select Payment Method--</option>
                                            <option value="1">Cash</option>
                                            <option value="0">Credit</option>
                                        </select>
                                        @error('payment')
                                            <span class="invalid-feedback alert-danger"
                                                role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top">
                            <div class="card-body text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('backend.reservation.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
