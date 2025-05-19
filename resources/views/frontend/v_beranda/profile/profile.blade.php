<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - Bookingin</title>
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/style/css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/style/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="profile-container">
            @auth
                <!-- Header -->
                <div class="profile-header">
                    <h2>User Profile</h2>
                </div>

                <!-- Profile Image + Info -->
                <div class="text-center">
                    <img src="{{ asset('storage/img-user/' . (Auth::user()->foto ?? 'img-default.jpg')) }}"
                        alt="Foto Profil" class="profile-img shadow">
                    <h4 class="mt-3 mb-0 text-primary">{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                </div>

                <!-- Detail Info -->
                <div class="profile-body">
                    {{-- <h5 class="mb-3 fw-semibold text-black">Account Details</h5>
                    <div class="row mb-3 text-black">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly disabled>
                        </div>
                    </div> --}}

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('beranda') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <div>
                            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil-square"></i> Edit Profile
                            </button>
                            <button class="btn btn-danger me-2 text-white" data-bs-toggle="modal"
                                data-bs-target="#changePasswordModal">
                                <i class="bi bi-lock"></i> Change Password
                            </button>
                        </div>
                    </div>

                </div>
            @endauth
        </div>
    </div>

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                @method('put')

                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label>Profile Photo</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Ganti Password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('profile.changePassword') }}" method="post" class="modal-content">
                @csrf
                @method('put')

                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Update Password</button>
                </div>
            </form>
        </div>
    </div>



    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- konfirmasi success-->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Successfully!',
                text: @json(session('success')),
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Error!!',
                text: @json(session('error'))
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <!-- konfirmasi success End-->

    <script src="{{ asset('frontend/style/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
