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
                                        <img style="width: 100%; height: 250px; object-fit: cover; border-radius: 10px;"
                                            src="{{ asset('storage/img-room/' . $reservation->room->foto) }}"
                                            alt="{{ $reservation->room->foto }}" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Booking Code</th>
                                <td>{{ $reservation->booking_code }}</td>
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
                            @php
                                $service = 50000;
                                $room_price_total = ($reservation->total_payment - $service) / 1.001;
                                $tax = $room_price_total * 0.001;
                            @endphp

                            <tr>
                                <th>Total before Tax and Service</th>
                                <td>IDR. {{ number_format($room_price_total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Tax (0.1%)</th>
                                <td>IDR. {{ number_format($tax, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Service</th>
                                <td>IDR. {{ number_format($service, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Total Payment</th>
                                <td>IDR. {{ number_format($reservation->total_payment, 0, ',', '.') }}</td>
                            </tr>


                            <tr>
                                <th>Payment Method</th>
                                <td>
                                    @if ($reservation->payment_method == 0)
                                        <span class="badge badge-success">Credit Card</span>
                                    @elseif ($reservation->payment_method == 1)
                                        <span class="badge badge-secondary">Bank Transfer</span>
                                    @elseif($reservation->payment_method == 2)
                                        <span class="badge badge-primary">e-Wallet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($reservation->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($reservation->status == 'success')
                                        <span class="badge badge-success">Success</span>
                                    @elseif($reservation->status == 'canceled')
                                        <span class="badge badge-danger">Canceled</span>
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
                        <a href="{{ route('backend.reservation.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
