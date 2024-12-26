@extends('backend.v_layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.reservation.update', $reservation->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="form-group">
                                <label for="guests_id">Guest Name</label>
                                <select name="guests_id" id="guests_id"
                                    class="form-control @error('guest_id') is-invalid @enderror">
                                    <option value="">- Select Guest -</option>
                                    @foreach ($guests as $guest)
                                        <option value="{{ $guest->id }}"
                                            {{ old('guests_id', $reservation->guests_id) == $guest->id ? 'selected' : '' }}>
                                            {{ $guest->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('guests_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="rooms_id">Room Name</label>
                                <select name="rooms_id" id="rooms_id"
                                    class="form-control @error('rooms_id') is-invalid @enderror">
                                    <option value="">- Select Room -</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            {{ old('rooms_id', $reservation->rooms_id) == $room->id ? 'selected' : '' }}>
                                            {{ $room->room_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rooms_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_checkin">Check-in Date</label>
                                <input type="date" name="tanggal_checkin" id="tanggal_checkin"
                                    class="form-control @error('tanggal_checkin') is-invalid @enderror"
                                    value="{{ old('tanggal_checkin', $reservation->tanggal_checkin) }}">
                                @error('tanggal_checkin')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_checkout">Check-out Date</label>
                                <input type="date" name="tanggal_checkout" id="tanggal_checkout"
                                    class="form-control @error('tanggal_checkout') is-invalid @enderror"
                                    value="{{ old('tanggal_checkout', $reservation->tanggal_checkout) }}">
                                @error('tanggal_checkout')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Total Payment</label>
                                <input type="text" name="total_payment"
                                    value="{{ old('total_payment', $reservation->total_payment) }}"
                                    class="form-control @error('total_payment') is-invalid @enderror"
                                    placeholder="Enter Total Payment">
                                @error('total_payment')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="payment">Payment Method</label>
                                <select name="payment" id="payment"
                                    class="form-control @error('payment') is-invalid @enderror">
                                    <option value="1"
                                        {{ old('payment', $reservation->payment) == '1' ? 'selected' : '' }}>Cash</option>
                                    <option value="0"
                                        {{ old('payment', $reservation->payment) == '0' ? 'selected' : '' }}>Credit
                                    </option>
                                </select>
                                @error('payment')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('backend.reservation.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
