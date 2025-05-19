@extends('frontend.v_layouts.app')
@section('title', 'Beranda')
@section('content')



    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-text">
            <h1>Temukan Kamar Impian dengan Sekali Klik,</h1>
            <h1>Nikmati <span class="highlight fw-bold">Suasana</span> Tanpa Batas</h1>
        </div>
        <div class="row justify-content-center text-start">
            <form action="{{ route('room.select') }}" method="GET" class="row justify-content-center text-start">
                @csrf
                <div class="col-md-2">
                    <label for="checkin" class="form-label">Check in</label>
                    <input type="date" id="checkin" class="form-control" name="checkin_date"
                        placeholder="Please enter your check-in date" required>
                    @error('checkin_date')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="checkout" class="form-label">Check out</label>
                    <input type="date" id="checkout" class="form-control" name="checkout_date"
                        placeholder="Please enter your check-out date" required>
                    @error('checkout_date')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2 d-flex align-items-end mt-4">
                    <button type="submit" class="btn btn-primary w-100">Book Now</button>
                </div>
            </form>

        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="facilities" class="py-5">
        <div class="container text-center">
            <h2 class="mb-1">Our Facilities</h2>
            <p class="mb-5">Explore our facilities and enjoy a comfortable stay.</p>
            <div class="row text-start">
                <div class="col-md-4 bg-transparent mb-4">
                    <div class="card facility-card">
                        <img src="{{ facilityImage('pool.jpg') }}" class="card-img-top" alt="Kolam Renang">
                        <div class="card-body">
                            <h5 class="card-title text-white fw-bold">Private Pool</h5>
                            <p class="card-text text-white">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Asperiores, eius?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bg-transparent mb-4">
                    <div class="card h-100 facility-card">
                        <img src="{{ facilityImage('gym.jpg') }}" class="card-img-top" alt="Gym">
                        <div class="card-body">
                            <h5 class="card-title text-white fw-bold">Gym</h5>
                            <p class="card-text text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel,
                                atque.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bg-transparent mb-4">
                    <div class="card facility-card">
                        <img src="{{ facilityImage('restaurant.jpg') }}" class="card-img-top" alt="Restoran">
                        <div class="card-body">
                            <h5 class="card-title text-white fw-bold">Restaurant</h5>
                            <p class="card-text text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Obcaecati, quo!
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 bg-transparent">
                    <div class="card facility-card">
                        <img src="{{ facilityImage('mosque.jpg') }}" class="card-img-top" alt="Restoran">
                        <div class="card-body">
                            <h5 class="card-title text-white fw-bold">Mosque</h5>
                            <p class="card-text text-white">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non,
                                iure!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bg-transparent">
                    <div class="card facility-card">
                        <img src="{{ facilityImage('ballroom.jpg') }}" class="card-img-top" alt="Restoran">
                        <div class="card-body">
                            <h5 class="card-title text-white fw-bold">Ballroom</h5>
                            <p class="card-text text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum,
                                quod?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bg-transparent">
                    <div class="card facility-card">
                        <img src="{{ facilityImage('meeting_room.jpg') }}" class="card-img-top" alt="Restoran">
                        <div class="card-body">
                            <h5 class="card-title text-white fw-bold">Meeting Room</h5>
                            <p class="card-text text-white">Lorem ipsum dolor sit amet consectetur adipisicing
                                elit.
                                Laudantium, excepturi?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-5 bg-black">
        <div class="container">
            <h2 class="text-center mb-1">Our Gallery</h2>
            <p class="mb-5 text-center">Explore our beautiful gallery of rooms and facilities.</p>
            <div class="masonry-gallery">
                <div class="gallery-item"><img src="{{ galleryImage('gallery.jpg') }}" alt="Gallery Image 1"></div>
                <div class="gallery-item"><img src="{{ galleryImage('gallery1.jpg') }}" alt="Gallery Image 2">
                </div>
                <div class="gallery-item"><img src="{{ galleryImage('gallery3.jpg') }}" alt="Gallery Image 3">
                </div>
                <div class="gallery-item"><img src="{{ galleryImage('gallery4.jpg') }}" alt="Gallery Image 4">
                </div>
                <div class="gallery-item"><img src="{{ galleryImage('gallery2.jpg') }}" alt="Gallery Image 1">
                </div>

                <div class="gallery-item"><img src="{{ galleryImage('gallery5.jpg') }}" alt="Gallery Image 5">
                </div>

                <div class="gallery-item"><img src="{{ galleryImage('gallery6.jpg') }}" alt="Gallery Image 6">
                </div>
                <div class="gallery-item"><img src="{{ galleryImage('gallery6.jpg') }}" alt="Gallery Image 6">
                </div>
                <div class="gallery-item"><img src="{{ galleryImage('gallery7.jpg') }}" alt="Gallery Image 1">
                </div>

                <!-- Tambah sesuai kebutuhan -->
            </div>
        </div>
    </section>







@endsection
