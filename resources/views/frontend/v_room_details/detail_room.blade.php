<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/style/css/style.css') }}" rel="stylesheet">
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
                        <a href="{{ route('room.reservation') }}" class="book-now-btn">Book Now</a>
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

            <!-- Booking Button -->
            <!-- <div class="room-booking"></div> -->
        </div>
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

</body>

</html>
