@extends('frontend.v_layouts.app')
@section('title', 'Profile')
@section('content')

<div class="container py-5">
    <div class="section-title mb-4">My Profile</div>
    <div id="profile-view-mode">
        <div class="profile-card mx-auto mb-5">
            @if (Auth::user()->foto)
            <img src="{{ asset('storage/img-user/' . (Auth::user()->foto)) }}" alt="Foto Profil"
                class="profile-img shadow rounded-circle border border-3 border-primary mb-3" style="width:120px;height:120px;object-fit:cover;">
            @else 
            <img src="{{ asset('img/img_default.jpg') }}" alt="user" class="rounded-circle me-2"
            width="120px" height="120px" style="object-fit:cover;">
            @endif
            <div class="profile-name">{{ Auth::user()->name }}</div>
            <span class="profile-email">{{ Auth::user()->email }}</span>
            
            <button class="profile-edit-btn" id="editProfileBtn">Edit</button>
        </div>
    </div>
    <div id="profile-edit-mode" style="display:none;">
        <div class="profile-figma-container" style="box-shadow:0 8px 32px rgba(0,0,0,0.10);background:#ededed;border-radius:24px;">
            <!-- Kiri: Info User -->
            <div class="col-md-5 profile-figma-left d-flex flex-column align-items-center justify-content-center p-4 position-relative" style="background:#ededed;border-radius:24px 0 0 24px;">
                @if (Auth::user()->foto)
                <img src="{{ asset('storage/img-user/' . (Auth::user()->foto)) }}"
                    alt="Foto Profil" class="profile-figma-img rounded-circle border border-3 border-primary mb-3" style="width:120px;height:120px;object-fit:cover;">
                @else
                <img src="{{ asset('img/img_default.jpg') }}" alt="user" class="rounded-circle me-2"
                width="120px" height="120px" style="object-fit:cover;">
                @endif
                <div class="profile-figma-name mb-2">{{ Auth::user()->name }}</div>
                <span>{{ Auth::user()->email }}</span>
               
            </div>
            <!-- Kanan: Form Edit -->
            <div class="col-md-7 profile-figma-right position-relative p-4" style="background:#ededed;border-radius:0 24px 24px 0;">
                <div class="profile-figma-title mb-1">Edit Profile</div>
                <div class="profile-figma-desc text-white mb-3">Update your profile information below</div>
                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" style="width:100%">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control text-black" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control text-black" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Password Baru <span class="text-muted">(opsional)</span></label>
                            <input type="password" name="new_password" class="form-control" placeholder="Min 8 karakter">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Konfirmasi Password Baru <span class="text-muted">(opsional)</span></label>
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Min 8 karakter">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Profile Photo</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="profile-figma-btn w-100">Save Changes</button>
                        <button type="button" class="btn btn-secondary ms-2" id="cancelEditBtn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editBtn = document.getElementById('editProfileBtn');
        var cancelBtn = document.getElementById('cancelEditBtn');
        var viewMode = document.getElementById('profile-view-mode');
        var editMode = document.getElementById('profile-edit-mode');
        if(editBtn) {
            editBtn.addEventListener('click', function() {
                viewMode.style.display = 'none';
                editMode.style.display = 'block';
            });
        }
        if(cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                editMode.style.display = 'none';
                viewMode.style.display = 'block';
            });
        }
    });
</script>
@endsection
