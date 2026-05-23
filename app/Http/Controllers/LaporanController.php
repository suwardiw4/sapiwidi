<?php

namespace App\Http\Controllers;

use App\Models\Sapi;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // ── DATE PICKER ──
        // Default hari ini, kecuali user pilih range atau "semua data"
        $semuaData  = $request->has('semua');
        $dari       = $request->input('dari', today()->toDateString());
        $sampai     = $request->input('sampai', today()->toDateString());

        // ── RINGKASAN SESUAI FILTER ──
        $sapiTerjualFilter = Pesanan::when(!$semuaData, function ($q) use ($dari, $sampai) {
            return $q->whereDate('updated_at', '>=', $dari)
                ->whereDate('updated_at', '<=', $sampai);
        })
            ->where('status_pembayaran', 'Lunas')
            ->count();

        $pemasukanFilter = Pembayaran::when(!$semuaData, function ($q) use ($dari, $sampai) {
            return $q->whereDate('tanggal_transaksi', '>=', $dari)
                ->whereDate('tanggal_transaksi', '<=', $sampai);
        })
            ->sum('jumlah_bayar');

        // ── PIE CHART — tidak terpengaruh filter ──
        $totalTersedia = Sapi::where('status', 'Tersedia')->count();
        $totalDipesan  = Sapi::where('status', 'Booking')->count();
        $totalTerjual  = Sapi::where('status', 'Terjual')->count();

        // ── BAR CHART OMSET ──
        // Ambil omset per hari sesuai filter, group by tanggal
        $omsetPerHari = Pembayaran::when(!$semuaData, function ($q) use ($dari, $sampai) {
            return $q->whereDate('tanggal_transaksi', '>=', $dari)
                ->whereDate('tanggal_transaksi', '<=', $sampai);
        })
            ->selectRaw('tanggal_transaksi, SUM(jumlah_bayar) as total')
            ->groupBy('tanggal_transaksi')
            ->orderBy('tanggal_transaksi')
            ->get();

        // Format untuk Chart.js
        $labelHari  = $omsetPerHari->pluck('tanggal_transaksi')->toArray();
        $dataOmset  = $omsetPerHari->pluck('total')->toArray();

        // ── OMSET TOTAL (tombol "Omset Total") ──
        $totalPemasukan = Pembayaran::sum('jumlah_bayar');

        // ── TABEL DETAIL PENJUALAN ──
        $penjualans = Pesanan::with(['pembeli', 'sapi', 'pembayarans'])
            ->where('status_pembayaran', 'Lunas')
            ->get();

        // ── LAPORAN STOK AKHIR ──
        $sapiTersedia = Sapi::where('status', 'Tersedia')->get();
        $sapiDipesan  = Pesanan::with(['pembeli', 'sapi'])
            ->where('status', 'Booking')
            ->get();

        return view('laporans.index', compact(
            'semuaData',
            'dari',
            'sampai',
            'sapiTerjualFilter',
            'pemasukanFilter',
            'totalTersedia',
            'totalDipesan',
            'totalTerjual',
            'labelHari',
            'dataOmset',
            'totalPemasukan',
            'penjualans',
            'sapiTersedia',
            'sapiDipesan'
        ));
    }
}
