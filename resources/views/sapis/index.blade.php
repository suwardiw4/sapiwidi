@extends('layout.app')
@section('title', 'Katalog Sapi - Istana Qurban')
@section('css')
    <style>
        /* --- LAYOUT --- */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .card {
            background: #fdfdfd;
            border: 1px solid #e0e0e0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
        }

        .card-image {
            width: 100%;
            height: 160px;
            background: #eee;

        }

        .card-image img {
            /* width: 100%;
                                        height: 100%;
                                        object-fit: cover; */
            width: auto;
            max-width: 280px;
            height: 160px;
            max-height: 200px;
            object-fit: contain;
            display: block;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-left: auto;
            margin-right: auto;
        }


        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .id-text {
            font-size: 18px;
            font-weight: 600;
            color: #000;
        }

        .status-badge {
            padding: 4px 10px;
            font-size: 11px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
        }

        .status-available {
            background-color: #38b2ac;
        }

        .status-booking {
            background-color: #f6ad55;
        }

        .status-sold {
            background-color: #e53e3e;
        }

        .card-description {
            font-size: 16px;
            font-weight: 500;
            color: #000;
            margin-bottom: 15px;
        }

        .price-text {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin-bottom: 12px;
        }

        /* --- ACTIONS (Tombol) --- */
        .actions {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .btn-minimal {
            background: #e0e0e0;
            border: 1px solid #ccc;
            color: #333;
            padding: 6px 12px;
            font-size: 11px;
            font-weight: bold;
            text-decoration: none;
            text-transform: uppercase;
            cursor: pointer;
            text-align: center;
            min-width: 60px;
        }

        .btn-minimal:hover {
            background: #d5d5d5;
        }

        form {
            display: inline;
        }

        .catalog-header {
            margin-bottom: 30px;
        }

        .catalog-header h2 {
            color: #0b4228;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 5px;
        }
    </style>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('custom/css/formmodal.css') }}">
@endpush

@section('content')
    <div class="container">

        <div class="catalog-header">
            <h2>Katalog Sapi Qurban</h2>
            <p>Pilih dan pesan hewan qurban terbaik dengan kualitas terjamin.</p>
        </div>

        <div class="top-bar">
            <button type="button" class="btn-add" data-url="{{ route('sapi.create') }}" id="btnBukaFormSapi">
                + TAMBAH SAPI
            </button>
        </div>

        <div class="grid">
            @foreach ($sapis as $sapi)
                <div class="card">
                    <div class="card-image">
                        @if ($sapi->foto_path)
                            <img src="{{ asset('storage/' . $sapi->foto_path) }}" alt="Foto Sapi" style="">
                        @else
                            <div
                                style="height:100%; display:flex; align-items:center; justify-content:center; color:#999; font-size: 12px;">
                                No Image</div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="card-header-row">
                            <div class="id-text">#{{ $sapi->kode_sapi }}</div>
                            <span
                                class="status-badge 
                            @if ($sapi->status == 'Tersedia') status-available 
                            @elseif($sapi->status == 'Booking') status-booking 
                            @else status-sold @endif">
                                @if ($sapi->status == 'Tersedia')
                                    AVAILABLE
                                @elseif($sapi->status == 'Terjual')
                                    SOLD
                                @else
                                    {{ strtoupper($sapi->status) }}
                                @endif
                            </span>
                        </div>

                        <div class="card-description">
                            {{ $sapi->jenis_sapi }} • {{ $sapi->bobot }} kg
                        </div>

                        <div class="price-text">
                            RP{{ number_format($sapi->harga_jual, 0, ',', '.') }}
                        </div>

                        <div class="actions">
                            <a data-url="{{ route('sapi.edit', $sapi->id) }}" class="btn-minimal btn-edit-sapi"
                                id="btnBukaFormSapiEdit[]">EDIT</a>

                            @if ($sapi->status == 'Tersedia')
                                <a href="{{ route('pesanan.create', $sapi->id) }}" class="btn-minimal">PESAN</a>
                            @endif
                            <form method="POST" action="{{ route('sapi.destroy', $sapi->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-minimal" onclick="return confirm('Hapus data?')">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@push('modals')
    <!-- Struktur Modal Kustom -->
    <div id="frmSapiModalKustom" class="modal-overlay-kustom">
        <div class="modal-box-kustom">

            <!-- BAGIAN HEADER BARU -->
            <div class="modal-header-kustom">
                <h5 id="titlemodal" class="modal-title-kustom">Form Tambah Data Sapi</h5>
                <span class="modal-close-kustom">&times;</span>
            </div>

            <!-- Wadah Konten Form Dinamis -->
            <div id="modalBody">
                <!-- Spinner Loading Awal -->
                <div class="modal-loading-kustom">
                    <div class="spinner-kustom"></div>
                    <p>Memuat form ...</p>
                </div>
            </div>

        </div>
    </div>
@endpush

@section('script')
    @include('sapis.indexjs')
@endsection
