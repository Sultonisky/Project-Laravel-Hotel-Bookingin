@extends('frontend.v_layouts.app')
@section('title', 'Rooms')
@section('content')

    <!-- Tipe Room Section -->
    <section id="tipe-room" class="py-5">
        <div class="container text-center">
            <h2 class="mb-1">Our Rooms</h2>
            <p class="text-white mb-4">You can choose the room you want to stay in and enjoy your stay with us </p>
            <div class="row">
                @foreach ($room as $row)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 bg-transparent room-card">
                            <img src="{{ asset('storage/img-room/' . $row->foto) }}" class="card-img-top img-room"
                                alt="{{ $row->category->category_name }}">
                            <div class="card-body text-start">
                                <h5 class="card-title text-white">{{ $row->category->category_name }}</h5>
                                <p class="card-text text-white">{{ $row->category->description }}</p>
                                <a href="{{ route('room.detail', $row->id) }}" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection
