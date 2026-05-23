@extends('layout.app')
@section('title', 'Daftar Pembayaran - Istana Qurban')
@section('css')
    <style>
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h1 {
            color: #1e4d2b;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- ALERT SUCCESS --- */
        .alert-success {
            background: #d1e7dd;
            color: #1e4d2b;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #4c9b77;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        /* --- TRANSACTION CARD BLOCK --- */
        .pembayaran-card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #ddd;
        }

        .card-header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f2f2f2;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }

        .card-title {
            color: #1e4d2b;
            font-size: 18px;
            font-weight: 800;
        }

        .header-meta {
            font-size: 13px;
            color: #555;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .meta-price {
            font-weight: bold;
            color: #222;
        }

        /* --- STATUS BADGES --- */
        .badge {
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .status-lunas {
            background: #4bd18e;
            color: white;
        }

        .status-belum-lunas {
            background: #e53e3e;
            color: white;
        }

        /* --- TABLE STYLING --- */
        .table-container {
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #eee;
            margin-top: 10px;
        }

        table {
            /* width: 100%; */
            border-collapse: collapse;
            font-size: 13px;
            background-color: #fff;
        }

        thead {
            background-color: #4c9b77;
            color: white;
        }

        th {
            padding: 12px 15px;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 11px;
            font-weight: 800;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #444;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f9f9f9;
        }

        .btn-bukti {
            text-decoration: none;
            background: #f8f9fa;
            color: #1e4d2b;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 800;
            border: 1px solid #ccc;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-bukti:hover {
            background: #4c9b77;
            color: white;
            border-color: #4c9b77;
        }

        .btn-back {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #666;
            font-weight: bold;
            font-size: 13px;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: #1e4d2b;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1>Daftar Pembayaran</h1>

        @if (session()->has('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @forelse  ($pesanans as $pesanan)
            <div class="pembayaran-card">

                <div class="card-header-info">
                    <h3 class="card-title">{{ $pesanan->pembeli->nama }} — Sapi #{{ $pesanan->sapi->kode_sapi }}</h3>
                    <div class="header-meta">
                        <span>Harga Sapi: <span
                                class="meta-price">Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</span></span>

                        <span class="badge @if ($pesanan->status_pembayaran == 'Lunas') status-lunas @else status-belum-lunas @endif">
                            @if ($pesanan->status_pembayaran == 'Lunas')
                                LUNAS
                            @else
                                BELUM LUNAS
                            @endif
                        </span>
                    </div>
                </div>

                <div class="table-responsive-custom">
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Tipe</th>
                                <th>Jumlah Bayar</th>
                                <th>Sisa Bayar</th>
                                <th style="text-align: center;">Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan->pembayarans as $pembayaran)
                                <tr>
                                    <td style="font-weight: 600;">{{ $pembayaran->tanggal_transaksi }}</td>
                                    <td>{{ $pembayaran->tipe }}</td>
                                    <td style="font-weight: bold; color: #1e4d2b;">
                                        Rp{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td style="font-weight: 600; color: #e53e3e;">
                                        Rp{{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</td>
                                    <td style="text-align: center;">
                                        @if ($pembayaran->foto_bukti)
                                            <a href="{{ asset('storage/' . $pembayaran->foto_bukti) }}" target="_blank"
                                                class="btn-bukti">LIHAT FOTO</a>
                                        @else
                                            <span style="color: #999; font-weight: bold;">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @empty
            <!-- Layout atau pesan yang tampil jika data KOSONG -->
            <div class="alert alert-info text-center" style="padding: 20px; color: #666;">
                <p>📝 Data pesanan belum ada</p>
            </div>
        @endforelse

    </div>

@endsection
