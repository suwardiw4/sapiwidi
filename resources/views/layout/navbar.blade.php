<div class="custom-navbar">
    <div class="nav-container">
        <a href="{{ url('/') }}" class="nav-brand">
            <img src="{{ asset('img/logo-istana-qurban.png') }}" alt="Logo Istana Qurban" class="brand-logo">
            <span>Istana Qurban</span>
        </a>

        <!-- Tombol Hamburger (Hanya muncul di Mobile) -->
        <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
        </button>

        <div class="nav-menu" id="navMenu">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sapi.index') }}"
                    class="nav-link {{ request()->routeIs('sapi.*') ? 'active' : '' }}">Katalog Sapi</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pesanan.index') }}"
                    class="nav-link {{ request()->routeIs('pesanan.*') ? 'active' : '' }}">Registrasi & Booking</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Transaksi</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Laporan</a>
            </li>
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
    </div>
</div>


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

    // Memastikan halaman web sudah selesai dimuat sepenuhnya
    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.getElementById("mobile-menu");
        const navLinks = document.getElementById("nav-links");

        if (menuToggle && navLinks) {
            menuToggle.addEventListener("click", function() {
                // Menambah / menghapus class 'active' setiap kali hamburger di-klik
                navLinks.classList.toggle("active");
            });
        }
    });
</script>
