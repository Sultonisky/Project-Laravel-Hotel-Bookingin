@extends('backend.v_layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.reservation.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add Data Reservation</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $judul }} </h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Guest Name</th>
                                    <th>Room Name</th>
                                    <th>Room Price</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>Total Payment</th>
                                    <th>Payment Method</th>
                                    {{-- <th>Created By</th>
                                    <th>Updated By</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->guest->name }}</td>
                                        <td>{{ $row->room->room_name }}</td>
                                        <td> IDR. {{ number_format($row->room->price, 0, ',', '.') }}</td>
                                        <td>{{ $row->checkin_date }}</td>
                                        <td>{{ $row->checkout_date }}</td>
                                        <td>IDR. {{ number_format($row->total_payment, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($row->payment_method == 1)
                                                <span class="badge badge-secondary">Bank Transfer</span>
                                            @elseif ($row->payment_method == 0)
                                                <span class="badge badge-success">Credit Card</span>
                                            @elseif ($row->payment_method == 2)
                                                <span class="badge badge-primary">e-Wallet</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{ $row->createdBy->name ?? '-' }}</td>
                                        <td>{{ $row->updatedBy->name ?? '-' }}</td> --}}

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('backend.reservation.show', $row->id) }}" title="Details">
                                                    <button type="button" class="btn btn-info btn-sm"><i
                                                            class="fas fa-eye"></i></button>
                                                </a>
                                                <a href="{{ route('backend.reservation.edit', $row->id) }}"
                                                    title="Edit Data">
                                                    <button type="button" class="btn btn-warning btn-sm"><i
                                                            class="far fa-edit"></i> </button>
                                                </a>
                                                <a href="{{ route('backend.reservation.rescheduleForm', $row->id) }}"
                                                    title="Reschedule">
                                                    <button type="button" class="btn btn-success btn-sm"><i
                                                            class="far fa-calendar-plus"></i> </button>
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('backend.reservation.destroy', $row->id) }}"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm show_confirm"
                                                        title="Delete Data">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <form method="POST"
                                                    action="{{ route('backend.reservation.cancel', $row->id) }}"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary btn-sm show_cancel"
                                                        title="Cancel Reservation">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
