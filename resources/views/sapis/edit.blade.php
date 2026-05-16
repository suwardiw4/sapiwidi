@extends('layout.app2')
@section('title', 'Edit Data Sapi - Istana Qurban')
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

        .current-photo-preview {
            width: 100%;
            height: 150px;
            background: #fff;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 4px;
        }

        .current-photo-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
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

        .btn-back:hover {
            color: #1e4d2b;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="modal-title">Edit Data Sapi</h2>

    {{-- Alert Error --}}
    @if ($errors->any())
        <div class="alert">
            <ul style="margin-left: 15px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sapi.update', $sapi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Preview Foto Saat Ini --}}
        <label style="font-size:12px; font-weight:bold; display:block; margin-bottom:5px;">Foto Saat Ini :</label>
        <div class="current-photo-preview">
            @if($sapi->foto_path)
                <img src="{{ asset('storage/' . $sapi->foto_path) }}" alt="foto sapi">
            @else
                <span style="color: #999; font-size: 12px;">Tidak ada foto</span>
            @endif
        </div>

        <label style="font-size:12px; font-weight:bold; display:block; margin-bottom:5px;">Upload Foto Baru (Opsional) :</label>
        <input type="file" name="foto_path" accept="image/*" style="font-size:11px; margin-bottom:20px; width: 100%;">

        <div class="f-row">
            <label>Kode :</label>
            <input type="text" name="kode_sapi" value="{{ old('kode_sapi', $sapi->kode_sapi) }}" class="f-input" required>
        </div>

        <div class="f-row">
            <label>Berat (kg) :</label>
            <input type="number" name="bobot" value="{{ old('bobot', $sapi->bobot) }}" class="f-input" required>
        </div>

        <div class="f-row">
            <label>Jenis :</label>
            <input type="text" name="jenis_sapi" value="{{ old('jenis_sapi', $sapi->jenis_sapi) }}" class="f-input" required>
        </div>

        <div class="f-row">
            <label>Harga :</label>
            <input type="number" name="harga_jual" value="{{ old('harga_jual', $sapi->harga_jual) }}" class="f-input" required>
        </div>

        <button type="submit" class="btn-simpan">Update Data</button>
        <a href="{{ route('sapi.index') }}" class="btn-back">KEMBALI KE KATALOG</a>
    </form>
</div>

</body>
</html>
@endsection