<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/logo-putih.png') }}" />
    <title>
        Bookingin Hotel Registration
    </title>
    <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet" />
</head>

<body>

    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div>
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="{{ asset('backend/images/logo-nav.png') }}"
                                alt="logo" /></span>
                    </div>


                    <!-- Form -->
                    <form class="form-horizontal m-t-20" action="{{ route('backend.register.submit') }}" method="POST">
                        @csrf
                        <div class="row p-b-30">
                            <div class="col-12">
                                <!-- Username -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white" id="basic-addon1"><i
                                                class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="name"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="Username" aria-label="name" aria-describedby="basic-addon1"
                                        value="{{ old('name') }}" required />
                                    @error('name')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon1"><i
                                                class="ti-email"></i></span>
                                    </div>
                                    <input type="email" name="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="Email Address" aria-label="email" aria-describedby="basic-addon1"
                                        value="{{ old('email') }}" required />
                                    @error('email')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- hp --}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon1"><i
                                                class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="hp" id="hp"
                                        class="form-control form-control-lg @error('hp') is-invalid @enderror"
                                        placeholder="Phone Number" aria-label="email" aria-describedby="basic-addon1"
                                        value="{{ old('hp') }}" required>
                                    @error('hp')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon2"><i
                                                class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="Password" aria-label="password" aria-describedby="basic-addon1"
                                        required />
                                    @error('password')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Confirm Password -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon2"><i
                                                class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Confirm Password" aria-label="password_confirmation"
                                        aria-describedby="basic-addon1" required />
                                    @error('password_confirmation')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-primary float-right" type="submit">
                                            Sign Up
                                        </button>
                                        <a href="{{ route('backend.login.view') }}"
                                            class="btn btn-secondary float-left">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful!',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>

</body>

</html>
