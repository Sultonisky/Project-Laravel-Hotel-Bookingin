<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/style/css/style.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <section id="tipe-room" class="py-5">
        <div class="container text-center">
            <h2 class="mb-1">Available Rooms For Book</h2>
            <p class="mb-5">You can book a room for the selected dates.</p>
            <div class="row">
                @forelse ($room as $row)
                    <div class="col-md-4 mb-4">
                        <div class="card bg-transparent room-card h-100">
                            <img src="{{ asset('storage/img-room/' . $row->foto) }}" class="card-img-top"
                                alt="{{ $row->category->category_name }}" style="object-fit: cover; height: 250px;">
                            <div class="card-body">
                                <h5 class="card-title text-white">{{ $row->category->category_name }}</h5>
                                <p class="card-text text-white">{{ $row->category->description }}</p>
                                <a href="{{ route('room.detail', $row->id) }}" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-white">No available rooms for selected dates.</p>
                @endforelse
            </div>
        </div>
    </section>

</body>

</html>
