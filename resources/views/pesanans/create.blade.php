@extends('layout.app2')
@section('title', 'Form Booking - Istana Qurban')

@section('css')
    <style>
        .booking-card {
            background: #fff;
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .modal-title {
            color: #1e4d2b;
            font-size: 22px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- INFO SAPI BOX --- */
        .info-sapi-box {
            background: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .info-sapi-box p {
            font-size: 13px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
        }

        .info-sapi-box p:last-child {
            margin-bottom: 0;
        }

        .info-sapi-box p strong {
            color: #666;
        }

        .info-sapi-box p span {
            font-weight: 600;
            color: #222;
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
            margin-bottom: 6px;
        }

        .f-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            font-size: 13px;
            outline: none;
            border-radius: 4px;
            background: #fff;
            color: #222;
            font-weight: 500;
        }

        .f-input:focus {
            border-color: #4c9b77;
            box-shadow: 0 0 0 3px rgba(76, 155, 119, 0.1);
        }

        textarea.f-input {
            resize: vertical;
            min-height: 90px;
            font-family: inherit;
        }

        /* --- TOMBOL --- */
        .btn-simpan {
            background: #d1e7dd;
            border: 1px solid #4c9b77;
            color: #1e4d2b;
            padding: 12px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            text-transform: uppercase;
            border-radius: 4px;
            letter-spacing: 0.5px;
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
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .btn-back:hover {
            color: #1e4d2b;
        }

        .divider {
            height: 1px;
            background: #eee;
            margin-bottom: 25px;
        }
    </style>
@endsection

@section('content')
    <div class="booking-card">
        <h2 class="modal-title">Form Booking Sapi</h2>

        <div class="info-sapi-box">
            <p><strong>Kode Sapi</strong> <span style="color: #1e4d2b; font-weight: 800;">#{{ $sapi->kode_sapi }}</span></p>
            <p><strong>Jenis Sapi</strong> <span>{{ $sapi->jenis_sapi }}</span></p>
            <p><strong>Bobot Komoditas</strong> <span>{{ $sapi->bobot }} kg</span></p>
            <p><strong>Harga Jual</strong> <span
                    style="color: #4c9b77; font-weight: 800;">Rp{{ number_format($sapi->harga_jual, 0, ',', '.') }}</span>
            </p>
        </div>

        <div class="divider"></div>

        <form action="{{ route('pesanan.store', $sapi->id) }}" method="POST">
            @csrf

            <div class="f-row">
                <label>Nama Pembeli</label>
                <input type="text" name="nama" class="f-input" placeholder="Masukkan nama lengkap pembeli" required>
            </div>

            <div class="f-row">
                <label>No. HP / WhatsApp</label>
                <input type="text" name="no_hp" class="f-input" placeholder="Contoh: 08123456xxx" required>
            </div>

            <div class="f-row">
                <label>Alamat Pengiriman</label>
                <textarea name="alamat" class="f-input" placeholder="Tulis alamat lengkap lokasi pengantaran" required></textarea>
            </div>

            <button type="submit" class="btn-simpan">Konfirmasi Booking</button>
            <a href="{{ route('sapi.index') }}" class="btn-back">← Kembali ke Katalog</a>
        </form>
    </div>

@endsection
