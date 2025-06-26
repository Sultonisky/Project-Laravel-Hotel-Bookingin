@extends('frontend.v_layouts.app')
@section('title', 'History Booking')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-1">Booking History</h2>
        <p class="text-white mb-4 text-center">You can see your booking history here and manage your booking </p>

        @if ($reservations->isEmpty())
            <p class="text-center">Belum ada data booking.</p>
        @else
            <div class="row g-4">
                @foreach ($reservations as $reservation)
                    <div class="col-12">
                        <div class="d-flex bg-black text-white rounded-4 overflow-hidden p-3 flex-wrap">
                            {{-- Gambar kamar --}}
                            <div class="flex-shrink-0 me-4">
                                {{-- Optional: tampilkan gambar kamar --}}
                                <img src="{{ asset('storage/img-room/' . $reservation->room->foto) }}"
                                    class="img-fluid rounded-3" alt="Room Image"
                                    style="width: 480px; object-fit: cover; height: 230px; background-color: #ccc; border-radius: 12px;">
                            </div>

                            {{-- Info Booking --}}
                            <div class="flex-grow-1">
                                <div class="d-flex flex-wrap gap-4 align-items-start mb-3">
                                    <div>
                                        <h6 class="mb-1 fw-semibold">Booking Code</h6>
                                        <p class="mb-0">{{ $reservation->booking_code }}</p>
                                    </div>
                                    <div>
                                        @php
                                            $status = $reservation->status;
                                            $badgeClass = match ($status) {
                                                'success' => 'bg-success',
                                                'pending' => 'bg-warning text-dark',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span
                                            class="badge {{ $badgeClass }} px-4 py-2 fw-bold">{{ ucfirst($status) }}</span>
                                    </div>
                                </div>


                                <div class="row mt-4 text-start">
                                    <div class="col-sm-6 col-md-3">
                                        <h6 class="mb-2 fw-bold">Type</h6>
                                        {{ $reservation->room->room_name }}<br>
                                        <small>{{ $reservation->room->category->category_name }}</small>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <h6 class="mb-2 fw-bold">Nama</h6>{{ $reservation->guest->name }}
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <h6 class="mb-2 text fw-bold">Check-in</h6>
                                        {{ \Carbon\Carbon::parse($reservation->checkin_date)->translatedFormat('d F Y') }}
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <h6 class="mb-2 text fw-bold">Check-out</h6>
                                        <p class="text">
                                            {{ \Carbon\Carbon::parse($reservation->checkout_date)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-end flex-wrap mt-4">
                                    <div>
                                        <p class="mb-1">Total</p>
                                        <div class="d-flex align-items-center gap-3">
                                            <h4 class="fw-bold text-white mb-0">
                                                IDR {{ number_format($reservation->total_payment, 0, ',', '.') }}
                                            </h4>
                                            @if ($reservation->payment_method == 1)
                                                <span class="badge bg-secondary">Bank Transfer</span>
                                            @elseif ($reservation->payment_method == 0)
                                                <span class="badge bg-success">Credit Card</span>
                                            @elseif ($reservation->payment_method == 2)
                                                <span class="badge bg-primary">e-Wallet</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 mt-2 mt-md-0">
                                        @if ($reservation->status === 'pending')
                                            <button type="button" class="btn btn-outline-light fw-bold"
                                                data-bs-toggle="modal"
                                                data-bs-target="#rescheduleModal{{ $reservation->id }}">
                                                Reschedule
                                            </button>

                                            {{-- Modal --}}
                                            <div class="modal fade" id="rescheduleModal{{ $reservation->id }}"
                                                tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="rescheduleModalLabel">
                                                                Reschedule Form
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="rescheduleForm{{ $reservation->id }}">
                                                                @csrf
                                                                @method('put')

                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label>Checkin Date</label>
                                                                        <input type="date" name="checkin_date"
                                                                            id="checkin_date"
                                                                            class="form-control @error('checkin_date') is-invalid @enderror"
                                                                            value="{{ old('checkin_date', $reservation->checkin_date) }}"
                                                                            required>
                                                                        @error('checkin_date')
                                                                            <span
                                                                                class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Checkout Date</label>
                                                                        <input type="date" name="checkout_date"
                                                                            id="checkout_date"
                                                                            class="form-control @error('checkout_date') is-invalid @enderror"
                                                                            value="{{ old('checkout_date', $reservation->checkout_date) }}"
                                                                            required>
                                                                        @error('checkout_date')
                                                                            <span
                                                                                class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Reschedule</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <form method="POST" action="{{ route('booking.cancel', $reservation->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger fw-bold show_cancel"
                                                    data-konf-cancel="{{ $reservation->booking_code }}">
                                                    Cancel
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-success small">No action needed</span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.getElementById('rescheduleForm{{ $reservation->id }}');
                            const modal = new bootstrap.Modal(document.getElementById('rescheduleModal{{ $reservation->id }}'));

                            form.addEventListener('submit', function(e) {
                                e.preventDefault();

                                const formData = new FormData(form);

                                fetch("{{ route('booking.reschedule', $reservation->id) }}", {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'Accept': 'application/json',
                                        },
                                        body: formData
                                    })
                                    .then(response => {
                                        if (!response.ok) return response.json().then(err => Promise.reject(err));
                                        return response.json();
                                    })
                                    .then(data => {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: data.message,
                                        }).then(() => {
                                            modal.hide();
                                            location.reload(); // reload halaman untuk update tampilan
                                        });
                                    })
                                    .catch(error => {
                                        if (error.errors) {
                                            const firstError = Object.values(error.errors)[0][0];
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal Reschedule',
                                                text: firstError
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Terjadi Kesalahan',
                                                text: 'Silakan coba lagi.'
                                            });
                                        }
                                    });
                            });
                        });
                    </script>
                @endforeach
            </div>
        @endif
    </div>

@endsection
