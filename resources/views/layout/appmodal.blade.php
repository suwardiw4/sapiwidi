<head>
    {{-- <title>@yield('title', 'Situs Saya')</title> --}}
    @stack('styles')
    @yield('css')
</head>

<div class="container">
    @yield('content')
</div>

@stack('script')

</html>
