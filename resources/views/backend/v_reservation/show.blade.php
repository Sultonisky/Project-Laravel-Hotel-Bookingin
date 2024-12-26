@extends('backend.v_layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Reservation Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Guest Name</th>
                                <td>{{ $reservation->guest->name }}</td>
                            </tr>
                            <tr>
                                <th>Room Name</th>
                                <td>{{ $reservation->room->room_name }}</td>
                            </tr>
                            <tr>
                                <th>Room Price</th>
                                <td> Rp. {{ number_format($reservation->room->price, 0, ',', '.') }}
                            </tr>
                            <tr>
                                <th>Check-in Date</th>
                                <td>{{ $reservation->tanggal_checkin }}</td>
                            </tr>
                            <tr>
                                <th>Check-out Date</th>
                                <td>{{ $reservation->tanggal_checkout }}</td>
                            </tr>
                            <tr>
                                <th>Total Payment</th>
                                <td> Rp. {{ number_format($reservation->total_payment, 0, ',', '.') }}
                            </tr>
                            <tr>
                                <th>Payment</th>
                                <td>
                                    @if ($reservation->payment)
                                        <span class="badge badge-success">Cash</span>
                                    @else
                                        <span class="badge badge-secondary">Credit</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('backend.reservation.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
