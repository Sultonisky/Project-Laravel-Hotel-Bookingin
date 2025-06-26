@extends('backend.v_layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.reservation.index') }}">
                <button type="button" class="btn btn-secondary mb-2"><i class="fas fa-arrow-left"></i> Kembali ke Data Reservasi</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Guest Name</th>
                                    <th>Room Name</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>Total Payment</th>
                                    <th>Status</th>
                                    <th>Restore</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trashed as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->guest->name ?? '-' }}</td>
                                        <td>{{ $row->room->room_name ?? '-' }}</td>
                                        <td>{{ $row->checkin_date }}</td>
                                        <td>{{ $row->checkout_date }}</td>
                                        <td>IDR. {{ number_format($row->total_payment, 0, ',', '.') }}</td>
                                        <td>{{ ucfirst($row->status) }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('backend.reservation.restore', $row->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Pulihkan Data"><i class="fas fa-undo"></i> Restore</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data yang dihapus.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 