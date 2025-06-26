@extends('frontend.v_layouts.app')
@section('title', 'Contact')
@section('content')

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-black text-white">
        <div class="container">
            <h2 class="text-center mb-1">Contact Us</h2>
            <p class="text-white mb-4 text-center">You can contact us here and we will help you </p>
            <div class="row contact-row">
                <!-- Contact Form -->
                <div class="col-md-6 contact-form-col">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control bg-dark text-white border-secondary" placeholder="Enter your name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control bg-dark text-white border-secondary" placeholder="Enter your email..."
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="messages" id="message" rows="5" class="form-control bg-dark text-white border-secondary"
                                placeholder="Type a Message for Us" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send</button>
                    </form>
                </div>

                <!-- Google Map -->
                <div class="col-md-6 mt-4 mt-md-0 contact-map-col">
                    <div class="map-responsive rounded shadow border border-secondary">

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126921.16447334258!2d106.7843584!3d-6.22592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f749eaf101f5%3A0xcd62c14b7a08da30!2sGBK%20Arena!5e0!3m2!1sid!2sid!4v1745184108883!5m2!1sid!2sid"
                            width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
