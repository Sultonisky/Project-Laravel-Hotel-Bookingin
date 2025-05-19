<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation - Bookingin</title>
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
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

        .room-summary {
            background-color: #111;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
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
        <div class="row g-4">
            <!-- Identity Form -->
            <div class="col-md-6">
                <div class="p-4 border rounded">
                    <h5 class="fw-bold mb-4">You Identity</h5>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter Your Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter Your No Telp">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter Your Address">
                        </div>
                        <div class="mb-3">
                            <input type="date" class="form-control" placeholder="Enter Your Date of Birth">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter Your Occupation">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Room Summary -->
            <div class="col-md-6">
                <div class="p-4 border rounded room-summary">
                    <img src="{{ asset('frontend/images/home-living.jpg') }}" class="img-fluid rounded mb-3"
                        alt="Room Image">

                    <div class="d-flex justify-content-between">
                        <div class="text-center w-50">
                            <div class="fw-bold">Check In</div>
                            <small>Mon, 12 Aug 2024</small>
                        </div>
                        <div class="text-center w-50">
                            <div class="fw-bold">Check Out</div>
                            <small>Mon, 13 Aug 2024</small>
                        </div>
                    </div>

                    <hr class="border-light">

                    <div class="d-flex justify-content-between py-1">
                        <span>Type Room</span>
                        <span class="fw-semibold">Deluxe Room</span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>Price</span>
                        <span class="fw-semibold text-white">IDR 500.000<span class="text-muted">/NIGHT</span></span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>Price After TAX</span>
                        <span class="fw-semibold text-white">IDR 550.000<span class="text-muted">/NIGHT</span></span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>Service</span>
                        <span class="fw-semibold text-white">IDR 50.000<span class="text-muted">/NIGHT</span></span>
                    </div>

                    <hr class="border-light">

                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>IDR 600.000<span class="text-muted">/NIGHT</span></span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
