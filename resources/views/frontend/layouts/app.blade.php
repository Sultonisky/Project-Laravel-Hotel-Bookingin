<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BerbagiLagi</title>
    <link rel="stylesheet" href="">
</head>

<body>
    @yield('content')

    <form id="keluar-app" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</body>

</html>
