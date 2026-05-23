@extends('layout.app')
@section('title', 'Detail Pesanan - Istana Qurban')
@section('css')
    <style>
        /* --- GRID LAYOUT --- */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #4c9b77;
            padding-bottom: 18px;
            margin-bottom: 30px;
        }

        h1 {
            color: #1e4d2b;
            font-size: 24px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .header-status-block {
            display: flex;
            flex-direction: row;
            gap: 10px;
            align-items: center;
        }

        /* --- BADGES --- */
        .status-badge {
            padding: 5px 14px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 800;
            background: #f6ad55;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .pay-status {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 5px 14px;
            border-radius: 4px;
            display: inline-block;
        }

        .pay-lunas {
            background: #4bd18e;
            color: white;
        }

        .pay-belum {
            background: #e53e3e;
            color: white;
        }

        h3 {
            font-size: 13px;
            font-weight: 800;
            color: #1e4d2b;
            text-transform: uppercase;
            margin-bottom: 20px;
            border-left: 4px solid #4c9b77;
            padding-left: 10px;
            letter-spacing: 0.5px;
        }

        /* --- INFO ROW LAYOUT --- */
        .info-group {
            margin-bottom: 12px;
            font-size: 13px;
            display: flex;
            line-height: 1.5;
        }

        .info-label {
            width: 90px;
            font-weight: bold;
            color: #666;
        }

        .info-separator {
            width: 15px;
            color: #666;
            font-weight: bold;
        }

        .info-value {
            flex: 1;
            color: #222;
            font-weight: 600;
        }

        /* --- PHOTO SAPI --- */
        .photo-box {
            width: 100%;
            height: 220px;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #ccc;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- ACTION SECTION & BUTTONS --- */
        .action-section {
            margin-top: 40px;
            padding-top: 25px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-group-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* Base Button Style */
        .btn {
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
            display: inline-block;
            text-align: center;
            text-transform: uppercase;
            transition: all 0.2s;
            cursor: pointer;
            outline: none;
        }

        .btn-back {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #ccc;
        }

        .btn-back:hover {
            color: #1e4d2b;
            border-color: #1e4d2b;
        }

        .btn-pay {
            background: #d1e7dd;
            color: #1e4d2b;
            border: 1px solid #4c9b77;
        }

        .btn-pay:hover {
            background: #4c9b77;
            color: white;
        }

        .btn-invoice {
            background: #fff;
            color: #1e4d2b;
            border: 1px solid #ccc;
        }

        .btn-invoice:hover {
            background: #f2f2f2;
            border-color: #1e4d2b;
        }

        .btn-cancel {
            background: #fff;
            color: #e53e3e;
            border: 1px solid #e53e3e;
        }

        .btn-cancel:hover {
            background: #e53e3e;
            color: white;
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-status-block {
                align-items: flex-start;
                text-align: left;
            }

            .action-section {
                flex-direction: column;
                align-items: stretch;
            }

            .action-group-right {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('custom/css/formmodal.css') }}">
@endpush


@section('content')
    <div class="container"
        style="height: auto; min-height: unset; padding: 0;max-width: 850px; margin: 0 auto; background: #fff; padding: 35px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #ddd;">

        <div class="header-section">
            <h1>Detail Pesanan</h1>
            <div class="header-status-block">
                <span class="status-badge">{{ $pesanan->status }}</span>
                <span class="pay-status {{ $pesanan->status_pembayaran == 'Lunas' ? 'pay-lunas' : 'pay-belum' }}">
                    {{ $pesanan->status_pembayaran == 'Lunas' ? 'LUNAS' : 'BELUM LUNAS' }}
                </span>
            </div>
        </div>

        <div class="detail-grid">
            <div>
                <h3>Informasi Pembeli</h3>
                <div class="info-group">
                    <span class="info-label">Nama</span>
                    <span class="info-separator">:</span>
                    <span class="info-value">{{ $pesanan->pembeli->nama }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">No HP</span>
                    <span class="info-separator">:</span>
                    <span class="info-value">{{ $pesanan->pembeli->no_hp }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Alamat</span>
                    <span class="info-separator">:</span>
                    <span class="info-value" style="font-weight: 500; color: #444;">{{ $pesanan->pembeli->alamat }}</span>
                </div>
            </div>

            <div>
                <h3>Informasi Sapi</h3>
                <div class="photo-box">
                    @if ($pesanan->sapi->foto_path)
                        <img src="{{ asset('storage/' . $pesanan->sapi->foto_path) }}" alt="Foto Sapi">
                    @else
                        <span style="color: #bbb; font-size: 12px; font-weight: bold; text-transform: uppercase;">Belum Ada
                            Foto</span>
                    @endif
                </div>
                <div class="info-group">
                    <span class="info-label">Kode Sapi</span>
                    <span class="info-separator">:</span>
                    <span class="info-value"
                        style="color: #1e4d2b; font-weight: 800;">#{{ $pesanan->sapi->kode_sapi }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Jenis</span>
                    <span class="info-separator">:</span>
                    <span class="info-value">{{ $pesanan->sapi->jenis_sapi }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Bobot</span>
                    <span class="info-separator">:</span>
                    <span class="info-value">{{ $pesanan->sapi->bobot }} kg</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Harga</span>
                    <span class="info-separator">:</span>
                    <span class="info-value" style="color: #4c9b77; font-weight: 800; font-size: 15px;">
                        Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="action-section">
            <a href="{{ route('pesanan.index') }}" class="btn btn-back">← KEMBALI</a>

            <div class="action-group-right">
                <a href="{{ route('pembayaran.invoice', $pesanan->id) }}" class="btn btn-invoice">🖨️ CETAK INVOICE</a>

                @if ($pesanan->status_pembayaran != 'Lunas')
                    {{-- <a href="{{ route('pembayaran.create', $pesanan->id) }}" class="btn btn-pay">INPUT PEMBAYARAN</a>
                     --}}
                    <button type="button" class="btn-input-pembayaran btn btn-pay"
                        data-url="{{ route('pembayaran.create', $pesanan->id) }}" {{-- Sesuaikan rute Anda --}}
                        id="btnBukaPembayaran">
                        INPUT PEMBAYARAN
                    </button>
                @endif

                <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-cancel">BATALKAN PESANAN</button>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('modals')
    <!-- Struktur Modal Kustom -->
    <div id="pembayaranModalKustom" class="modal-overlay-kustom">
        <div class="modal-box-kustom">

            <!-- BAGIAN HEADER BARU -->
            <div class="modal-header-kustom">
                <h5 class="modal-title-kustom">Form Pembayaran</h5>
                <span class="modal-close-kustom">&times;</span>
            </div>

            <!-- Wadah Konten Form Dinamis -->
            <div id="modalBodyPembayaran">
                <!-- Spinner Loading Awal -->
                <div class="modal-loading-kustom">
                    <div class="spinner-kustom"></div>
                    <p>Memuat form pembayaran...</p>
                </div>
            </div>

        </div>
    </div>
@endpush

@section('script')
    @include('pesanans.showscript')
@endsection
