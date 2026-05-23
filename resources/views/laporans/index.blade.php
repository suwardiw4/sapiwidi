@extends('layout.app')
@section('title', 'Rekap Penjualan - Istana Qurban')
@section('css')
    <style>
        .laporan-container {
            color: #222;
            font-family: system-ui, -apple-system, sans-serif;
        }

        h1,
        h2,
        h3 {
            color: #1e4d2b;
            font-weight: 800;
            text-transform: uppercase;
            margin-top: 0;
            letter-spacing: 0.5px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 25px;
            border-bottom: 2px solid #1e4d2b;
            padding-bottom: 10px;
        }

        h2 {
            font-size: 16px;
            margin-top: 30px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        h2 a {
            font-size: 12px;
            color: #4c9b77;
            text-transform: none;
            text-decoration: none;
        }

        /* --- FILTER FORM --- */
        .filter-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 25px;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-group label {
            font-size: 13px;
            font-weight: bold;
            color: #444;
        }

        .filter-input {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 13px;
            outline: none;
            background: #fff;
        }

        .filter-input:focus {
            border-color: #4c9b77;
        }

        .btn-filter {
            background: #4c9b77;
            color: white;
            border: none;
            padding: 9px 18px;
            font-weight: bold;
            font-size: 13px;
            border-radius: 4px;
            cursor: pointer;
            text-transform: uppercase;
            transition: background 0.2s;
        }

        .btn-filter:hover {
            background: #1e4d2b;
        }

        .btn-all {
            font-size: 13px;
            color: #666;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fafafa;
            transition: all 0.2s;
        }

        .btn-all:hover {
            background: #eee;
            color: #222;
        }

        /* --- KPI CARDS --- */
        .kpi-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            border-left: 5px solid #4c9b77;
        }

        .kpi-card.accent {
            border-left-color: #1e4d2b;
        }

        .kpi-card.warning {
            border-left-color: #f6ad55;
        }

        .kpi-title {
            font-size: 11px;
            font-weight: 800;
            color: #777;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .kpi-value {
            font-size: 22px;
            font-weight: 800;
            color: #222;
        }

        /* --- CHARTS GRID --- */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
            margin-bottom: 35px;
        }

        @media (max-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        /* --- DATA TABLES --- */
        .table-container {
            background: #fff;
            border-radius: 8px;
            border: 1px solid #ddd;
            overflow: hidden;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f5f6fa;
            color: #444;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #ddd;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #fafafa;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .bg-success {
            background: #d1e7dd;
            color: #1e4d2b;
        }

        .bg-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .btn-action {
            font-size: 12px;
            color: #4c9b77;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-action:hover {
            color: #1e4d2b;
            text-decoration: underline;
        }

        .btn-back-dashboard {
            display: inline-block;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            transition: color 0.2s;
        }

        .btn-back-dashboard:hover {
            color: #1e4d2b;
        }
    </style>
@endsection

@section('content')

    <div class="laporan-container">
        <h1>Rekap Penjualan & Stok</h1>

        {{-- DATE PICKER FILTER --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('laporan.index') }}" class="filter-form">
                <div class="filter-group">
                    <label>Dari:</label>
                    <input type="date" name="dari" value="{{ $dari }}" class="filter-input">
                </div>
                <div class="filter-group">
                    <label>Sampai:</label>
                    <input type="date" name="sampai" value="{{ $sampai }}" class="filter-input">
                </div>
                <button type="submit" class="btn-filter">Filter Grafik</button>
                <a href="{{ route('laporan.index', ['semua' => true]) }}" class="btn-all">Tampilkan Semua Data</a>
            </form>
        </div>

        {{-- RINGKASAN MONITORING BERDASARKAN FILTER --}}
        <h3>{{ $semuaData ? 'Ringkasan Seluruh Periode' : 'Ringkasan Terfilter (' . \Carbon\Carbon::parse($dari)->format('d/m/Y') . ' - ' . \Carbon\Carbon::parse($sampai)->format('d/m/Y') . ')' }}
        </h3>
        <div class="kpi-container">
            <div class="kpi-card">
                <div class="kpi-title">Sapi Terjual (Filter)</div>
                <div class="kpi-value">{{ $sapiTerjualFilter }} <span
                        style="font-size: 14px; color: #666; font-weight: normal;">ekor</span></div>
            </div>
            <div class="kpi-card accent">
                <div class="kpi-title">Pemasukan Omset (Filter)</div>
                <div class="kpi-value">Rp{{ number_format($pemasukanFilter, 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- VISUALISASI GRAFIK GRID --}}
        <div class="charts-grid">
            {{-- PIE CHART COMPOSITION --}}
            <div class="chart-card">
                <h3>Komposisi Stok Sapi</h3>
                <div style="position: relative; margin: auto; height: 220px; width: 220px;">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>

            {{-- BAR CHART REVENUE --}}
            <div class="chart-card">
                <h3>
                    Grafik Omset Harian
                    @if (!$semuaData)
                        <a href="{{ route('laporan.index', ['semua' => true]) }}">Reset ke Total</a>
                    @endif
                </h3>
                <div style="position: relative; height: 220px;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        {{-- KINERJA AKUMULATIF KESELURUHAN --}}
        <h1>Rekapitulasi Akumulatif Keseluruhan</h1>
        <div class="kpi-container">
            <div class="kpi-card">
                <div class="kpi-title">Total Sapi Terjual</div>
                <div class="kpi-value">{{ $totalTerjual }} ekor</div>
            </div>
            <div class="kpi-card accent">
                <div class="kpi-title">Total Seluruh Pemasukan</div>
                <div class="kpi-value">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            </div>
            <div class="kpi-card warning">
                <div class="kpi-title">Sisa Kandang (Tersedia+Dipesan)</div>
                <div class="kpi-value">{{ $totalTersedia + $totalDipesan }} ekor</div>
            </div>
        </div>

        {{-- DATA DETAIL TABEL SECTION --}}
        <h2>Detail Transaksi Penjualan</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 15%">Kode Sapi</th>
                        <th>Nama Pembeli</th>
                        <th>Harga Sapi</th>
                        <th>Total Dibayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualans as $pesanan)
                        <tr>
                            <td style="font-weight: bold; color: #1e4d2b;">#{{ $pesanan->sapi->kode_sapi }}</td>
                            <td style="font-weight: 600;">{{ $pesanan->pembeli->nama }}</td>
                            <td>Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
                            <td style="font-weight: 600; color: #4c9b77;">
                                Rp{{ number_format($pesanan->pembayarans->sum('jumlah_bayar'), 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color: #999; padding: 20px;">Belum ada record data
                                transaksi penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h2>Stok Sapi Siap Jual (Tersedia)</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Kode Sapi</th>
                        <th>Jenis Sapi</th>
                        <th>Bobot Ternak</th>
                        <th>Nilai Jual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sapiTersedia as $sapi)
                        <tr>
                            <td style="font-weight: bold; color: #1e4d2b;">#{{ $sapi->kode_sapi }}</td>
                            <td>{{ $sapi->jenis_sapi }}</td>
                            <td>{{ $sapi->bobot }} kg</td>
                            <td style="font-weight: 600;">Rp{{ number_format($sapi->harga_jual, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color: #999; padding: 20px;">Katalog kosong, tidak
                                ada stok sapi tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h2>Daftar Sapi Sedang Dipesan</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Kode Sapi</th>
                        <th>Jenis</th>
                        <th>Harga Sapi</th>
                        <th>Nama Pembeli</th>
                        <th>Status Pembayaran</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sapiDipesan as $pesanan)
                        <tr>
                            <td style="font-weight: bold; color: #1e4d2b;">#{{ $pesanan->sapi->kode_sapi }}</td>
                            <td>{{ $pesanan->sapi->jenis_sapi }}</td>
                            <td>Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
                            <td style="font-weight: 600;">{{ $pesanan->pembeli->nama }}</td>
                            <td>
                                @if ($pesanan->status_pembayaran == 'Lunas')
                                    <span class="badge bg-success">LUNAS</span>
                                @else
                                    <span class="badge bg-danger">BELUM LUNAS</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn-action">Lihat Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color: #999; padding: 20px;">Tidak ada pesanan sapi
                                berjalan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('dashboard') }}" class="btn-back-dashboard">← Kembali ke Dashboard Utama</a>
    </div>

@endsection

@push('scriptlink')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('script')
    {{-- SCRIPT INITIALIZATION CHART.JS --}}
    <script>
        // 1. Render Pie Chart Komposisi Stok
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: ['Tersedia', 'Dipesan', 'Terjual'],
                datasets: [{
                    data: [{{ $totalTersedia }}, {{ $totalDipesan }}, {{ $totalTerjual }}],
                    backgroundColor: ['#38b2ac', '#f6ad55', '#e53e3e'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        // 2. Render Bar Chart Omset Berkala
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelHari) !!},
                datasets: [{
                    label: 'Omset Transaksi (Rp)',
                    data: {!! json_encode($dataOmset) !!},
                    backgroundColor: '#4c9b77',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 10
                            },
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
