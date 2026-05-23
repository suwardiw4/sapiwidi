<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    public function create(Pesanan $pesanan)
    {
        $totalDibayar = $pesanan->pembayarans()->sum('jumlah_bayar');
        $sisaBayar = $pesanan->sapi->harga_jual - $totalDibayar;

        // Kalau sudah lunas, tidak bisa input pembayaran lagi
        if ($sisaBayar <= 0) {
            return redirect()->route('pesanan.show', $pesanan)
                ->with('error', 'Pesanan ini sudah lunas!');
        }

        return view('pembayarans.create', compact('pesanan', 'totalDibayar', 'sisaBayar'));
    }

    public function store(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:1',
            'foto_bukti'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $totalDibayar = $pesanan->pembayarans()->sum('jumlah_bayar');
        $hargaSapi    = $pesanan->sapi->harga_jual;
        $sisaSebelum  = $hargaSapi - $totalDibayar;

        // Guard dulu sebelum apapun
        if ($request->jumlah_bayar > $sisaSebelum) {
            return back()->withErrors(['jumlah_bayar' => 'Jumlah bayar melebihi sisa tagihan.'])->withInput();
        }

        $sisaBayar = $sisaSebelum - $request->jumlah_bayar;
        $tipe = $sisaBayar <= 0 ? 'Lunas' : 'DP';

        // Handle upload foto bukti
        $fotoBukti = null;
        if ($request->hasFile('foto_bukti')) {
            $fotoBukti = $request->file('foto_bukti')->store('bukti_pembayaran', 'public');
        }

        // Simpan pembayaran
        Pembayaran::create([
            'pesanan_id'        => $pesanan->id,
            'jumlah_bayar'      => $request->jumlah_bayar,
            'sisa_bayar'        => $sisaBayar,
            'tipe'              => $tipe,
            'status_bayar'      => $sisaBayar <= 0 ? 'Lunas' : 'BL',
            'foto_bukti'        => $fotoBukti,
            'tanggal_transaksi' => now()->toDateString(),
        ]);

        // Update kalau lunas
        if ($sisaBayar <= 0) {
            $pesanan->update(['status_pembayaran' => 'Lunas']);
            Sapi::find($pesanan->sapi_id)->update(['status' => 'Terjual']);
        }

        return redirect()->route('pesanan.show', $pesanan)
            ->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function index()
    {
        $pesanans = Pesanan::with(['pembeli', 'sapi', 'pembayarans'])
            ->whereHas('pembayarans')
            ->get();
        return view('pembayarans.index', compact('pesanans'));
    }

    public function invoice(Pesanan $pesanan)
    {
        $totalDibayar = $pesanan->pembayarans()->sum('jumlah_bayar');
        $sisaBayar = $pesanan->sapi->harga_jual - $totalDibayar;

        $pdf = Pdf::loadView('pembayarans.invoice', compact('pesanan', 'totalDibayar', 'sisaBayar'));

        return $pdf->download('invoice-' . $pesanan->id . '.pdf');
    }
}
