<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/style/css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/logo-putih.png') }}">
    <title>Bookingin | Room Details</title>
</head>

<body>
    <section id="room-details" class="room-details">

        <div class="room-content">
            <!-- Main Image -->
            <div class="main-image">
                <img src="{{ asset('storage/img-room/' . $room->foto) }}" alt="Main Room Image" />
            </div>

            <div class="content">
                <div class="left-content">
                    <!-- Room Features -->
                    <div class="room-features">
                        @foreach ($room->features as $features)
                            <span class="feature-item">{{ $features->name }}</span>
                        @endforeach
                    </div>

                    <!-- Description -->
                    <div class="room-description">
                        <p>
                            {{ $room->category->description }}
                        </p>
                    </div>

                    <div class="room-title">
                        <h1>{{ $room->category->category_name }}</h1>
                        <h6>{{ $room->category->capacity }} Guest | {{ $room->category->bed_size }}</h6>
                        <p class="room-price">IDR. {{ number_format($room->price, 0, ',', '.') }}/<span
                                class="text-secondary">Night</span></p>
                        <a href="{{ route('room') }}" class="book-now-btn bg-secondary">Back</a>
                        <!-- Button trigger modal -->
                        <a class="btn btn-primary" href="{{ route('booking.form', $room->id) }}">
                            Book Now
                        </a>
                    </div>
                </div>
                <div class="right-content">
                    <div class="right-thumbnails">
                        @foreach ($room->photos as $photo)
                            <img src="{{ asset('storage/img-room/' . $photo->foto) }}" alt="Room Thumbnail"
                                class="thumb-img">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        {{-- <div class="modal fade" id="bookingModal{{ $room->id }}" tabindex="-1"
            aria-labelledby="bookingModalLabel{{ $room->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-white text-light">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="bookingModalLabel{{ $room->id }}">Please Select
                            Booking Dates
                        </h5>
                        <button type="button" class="btn-close btn-close-primary" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('booking.select.date', $room->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="checkin{{ $room->id }}" class="form-label text-dark">Check-in
                                    Date</label>
                                <input type="date" class="form-control" id="checkin{{ $room->id }}"
                                    name="checkin_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="checkout{{ $room->id }}" class="form-label text-dark">Check-out
                                    Date</label>
                                <input type="date" class="form-control" id="checkout{{ $room->id }}"
                                    name="checkout_date" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Continue Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

    </section>



    <script>
        const thumbnails = document.querySelectorAll('.thumb-img');
        const mainImage = document.querySelector('.main-image img');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', () => {
                mainImage.src = thumb.src;
            });
        });
    </script>

    <script src="{{ asset('frontend/style/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
