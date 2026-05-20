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

<body>
    <!-- Gunakan pembungkus utama halaman -->
    <div class="page-wrapper">
        @include('layout.navbar')

        <!-- BAGIAN KONTEN (Isi halaman akan muncul di sini) -->
        <main class="main-content">
            @yield('content')
        </main>

        <footer class="custom-footer">
            <p>&copy; 2026 Project Saya</p>
        </footer>
</body>

<!-- Link ke Custom JS -->
<script src="{{ asset('custom/js/navbar.js') }}"></script>

</html>
