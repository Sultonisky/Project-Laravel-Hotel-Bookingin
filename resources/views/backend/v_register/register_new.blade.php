<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - BOOKINGIN</title>
    <link rel="stylesheet" href="{{ asset('frontend/style/css/login_register.css') }}" />
</head>

<body>
    <div class="container">
        <div class="right-panel">
            <div class="input-form">
                <h2>Register</h2>
                <form action="{{ route('backend.register.submit') }}" method="post">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder=" "
                            required />
                        <label for="name">Username</label>
                        @error('name')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder=" "
                            required />
                        <label for="email">Email</label>
                        @error('email')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-floating">
                        <input type="password" name="password" id="password" placeholder=" " required />
                        <label for="password">Password</label>
                        @error('password')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder=" "
                            required />
                        <label for="password_confirmation">Confirm Password</label>
                        @error('password_confirmation')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" name="register">Register</button>
                </form>
                <p>Already have an account? <a href="{{ route('backend.login.view') }}">Login</a></p>
            </div>
        </div>

        <div class="left-panel">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo-hd.png') }}" alt="Logo Bookingin" />
            </div>
        </div>
    </div>

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
