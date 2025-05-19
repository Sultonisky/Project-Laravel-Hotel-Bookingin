<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - BOOKINGIN</title>
    <link rel="stylesheet" href="{{ asset('frontend/style/css/login_register.css') }}" />
</head>

<body>
    <div class="container">
        <div class="left-panel">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo-hd.png') }}" alt="Logo Bookingin" />
            </div>
        </div>

        <div class="right-panel">
            <div class="input-form">
                <h2>Login</h2>

                {{-- Flash Message Error --}}
                @if (session()->has('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('backend.login.post') }}" method="post" class="form-group">
                    @csrf

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

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember" /> Remember Me</label>
                        <a href="#">Forgot password?</a>
                    </div>

                    <button type="submit" name="login">LOGIN</button>
                </form>

                <p>Don't have an account? <a href="{{ route('backend.register.form') }}">Register</a></p>
            </div>
        </div>
    </div>
</body>

</html>
