@extends('layout.app2')
@section('title', 'Invoice Pembayaran - Istana Qurban')
@section('css')
    <style>
        body {
            background: #fff;
            color: #222;
            padding: 40px;
        }

        /* --- HEADER NOTA --- */
        .header {
            text-align: center;
            margin-bottom: 35px;
            border-bottom: 3px double #1e4d2b;
            padding-bottom: 15px;
        }

        .header h1 {
            color: #1e4d2b;
            font-size: 26px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .header p {
            color: #555;
            font-size: 13px;
            font-weight: 600;
        }

        .header .date {
            color: #888;
            font-size: 12px;
            margin-top: 3px;
            font-weight: normal;
        }

        h3 {
            color: #1e4d2b;
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        /* --- TABLE STYLING --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 13px;
        }

        th,
        td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4c9b77;
            color: white;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .table-info td:first-child {
            width: 150px;
            background: #f9f9f9;
            font-weight: bold;
            color: #444;
        }

        .table-info td:last-child {
            font-weight: 600;
        }

        .total-row {
            font-weight: bold;
            background-color: #f5f6fa;
        }

        .total-row td {
            color: #222;
        }

        /* --- STATUS TABLE --- */
        .table-status {
            width: auto;
            margin-top: 25px;
            border-collapse: collapse;
        }

        .table-status td {
            border: none !important;
            padding: 0 10px 0 0 !important;
            vertical-align: middle;
        }

        .status-label {
            font-size: 13px;
            font-weight: bold;
            color: #222;
        }

        .status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .lunas {
            background: #4bd18e;
            color: white;
        }

        .belum {
            background: #e53e3e;
            color: white;
        }

        /* --- FOOTER NOTA --- */
        .footer {
            margin-top: 60px;
            text-align: center;
            color: #777;
            font-size: 11px;
            border-top: 1px dashed #ddd;
            padding-top: 15px;
            line-height: 1.6;
        }
    </style>
@endsection

@section('content')
    <div class="header">
        <h1>ISTANA QURBAN</h1>
        <p>INVOICE PEMBAYARAN</p>
        <p class="date">Tanggal Cetak: {{ now()->format('d M Y') }}</p>
    </div>

    <table class="table-info">
        <tr>
            <td>Nama Pembeli</td>
            <td>{{ $pesanan->pembeli->nama }}</td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>{{ $pesanan->pembeli->no_hp }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>{{ $pesanan->pembeli->alamat }}</td>
        </tr>
        <tr>
            <td>Kode Sapi</td>
            <td><span style="color: #1e4d2b;">#{{ $pesanan->sapi->kode_sapi }}</span></td>
        </tr>
        <tr>
            <td>Harga Sapi</td>
            <td style="color: #1e4d2b;">Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h3>Riwayat Pembayaran</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Jumlah Bayar</th>
                <th>Sisa Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesanan->pembayarans as $pembayaran)
                <tr>
                    <td>{{ $pembayaran->tanggal_transaksi }}</td>
                    <td>{{ $pembayaran->tipe }}</td>
                    <td style="font-weight: 600;">Rp{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                    <td style="color: #e53e3e;">Rp{{ number_format($sisaBayar, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="2"
                    style="text-align: right; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">Total
                    Dibayar:</td>
                <td style="color: #1e4d2b;">Rp{{ number_format($totalDibayar, 0, ',', '.') }}</td>
                <td style="color: #e53e3e;">Rp{{ number_format($sisaBayar, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table-status">
        <tr>
            <td class="status-label">STATUS PEMBAYARAN:</td>
            <td>
                <span class="status {{ $pesanan->status_pembayaran == 'Lunas' ? 'lunas' : 'belum' }}">
                    {{ $pesanan->status_pembayaran == 'Lunas' ? 'LUNAS' : 'BELUM LUNAS' }}
                </span>
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak otomatis oleh Sistem Manajemen Istana Qurban</p>
        <p>Terima kasih atas kerja sama dan kepercayaan Anda.</p>
    </div>

@endsection
