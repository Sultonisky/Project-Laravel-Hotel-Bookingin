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
                        <div class="room-actions">
                            <a href="{{ route('room') }}" class="book-now-btn bg-secondary">Back</a>
                            <a class="btn btn-primary" href="{{ route('booking.form', $room->id) }}">
                                Book Now
                            </a>
                        </div>
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
