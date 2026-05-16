<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Situs Saya')</title>
    <link rel="stylesheet" href="{{ asset('custom/css/custom.css') }}">
</head>
<body>
    {{-- <header>
        <h1>Header Website</h1>
    </header> --}}

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p> </p>
    </footer>
</body>
</html>
