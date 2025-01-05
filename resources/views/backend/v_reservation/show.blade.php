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
                                <th>Room Photo</th>
                                <td>
                                    @if ($reservation->room->foto)
                                        <img src="{{ asset('storage/img-room/' . $reservation->room->foto) }}"
                                            alt="{{ $reservation->room->foto }}" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                            </tr>
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
                                <td> IDR. {{ number_format($reservation->room->price, 0, ',', '.') }}
                            </tr>
                            <tr>
                                <th>Check-in Date</th>
                                <td>{{ $reservation->checkin_date }}</td>
                            </tr>
                            <tr>
                                <th>Check-out Date</th>
                                <td>{{ $reservation->checkout_date }}</td>
                            </tr>
                            <tr>
                                <th>Total Payment</th>
                                <td> IDR. {{ number_format($reservation->total_payment, 0, ',', '.') }}
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td>
                                    @if ($reservation->payment_method)
                                        <span class="badge badge-success">Cash</span>
                                    @else
                                        <span class="badge badge-secondary">Credit</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Created By</th>
                                <td>{{ $reservation->createdBy->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Updated By</th>
                                <td>{{ $reservation->updatedBy->name ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('backend.reservation.index') }}" class="btn btn-secondary"><i
                                class="fas fa-arrow-left"></i>Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
