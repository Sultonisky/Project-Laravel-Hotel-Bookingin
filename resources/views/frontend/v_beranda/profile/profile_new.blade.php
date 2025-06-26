{{-- @extends('frontend.v_layouts.app')
@section('title', 'Contact')
@section('content')

    <div class="hero-bg">
        <div class="hero-content">
            <h1>Get In Touch</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
        </div>
    </div>
    <div class="section-title">My Contact</div>
    <div class="profile-card">
        @auth
            <img src="{{ asset('storage/img-user/' . (Auth::user()->foto ?? 'img-default.jpg')) }}" alt="Foto Profil"
                class="profile-img shadow">
            <div class="profile-name">{{ Auth::user()->name }}</div>
            <div class="profile-info">
                <span class="material-symbols-outlined">mail</span>
                {{ Auth::user()->email }}
            </div>
            <div class="profile-info">
                <span class="material-symbols-outlined">call</span>
                {{ Auth::user()->no_telp ?? '-' }}
            </div>
            <button class="profile-edit-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit</button>
        @endauth
    </div>
    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content profile-figma-container">
                <!-- Kiri: Info User -->
                <div class="profile-figma-left">
                    <img src="{{ asset('storage/img-user/' . (Auth::user()->foto ?? 'img-default.jpg')) }}"
                        alt="Foto Profil" class="profile-figma-img">
                    <div class="profile-figma-name">{{ Auth::user()->name }}</div>
                    <div class="profile-figma-info">
                        <div class="profile-figma-row">
                            <span class="material-symbols-outlined profile-figma-icon">mail</span>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                        <div class="profile-figma-row">
                            <span class="material-symbols-outlined profile-figma-icon">call</span>
                            <span>{{ Auth::user()->no_telp ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <!-- Kanan: Form Edit -->
                <div class="profile-figma-right">
                    <button type="button" class="profile-figma-close" data-bs-dismiss="modal"
                        aria-label="Close">&times;</button>
                    <div class="profile-figma-title">Edit Profile</div>
                    <div class="profile-figma-desc">Update your profile information below</div>
                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data"
                        style="width:100%">
                        @csrf
                        @method('put')
                        <div class="profile-figma-form-row">
                            <div class="profile-figma-form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="profile-figma-form-row">
                            <div class="profile-figma-form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="profile-figma-form-row">
                            <div class="profile-figma-form-group">
                                <label>No Telp</label>
                                <input type="text" name="no_telp" class="form-control"
                                    value="{{ Auth::user()->no_telp ?? '' }}">
                            </div>
                        </div>
                        <div class="profile-figma-form-row">
                            <div class="profile-figma-form-group">
                                <label>Password Baru <span class="text-muted">(opsional)</span></label>
                                <input type="password" name="new_password" class="form-control"
                                    placeholder="Min 8 karakter">
                            </div>
                        </div>
                        <div class="profile-figma-form-row">
                            <div class="profile-figma-form-group">
                                <label>Konfirmasi Password Baru <span class="text-muted">(opsional)</span></label>
                                <input type="password" name="new_password_confirmation" class="form-control"
                                    placeholder="Min 8 karakter">
                            </div>
                        </div>
                        <div class="profile-figma-form-row">
                            <div class="profile-figma-form-group">
                                <label>Profile Photo</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                        </div>
                        <div class="profile-figma-form-row">
                            <button type="submit" class="profile-figma-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection --}}
