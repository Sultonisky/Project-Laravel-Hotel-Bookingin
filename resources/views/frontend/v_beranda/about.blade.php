@extends('frontend.v_layouts.app')
@section('title', 'About')
@section('content')
    <!-- About Us Section -->
    <section id="about-us" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Something About Us</h2>
            <div class="row align-items-center mb-4">
                <div class="col-md-6 about-img">
                    <img src="{{ aboutImage('about img1.jpg') }}" alt="Reception" class="img-fluid rounded img-about">
                </div>
                <div class="col-md-6">
                    <p>
                        Selamat datang di Bookingin, destinasi utama untuk kenyamanan,
                        kemewahan, dan pelayanan istimewa. Kami berkomitmen memberikan
                        pengalaman menginap yang tak terlupakan bagi setiap tamu. Lorem, ipsum dolor sit amet consectetur
                        adipisicing elit. Temporibus ea perferendis delectus consequatur, accusantium, quam tenetur et,
                        harum ratione nobis laudantium itaque quaerat soluta ipsa veritatis nulla fugit atque iure a
                        cupiditate porro nemo! Est beatae quisquam minima maiores facilis et molestiae nesciunt dolore,
                        fugiat provident, animi cum quod ipsum!
                    </p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <img src="{{ aboutImage('about-img.jpg') }}" alt="Pool Area" class="img-fluid rounded img-about">
                </div>
                <div class="col-md-6 order-md-1">
                    <p>
                        Sejak didirikan pada tahun 2020, Bookingin telah menjadi pilihan utama bagi pelancong.
                        Terletak di lokasi strategis, hotel kami menawarkan akses mudah dan kenyamanan maksimal. Lorem ipsum
                        dolor, sit amet consectetur adipisicing elit. Quisquam distinctio explicabo veritatis doloremque
                        repellendus nemo. Quam corporis soluta unde tenetur iusto consectetur alias ipsa, eos maiores
                        pariatur reprehenderit suscipit inventore sed quisquam fugiat animi reiciendis. Dolores quibusdam,
                        ipsam, voluptate temporibus ducimus saepe ipsum doloremque quas perspiciatis placeat repellendus
                        fugiat eum.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
