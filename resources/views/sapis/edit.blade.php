@extends('layout.appmodal')
@section('title', 'Edit Data Sapi - Istana Qurban')
@section('css')
    <style>
        /* body {
                                                                                            background: #f5f6fa;
                                                                                            color: #222;
                                                                                            padding: 40px 20px;
                                                                                        } */

        /*
                                                                                        .container {
                                                                                                background: #efefef;
                                                                                                max-width: 500px;
                                                                                                margin: 0 auto;
                                                                                                padding: 30px;
                                                                                                border-radius: 8px;
                                                                                                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                                                                                                position: relative;
                                                                                            }
                                                                                                */

        .sapi-form-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
            /* Menarik tombol simpan dan teks kembali ke bagian bawah modal */
            /* margin: 10px auto 0 auto; */
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

        /*
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
                                                                            */

        .current-photo-preview {
            width: 100%;
            max-width: 280px;
            /* Diperkecil dari 350px */
            height: 130px;
            /* Diperkecil dari 180px */
            margin: 0 auto 15px auto;
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
        }

        .current-photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
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
@endsection

@section('content')
    <div class="sapi-form-card">
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

            <!-- Bagian Kontainer Utama Form Foto -->
            <div class="form-group-foto">
                <label style="font-size:12px; font-weight:bold; display:block; margin-bottom:5px;">Foto Sapi :</label>

                <div class="photo-display-area"
                    style="margin-bottom: 15px; display: flex; justify-content: center; align-items: center; width: 100%;">
                    @if ($sapi->foto_path)
                        <!-- TAMBAHKAN max-height dan object-fit DI SINI -->
                        <img class="js-photo-target" src="{{ asset('storage/' . $sapi->foto_path) }}" alt="Foto Sapi"
                            style="width: 100%; max-width: 280px; height: auto; max-height: 200px; object-fit: contain; display: block; border-radius: 4px; border: 1px solid #ddd;">
                        <span class="js-no-photo-text" style="color: #999; font-size: 12px; display: none;">Tidak ada
                            foto</span>
                    @else
                        <!-- LAKUKAN HAL YANG SAMA PADA TAG SCRIPT KOSONG -->
                        <img class="js-photo-target" src="" alt="Foto Sapi"
                            style="width: 100%; max-width: 280px; height: auto; max-height: 200px; object-fit: contain; display: none; border-radius: 4px; border: 1px solid #ddd;">
                        <span class="js-no-photo-text"
                            style="color: #999; font-size: 12px; display: block; text-align: center;">Tidak ada foto</span>
                    @endif
                </div>

                <label style="font-size:12px; font-weight:bold; display:block; margin-bottom:5px;">Ganti Foto (Opsional)
                    :</label>
                <input type="file" name="foto_path" accept="image/*" id="foto_input_{{ $sapi->id }}"
                    class="js-file-input" style="font-size:11px; margin-bottom:20px; width: 100%;">
            </div>

            <div class="f-row">
                <label>Kode :</label>
                <input type="text" name="kode_sapi" value="{{ old('kode_sapi', $sapi->kode_sapi) }}" class="f-input"
                    required>
            </div>

            <div class="f-row">
                <label>Berat (kg) :</label>
                <input type="number" name="bobot" value="{{ old('bobot', $sapi->bobot) }}" class="f-input" required>
            </div>

            <div class="f-row">
                <label>Jenis :</label>
                <input type="text" name="jenis_sapi" value="{{ old('jenis_sapi', $sapi->jenis_sapi) }}" class="f-input"
                    required>
            </div>

            <div class="f-row">
                <label>Harga :</label>
                <input type="number" name="harga_jual" value="{{ old('harga_jual', $sapi->harga_jual) }}" class="f-input"
                    required>
            </div>

            <button type="submit" class="btn-simpan">Update Data</button>
            <a href="{{ route('sapi.index') }}" class="btn-back">KEMBALI KE KATALOG</a>
        </form>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('change', function(event) {
            // Deteksi jika input file dengan class 'js-file-input' berubah
            if (event.target && event.target.classList.contains('js-file-input')) {

                const input = event.target;

                // Cari kontainer pembungkus form foto terdekat
                const container = input.closest('.form-group-foto');
                const imageTarget = container.querySelector('.js-photo-target');
                const noPhotoText = container.querySelector('.js-no-photo-text');

                if (imageTarget) {
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            // Timpa src gambar lama dengan data gambar baru
                            imageTarget.src = e.target.result;
                            imageTarget.style.display = 'block'; // Pastikan gambar muncul

                            if (noPhotoText) {
                                noPhotoText.style.display =
                                    'none'; // Sembunyikan teks "Tidak ada foto" jika sebelumnya kosong
                            }
                        };

                        reader.readAsDataURL(input.files[0]);
                    } else {
                        // Jika user membatalkan pilihan file (kembali ke kondisi semula)
                        // Opsi: Anda bisa mengosongkan gambar atau membiarkan gambar lama (disarankan membiarkan gambar lama jika ini mode edit)
                    }
                }
            }
        });
    </script>
@endpush
