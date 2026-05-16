@extends('layout.app2')
@section('title', 'Tambah Sapi - Istana Qurban')
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
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .alert {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid #f5c6cb;
        }

        .f-row { 
            display: flex; 
            align-items: center; 
            margin-bottom: 12px; 
        }

        .f-row label { 
            width: 110px; 
            font-size: 13px; 
            font-weight: bold;
            color: #333;
        }

        .f-input { 
            flex: 1; 
            padding: 8px; 
            border: 1px solid #ccc; 
            font-size: 13px; 
            outline: none; 
            border-radius: 4px; 
            background: #fff;
        }

        .f-input:focus {
            border-color: #4c9b77;
        }

        /* Box Preview */
        .current-photo-preview {
            width: 100%;
            height: 180px; /* Sedikit lebih tinggi biar puas liatnya */
            background: #fff;
            border: 2px dashed #ccc; /* Pake garis putus-putus biar estetik */
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            overflow: hidden;
        }

        .current-photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-simpan {
            background: #d1e7dd;
            border: 1px solid #4c9b77;
            color: #1e4d2b;
            padding: 12px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
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
            margin-top: 15px;
            text-decoration: none;
            font-size: 12px;
            color: #666;
            font-weight: bold;
        }

        .section-label {
            font-size: 12px; 
            font-weight: bold; 
            display: block; 
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="modal-title">Tambah Data Sapi</h2>

    @if ($errors->any())
        <div class="alert">
            <ul style="margin-left: 15px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sapi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="section-label">Preview Foto :</label>
        <div class="current-photo-preview" id="preview-container">
            {{-- Default icon kalau belum pilih foto --}}
            <span id="preview-placeholder" style="color: #ccc; font-size: 40px;">📷</span>
            <img id="image-preview" src="" style="display: none;">
        </div>

        <label class="section-label">Upload Foto :</label>
        {{-- Kita tambah id="foto_input" untuk dipantau JavaScript --}}
        <input type="file" name="foto_path" id="foto_input" accept="image/*" style="font-size:11px; margin-bottom:20px; width: 100%;">

        <div class="f-row">
            <label>Kode :</label>
            <input type="text" name="kode_sapi" class="f-input" placeholder="#SP-000" value="{{ old('kode_sapi') }}" required>
        </div>

        <div class="f-row">
            <label>Berat (kg) :</label>
            <input type="number" name="bobot" class="f-input" placeholder="0" value="{{ old('bobot') }}" required>
        </div>

        <div class="f-row">
            <label>Jenis :</label>
            <input type="text" name="jenis_sapi" class="f-input" placeholder="Contoh: Limousin" value="{{ old('jenis_sapi') }}" required>
        </div>

        <div class="f-row">
            <label>Harga :</label>
            <input type="number" name="harga_jual" class="f-input" placeholder="Rp." value="{{ old('harga_jual') }}" required>
        </div>

        <button type="submit" class="btn-simpan">Simpan Sapi</button>
        <a href="{{ route('sapi.index') }}" class="btn-back">KEMBALI KE KATALOG</a>
    </form>
</div>

{{-- SCRIPT PREVIEW --}}
<script>
    const fotoInput = document.getElementById('foto_input');
    const imagePreview = document.getElementById('image-preview');
    const placeholder = document.getElementById('preview-placeholder');

    fotoInput.onchange = evt => {
        const [file] = fotoInput.files;
        if (file) {
            // Tampilkan gambar, sembunyikan icon kamera
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
            placeholder.style.display = 'none';
        }
    }
</script>

</body>
</html>
@endsection