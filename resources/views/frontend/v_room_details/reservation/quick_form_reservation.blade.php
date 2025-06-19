<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation - Bookingin</title>
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/logo-putih.png') }}">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-bCKqIGztz1MBy-si"></script>
    <style>
        body {
            background-color: #000;
            color: white;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-control {
            background-color: transparent;
            color: white;
            border: 1px solid white;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .form-control:focus {
            background-color: #111;
            color: white;
        }

        /* .identity-form {
            height: 90vh;
        } */

        .room-summary {
            background-color: #111;
            color: white;
            /* height: 90vh; */
        }

        .room-summary img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            font-weight: bold;
        }

        .btn-secondary {
            border: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h2 class="fw-bold mb-5 text-center">Detail Payment</h2>
        <div class="row g-4">
            <!-- Identity Form -->
            <div class="col-md-6">
                <div class="p-4 border rounded identity-form">
                    <h5 class="fw-bold mb-4">Your Identity</h5>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form id="bookingForm" action="{{ route('frontend.quick.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div class="mb-4">
                            <input type="text" name="name" class="form-control" placeholder="Enter Your Name"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-4">
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <input type="number" name="no_hp" class="form-control"
                                placeholder="Enter Your Phone Number" value="{{ old('no_hp') }}" required>
                        </div>
                        <div class="mb-4">
                            <input type="date" name="checkin_date" value="{{ $checkin }}" class="form-control"
                                readonly>

                        </div>
                        <div class="mb-4">
                            <input type="date" name="checkout_date" value="{{ $checkout }}" class="form-control"
                                readonly>

                        </div>
                        <div class="mb-4">
                            <select name="payment_method" class="form-control" required>
                                <option value="" {{ old('payment_method') === null ? 'selected' : '' }}>Select
                                    Payment Method</option>
                                <option value="0" {{ old('payment_method') == '0' ? 'selected' : '' }}>Credit Card
                                </option>
                                <option value="1" {{ old('payment_method') == '1' ? 'selected' : '' }}>Bank
                                    Transfer</option>
                                <option value="2" {{ old('payment_method') == '2' ? 'selected' : '' }}>e-Wallet
                                </option>
                            </select>

                        </div>

                        <button type="button" id="pay-button" class="btn btn-primary w-100 mt-2">Confirm
                            Reservation</button>
                        {{-- <a href="{{ route('room.detail', $room->id) }}" class="btn btn-secondary w-100 mt-2">Back</a> --}}
                    </form>
                </div>
            </div>

            <!-- Room Summary -->
            <div class="col-md-6">
                <div class="p-4 border rounded room-summary">
                    <img src="{{ asset('storage/img-room/' . $room->foto) }}" class="img-fluid rounded mb-3"
                        alt="Room Image">

                    <div class="d-flex justify-content-between">
                        <div class="text-center w-50">
                            <div class="fw-bold">Check In</div>
                            <small id="checkin_preview">--/--</small>
                        </div>
                        <h1>-</h1>
                        <div class="text-center w-50">
                            <div class="fw-bold">Check Out</div>
                            <small id="checkout_preview">--/--</small>
                        </div>
                    </div>

                    <hr class="border-light">

                    <div class="d-flex justify-content-between py-1">
                        <span>Type Room</span>
                        <span class="fw-semibold">{{ $room->category->category_name }}</span>
                    </div>
                    @php
                        $basePrice = $room->price;
                        $tax = $basePrice * 0.01;
                        $service = 50000;
                        $priceAfterTax = $basePrice + $tax;
                        $totalPerNight = $basePrice + $tax + $service;
                    @endphp

                    <div class="d-flex justify-content-between py-1">
                        <span>Price</span>
                        <span class="fw-semibold text-white">IDR {{ number_format($basePrice, 0, ',', '.') }}
                            /night</span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>Tax (0.1%)</span>
                        <span class="fw-semibold text-white">IDR {{ number_format($tax, 0, ',', '.') }} /night</span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>Service</span>
                        <span class="fw-semibold text-white">IDR {{ number_format($service, 0, ',', '.') }}
                            /night</span>
                    </div>

                    <hr class="border-light">

                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span id="total_price">--</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const checkinInput = document.querySelector('input[name="checkin_date"]');
        const checkoutInput = document.querySelector('input[name="checkout_date"]');
        const totalPriceDisplay = document.getElementById('total_price');
        const checkinPreview = document.getElementById('checkin_preview');
        const checkoutPreview = document.getElementById('checkout_preview');
        const basePrice = {{ $room->price }};
        const taxPerNight = basePrice * 0.01; // 0.1%
        const servicePerNight = 50000;
        const pricePerNight = basePrice + taxPerNight + servicePerNight;

        function updateSummary() {
            const checkinDate = new Date(checkinInput.value);
            const checkoutDate = new Date(checkoutInput.value);

            if (!isNaN(checkinDate) && !isNaN(checkoutDate) && checkoutDate > checkinDate) {
                const days = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
                const total = pricePerNight * days;

                checkinPreview.textContent = checkinDate.toDateString();
                checkoutPreview.textContent = checkoutDate.toDateString();
                totalPriceDisplay.innerHTML = `IDR ${total.toLocaleString('id-ID')}`;
            } else {
                checkinPreview.textContent = '--/--';
                checkoutPreview.textContent = '--/--';
                totalPriceDisplay.innerHTML = '--';
            }
        }

        checkinInput.addEventListener('change', updateSummary);
        checkoutInput.addEventListener('change', updateSummary);

        // Auto update saat halaman dibuka
        document.addEventListener("DOMContentLoaded", () => {
            updateSummary();
        });

        document.getElementById('pay-button').addEventListener('click', function() {
            const form = document.getElementById('bookingForm');
            const formData = new FormData(form);

            fetch("{{ route('frontend.booking.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.snapToken) {
                        snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                window.location.href = `/booking/success/${data.booking_code}`;
                            },
                            onPending: function(result) {
                                alert("Payment is pending.");
                            },
                            onError: function(result) {
                                alert("Payment failed.");
                            }
                        });
                    } else {
                        alert("Gagal mendapatkan token pembayaran.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat mengirim data.");
                });
        });
    </script>
</body>

</html>
