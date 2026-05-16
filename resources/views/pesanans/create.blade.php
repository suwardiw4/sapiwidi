@extends('layout.app2')
@section('title', 'Form Booking - Istana Qurban')
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
            background: #efefef; 
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative;
        }

        .modal-title {
            color: #4c9b77; 
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* --- INFO SAPI BOX --- */
        .info-sapi-box {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .info-sapi-box p {
            font-size: 13px;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }

        .info-sapi-box p strong {
            color: #4c9b77;
        }

        /* --- FORM LAYOUT --- */
        .f-row { 
            display: flex; 
            flex-direction: column; 
            margin-bottom: 15px; 
        }

        .f-row label { 
            font-size: 13px; 
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .f-input { 
            width: 100%;
            padding: 10px; 
            border: 1px solid #ccc; 
            font-size: 13px; 
            outline: none; 
            border-radius: 4px; 
            background: #fff;
        }

        .f-input:focus {
            border-color: #4c9b77;
        }

        textarea.f-input {
            resize: vertical;
            min-height: 80px;
        }

        /* --- TOMBOL --- */
        .btn-simpan {
            background: #d1e7dd;
            border: 1px solid #4c9b77;
            color: #1e4d2b;
            padding: 12px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            text-transform: uppercase;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .btn-simpan:hover {
            background: #4c9b77;
            color: white;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            font-size: 12px;
            color: #666;
            font-weight: bold;
        }

        .btn-back:hover {
            color: #1e4d2b;
        }

        .divider {
            height: 1px;
            background: #ccc;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="modal-title">Form Booking Sapi</h2>

    <div class="info-sapi-box">
        <p><strong>Kode Sapi:</strong> <span>{{ $sapi->kode_sapi }}</span></p>
        <p><strong>Jenis:</strong> <span>{{ $sapi->jenis_sapi }}</span></p>
        <p><strong>Bobot:</strong> <span>{{ $sapi->bobot }} kg</span></p>
        <p><strong>Harga:</strong> <span>Rp{{ number_format($sapi->harga_jual, 0, ',', '.') }}</span></p>
    </div>

    <div class="divider"></div>

    <form action="{{ route('pesanan.store', $sapi->id) }}" method="POST">
        @csrf
        
        <div class="f-row">
            <label>Nama Lengkap Pembeli :</label>
            <input type="text" name="nama" class="f-input" placeholder="Masukkan nama pembeli" required>
        </div>

        <div class="f-row">
            <label>Nomor HP (WhatsApp) :</label>
            <input type="text" name="no_hp" class="f-input" placeholder="Contoh: 08123456xxx" required>
        </div>

        <div class="f-row">
            <label>Alamat Pengiriman :</label>
            <textarea name="alamat" class="f-input" placeholder="Tulis alamat lengkap pengantaran" required></textarea>
        </div>

        <button type="submit" class="btn-simpan">Konfirmasi Booking</button>
        <a href="{{ route('sapi.index') }}" class="btn-back">← KEMBALI KE KATALOG</a>
    </form>
</div>

</body>
</html>
@endsection