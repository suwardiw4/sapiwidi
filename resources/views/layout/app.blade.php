<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Situs Saya')</title>
    <link rel="stylesheet" href="{{ asset('custom/css/custom.css') }}">
    <!-- Tempat CSS khusus dari halaman anak akan muncul -->
    @yield('css')
    @stack('styles')
</head>

@include('layout.navbar')

<body>
    {{-- <header>
        <h1>Header Website</h1>
    </header> --}}

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>&nbsp; </p>
    </footer>
</body>

</html>
