@extends('layout.app')
@section('title', 'Dashboard')
@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Istana Qurban</title>

    <style>
        :root {
            --primary: #1e4d2b;
            --primary-light: #2f6b43;
            --secondary: #4c9b77;
            --bg: #f4f7f6;
            --white: #ffffff;
            --text: #2d3436;
            --muted: #7f8c8d;
            --shadow: 0 12px 25px rgba(0,0,0,0.05);
        }

        h1 {
            margin-bottom: 15px;
            font-size: 28px;
            font-weight: 800;    
            color: #ffffff;      
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .wrapper {
            max-width: 980px;
            margin: 0 auto;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 40px 30px;
            border-radius: 2px;
            text-align: center;
            margin-bottom: 35px;
            box-shadow: var(--shadow);
        }

        header h1 {
            font-size: 2.3rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        header .subtitle {
            font-size: 1rem;
            opacity: 0.92;
        }

        /* Statistik */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 2px;
            padding: 24px;
            box-shadow: var(--shadow);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 5px;
            width: 100%;
        }

        .stat-card.available::before { background: #2ecc71; }
        .stat-card.booked::before { background: #f1c40f; }
        .stat-card.sold::before { background: #e74c3c; }

        .stat-label {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #95a5a6;
            font-weight: 700;
        }

        .stat-value {
            font-size: 2.4rem;
            font-weight: 800;
            margin: 12px 0 8px;
        }

        .available .stat-value { color: #27ae60; }
        .booked .stat-value { color: #f39c12; }
        .sold .stat-value { color: #c0392b; }

        .stat-total {
            font-size: 0.85rem;
            color: var(--muted);
        }

        /* Menu */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .menu-card {
            background: var(--white);
            border-radius: 2px;
            padding: 28px 22px;
            text-decoration: none;
            color: var(--text);
            box-shadow: var(--shadow);
            transition: 0.25s ease;
            display: flex;
            align-items: center;
            gap: 18px;
            border: 1px solid transparent;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            border-color: #dcefe4;
            box-shadow: 0 18px 35px rgba(0,0,0,0.08);
        }

        .icon-box {
            min-width: 58px;
            height: 58px;
            border-radius: 2px;
            background: #e9f7ef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .menu-text h3 {
            color: var(--primary);
            font-size: 1.05rem;
            margin-bottom: 4px;
        }

        .menu-text p {
            font-size: 0.88rem;
            color: var(--muted);
        }

        /* Responsive */
        @media (max-width: 700px) {
            .stats-container,
            .menu-grid {
                grid-template-columns: 1fr;
            }

            .menu-card {
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <header>
            <h1>Istana Qurban</h1>
            <p class="subtitle">Sistem Pencatatan & Manajemen Penjualan Sapi</p>
        </header>

        <!-- Statistik -->
        <div class="stats-container">
            <div class="stat-card available">
                <div class="stat-label">Tersedia</div>
                <div class="stat-value">{{ $totalTersedia }}</div>
                <div class="stat-total">
                    dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor
                </div>
            </div>

            <div class="stat-card booked">
                <div class="stat-label">Dipesan</div>
                <div class="stat-value">{{ $totalDipesan }}</div>
                <div class="stat-total">
                    dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor
                </div>
            </div>

            <div class="stat-card sold">
                <div class="stat-label">Terjual</div>
                <div class="stat-value">{{ $totalTerjual }}</div>
                <div class="stat-total">
                    dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor
                </div>
            </div>
        </div>

        <!-- Menu -->
        <div class="menu-grid">
            <a href="{{ route('sapi.index') }}" class="menu-card">
                <div class="icon-box">🐄</div>
                <div class="menu-text">
                    <h3>Katalog Sapi</h3>
                    <p>Lihat dan kelola data sapi qurban</p>
                </div>
            </a>

        <div class="menu-card" onclick="window.location.href='{{ route('pesanan.index') }}'">
            <div class="icon-box">📝</div>
            <div class="menu-text">
                 <h3>Registrasi & Booking</h3>
                 <p>Pencatatan data pemesanan sapi</p>
             </div>
        </div>

            <div class="menu-card">
                <div class="icon-box">💰</div>
                <div class="menu-text">
                    <h3>Pembayaran & Keuangan</h3>
                    <p>Monitoring pembayaran pelanggan</p>
                </div>
            </div>

            <div class="menu-card">
                <div class="icon-box">📊</div>
                <div class="menu-text">
                    <h3>Rekap Penjualan</h3>
                    <p>Ringkasan transaksi dan laporan</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
@endsection