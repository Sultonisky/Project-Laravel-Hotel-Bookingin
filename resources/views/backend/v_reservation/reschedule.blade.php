@extends('backend.v_layouts.app')

@section('content')
    <div class="container">
        <h2>Reschedule Form</h2>
        <form action="{{ route('backend.reservation.reschedule', $reservasi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="checkin_date">Check-In Date:</label>
                <input type="date" name="checkin_date" id="checkin_date"
                    class="form-control @error('checkin_date') is-invalid @enderror"
                    value="{{ old('checkin_date', $reservasi->checkin_date) }}" required>
                @error('checkin_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="checkout_date">Check-Out Date:</label>
                <input type="date" name="checkout_date" id="checkout_date"
                    class="form-control @error('checkout_date') is-invalid @enderror"
                    value="{{ old('checkout_date', $reservasi->checkout_date) }}" required>
                @error('checkout_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Reschedule</button>
        </form>

    </div>
@endsection
