@extends('layout.app2')
@section('title', 'Detail Pesanan - Istana Qurban')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        body {
            background: #f5f6fa;
            color: #222;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 1px solid #ddd;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #4c9b77;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        h1 {
            color: #1e4d2b;
            font-size: 22px;
            text-transform: uppercase;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            background: #f6ad55;
            color: white;
            text-transform: uppercase;
        }

        /* --- GRID LAYOUT --- */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        h3 {
            font-size: 14px;
            color: #4c9b77;
            text-transform: uppercase;
            margin-bottom: 15px;
            border-left: 4px solid #4c9b77;
            padding-left: 10px;
        }

        .info-group {
            margin-bottom: 10px;
            font-size: 14px;
            display: flex;
        }

        .info-label {
            width: 100px;
            font-weight: bold;
            color: #666;
        }

        .info-value {
            flex: 1;
            color: #333;
        }

        /* --- FOTO SAPI --- */
        .photo-box {
            width: 100%;
            height: 200px;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #ddd;
            background: #efefef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- ACTIONS --- */
        .action-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-cancel {
            background: #fff;
            color: #e53e3e;
            border: 1px solid #e53e3e;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #e53e3e;
            color: white;
        }

        .btn-back {
            text-decoration: none;
            color: #666;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-back:hover {
            color: #4c9b77;
        }

        @media (max-width: 600px) {
            .detail-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <h1>Detail Pesanan</h1>
        <span class="status-badge">{{ $pesanan->status }}</span>
    </div>

    <div class="detail-grid">
        <!-- Kolom Pembeli -->
        <div>
            <h3>Informasi Pembeli</h3>
            <div class="info-group">
                <div class="info-label">Nama</div>
                <div class="info-value">: {{ $pesanan->pembeli->nama }}</div>
            </div>
            <div class="info-group">
                <div class="info-label">No HP</div>
                <div class="info-value">: {{ $pesanan->pembeli->no_hp }}</div>
            </div>
            <div class="info-group" style="flex-direction: column;">
                <div class="info-label">Alamat :</div>
                <div class="info-value" style="margin-top: 5px; line-height: 1.5;">{{ $pesanan->pembeli->alamat }}</div>
            </div>
        </div>

        <!-- Kolom Sapi -->
        <div>
            <h3>Informasi Sapi</h3>
            <div class="photo-box">
                @if($pesanan->sapi->foto_path)
                    <img src="{{ asset('storage/' . $pesanan->sapi->foto_path) }}" alt="Foto Sapi">
                @else
                    <span style="color: #999; font-size: 12px;">Tidak ada foto</span>
                @endif
            </div>
            <div class="info-group">
                <div class="info-label">Kode</div>
                <div class="info-value">: <strong>{{ $pesanan->sapi->kode_sapi }}</strong></div>
            </div>
            <div class="info-group">
                <div class="info-label">Jenis</div>
                <div class="info-value">: {{ $pesanan->sapi->jenis_sapi }}</div>
            </div>
            <div class="info-group">
                <div class="info-label">Bobot</div>
                <div class="info-value">: {{ $pesanan->sapi->bobot }} kg</div>
            </div>
            <div class="info-group">
                <div class="info-label">Harga</div>
                <div class="info-value" style="color: #4c9b77; font-weight: bold;">
                    : Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

    <div class="action-section">
        <a href="{{ route('pesanan.index') }}" class="btn-back">← KEMBALI KE DAFTAR</a>

        <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-cancel">BATALKAN PESANAN</button>
        </form>
    </div>
</div>

</body>
</html>
@endsection