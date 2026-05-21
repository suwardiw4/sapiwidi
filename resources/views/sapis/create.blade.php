@extends('layout.app')
@section('title', 'Tambah Sapi - Istana Qurban')
@section('css')
    <style>
        .sapi-form-card {
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
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid #f5c6cb;
        }

        .f-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .f-row label {
            width: 110px;
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

        /* Box Preview */
        .current-photo-preview {
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
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
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

        .section-label {
            font-size: 13px;
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
    </style>
@endsection

@section('content')
    <div class="sapi-form-card">
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

            <label class="section-label">Preview Foto</label>
            <div class="current-photo-preview" id="preview-container">
                {{-- Default icon kalau belum pilih foto --}}
                <span id="preview-placeholder" style="color: #bbb; font-size: 32px;">📷</span>
                <img id="image-preview" src="" style="display: none;">
            </div>

            <label class="section-label">Upload Foto</label>
            <input type="file" name="foto_path" id="foto_input" accept="image/*"
                style="font-size:12px; margin-bottom:20px; width: 100%; cursor: pointer;" required>

            <div class="f-row">
                <label>Kode Sapi</label>
                <input type="text" name="kode_sapi" class="f-input" placeholder="#SP-000" value="{{ old('kode_sapi') }}"
                    required>
            </div>

            <div class="f-row">
                <label>Berat (kg)</label>
                <input type="number" name="bobot" class="f-input" placeholder="0" value="{{ old('bobot') }}" required>
            </div>

            <div class="f-row">
                <label>Jenis Sapi</label>
                <input type="text" name="jenis_sapi" class="f-input" placeholder="Contoh: Limousin"
                    value="{{ old('jenis_sapi') }}" required>
            </div>

            <div class="f-row">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" class="f-input" placeholder="Rp." value="{{ old('harga_jual') }}"
                    required>
            </div>

            <button type="submit" class="btn-simpan">Simpan Sapi</button>
            <a href="{{ route('sapi.index') }}" class="btn-back">← Kembali ke Katalog</a>
        </form>
    </div>

@endsection

@section('script')
    {{-- SCRIPT INSTANT PREVIEW --}}
    <script>
        const fotoInput = document.getElementById('foto_input');
        const imagePreview = document.getElementById('image-preview');
        const placeholder = document.getElementById('preview-placeholder');

        fotoInput.onchange = evt => {
            const [file] = fotoInput.files;
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
                placeholder.style.display = 'none';
            }
        }
    </script>
@endsection
