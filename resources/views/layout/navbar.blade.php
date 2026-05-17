<nav class="navbar">
    <div class="navbar-brand">
        <img src="{{ asset('img/logo-istana-qurban.png') }}" alt="Logo Istana Qurban">
        <span>Istana Qurban</span>
    </div>

    <div class="nav-links">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('sapi.index') }}" class="{{ request()->routeIs('sapi.*') ? 'active' : '' }}">Katalog
            Sapi</a>
        <a href="{{ route('pesanan.index') }}" class="{{ request()->routeIs('pesanan.*') ? 'active' : '' }}">Registrasi &
            Booking</a>
        <a href="#">Transaksi</a>
        <a href="#">Laporan</a>
    </div>

    <div class="user-section">
        <div class="user-name">
            {{ Auth::user()->name }} </div>

        <div class="user-profile-container">
            <div class="user-profile" onclick="toggleLogout()">
                👤
            </div>

            <div class="dropdown-logout" id="logoutMenu">
                <form action="/logout" method="POST" onsubmit="return confirm('Yakin ingin keluar dari sistem?')">
                    @csrf
                    <button type="submit">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleLogout() {
        document.getElementById('logoutMenu').classList.toggle('show');
    }

    window.onclick = function(event) {
        // Biar klik di nama atau profil tidak menutup dropdown secara tidak sengaja
        if (!event.target.matches('.user-profile')) {
            var dropdowns = document.getElementsByClassName("dropdown-logout");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
