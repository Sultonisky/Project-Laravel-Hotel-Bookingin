<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - BOOKINGIN</title>
    <link rel="stylesheet" href="{{ asset('frontend/style/css/login_register.css') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/logo-putih.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="right-panel">
            <div class="input-form">
                <h2>Register</h2>
                <form action="{{ route('backend.register.submit') }}" method="post">
                    @csrf
                    <div class="form-floating icon-input">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder=" "
                            required />
                        <label for="name">Username</label>
                        <i class="fa-regular fa-user icon-right"></i>
                        @error('name')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating icon-input">
                        <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder=" "
                            required />
                        <label for="email">Email</label>
                        <i class="fa-regular fa-envelope icon-right"></i>
                        @error('email')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-floating icon-input">
                        <input type="password" name="password" id="password" placeholder=" " required />
                        <label for="password">Password</label>
                        <i class="fa-regular fa-eye toggle-password" id="togglePassword"></i>
                        @error('password')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating icon-input">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirm Password" aria-label="password_confirmation"
                            aria-describedby="basic-addon1" required />
                        <label for="password_confirmation">Confirm Password</label>
                        <i class="fa-regular fa-eye toggle-password" id="togglePasswordConfirmation"></i>
                        @error('password_confirmation')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
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

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
        const passwordConfirmation = document.querySelector('#password_confirmation');
        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>


</body>

</html>
