@extends('layout.appmodal')
{{-- @section('title', 'Input Pembayaran - Istana Qurban') --}}
@section('css')
    <style>
        .payment-card {
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
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .alert {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid #f5c6cb;
        }

        /* --- INFO ROW STYLE --- */
        .info-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #eee;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            padding: 8px 0;
            border-bottom: 1px dashed #e2e8f0;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-row:first-child {
            padding-top: 0;
        }

        .info-label {
            font-weight: bold;
            color: #666;
        }

        .info-value {
            font-weight: 700;
            color: #222;
        }

        /* --- FORM LAYOUT --- */
        .f-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .f-row label {
            width: 120px;
            font-size: 13px;
            font-weight: bold;
            color: #333;
        }

        .f-input {
            flex: 1;
            padding: 10px 12px;
            border: 1px solid #ccc;
            font-size: 13px;
            outline: none;
            border-radius: 4px;
            background: #fff;
            color: #222;
            font-weight: 500;
            transition: border-color 0.2s;
        }

        .f-input:focus {
            border-color: #4c9b77;
            box-shadow: 0 0 0 3px rgba(76, 155, 119, 0.1);
        }

        /* --- PHOTO PREVIEW BOX --- */
        .photo-placeholder {
            width: 100%;
            height: 180px;
            background: #fafafa;
            border: 2px dashed #ccc;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .photo-placeholder span {
            color: #bbb;
            font-size: 32px;
        }

        .photo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        /* --- BUTTONS --- */
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
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: #1e4d2b;
        }

        .section-label {
            font-size: 13px;
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        #modalBodyPembayaran .modal-title {
            margin-bottom: 10px !important;
            font-size: 18px !important;
            /* Memperkecil sedikit ukuran teks agar seimbang */
        }
    </style>
@endsection

@section('content')
    <div class="payment-card">
        <h2 class="modal-title">Input Pembayaran</h2>

        {{-- Error Handling --}}
        @if ($errors->any())
            <div class="alert">
                <ul style="margin-left: 15px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Ringkasan Data Pesanan --}}
        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Pembeli</span>
                <span class="info-value">{{ $pesanan->pembeli->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Sapi</span>
                <span class="info-value" style="color: #1e4d2b;">#{{ $pesanan->sapi->kode_sapi }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Harga</span>
                <span class="info-value">Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Sudah Dibayar</span>
                <span class="info-value" style="color: #38b2ac;">Rp{{ number_format($totalDibayar, 0, ',', '.') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Sisa Bayar</span>
                <span class="info-value" style="color: #e53e3e;">Rp{{ number_format($sisaBayar, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Form Input --}}
        <form action="{{ route('pembayaran.store', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="f-row">
                <label>Jumlah Bayar</label>
                <input type="number" name="jumlah_bayar" class="f-input" placeholder="Rp."
                    value="{{ old('jumlah_bayar') }}" required>
            </div>

            <label class="section-label">Preview Bukti Transfer</label>
            <div class="photo-placeholder">
                <span id="cam-icon">📷</span>
                <img id="img-preview" src="#" alt="Preview Bukti Transfer">
            </div>

            <label class="section-label">Upload Bukti Transfer</label>
            <input type="file" name="foto_bukti" id="foto_input" accept="image/*"
                style="font-size:12px; margin-bottom:20px; width: 100%; cursor: pointer;">

            <button type="submit" class="btn-simpan">Simpan Pembayaran</button>
            <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn-back">← KEMBALI KE DETAIL PESANAN</a>
        </form>
    </div>

@endsection

@section('script')
    {{-- INSTANT PREVIEW SCRIPT --}}
    <script>
        const fotoInput = document.getElementById('foto_input');
        const imgPreview = document.getElementById('img-preview');
        const camIcon = document.getElementById('cam-icon');

        fotoInput.onchange = evt => {
            const [file] = fotoInput.files;
            if (file) {
                imgPreview.src = URL.createObjectURL(file);
                imgPreview.style.display = 'block';
                camIcon.style.display = 'none';
            }
        }
    </script>
@endsection
