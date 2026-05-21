<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sapi;
use App\Models\Pesanan;
use App\Models\Pembeli;

class PesananController extends Controller
{
    public function create(Sapi $sapi)
    {
        if ($sapi->status !== 'Tersedia') {
            return redirect()->route('sapi.index')->with('error', 'Sapi ini tidak tersedia');
        }

        return view('pesanans.create', compact('sapi')); //sama dengan ['sapi' => $sapi]
    }

    public function store(Request $request, Sapi $sapi)
    {
        if ($sapi->status !== 'Tersedia') {
            return redirect()->route('sapi.index')->with('error', 'Sapi ini tidak tersedia'); //cegah double booking
        }
        $request->validate([
            'nama'   => 'required',
            'no_hp'  => 'required',
            'alamat' => 'required',
        ]);

        DB::transaction(function () use ($request, $sapi) {
            $pembeli = Pembeli::create([
                'nama'   => $request->nama,
                'no_hp'  => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            Pesanan::create([
                'pembeli_id' => $pembeli->id,
                'sapi_id'    => $sapi->id,
                'status'     => 'Booking',
            ]);

            $sapi->update(['status' => 'Booking']);
        });

        return redirect()->route('sapi.index')->with('success', 'Berhasil melakukan booking');
    }

    public function index()
    {
        $pesanans = Pesanan::with(['pembeli', 'sapi'])->get();
        return view('pesanans.index', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        return view('pesanans.show', compact('pesanan'));
    }

    public function destroy(Pesanan $pesanan)
    {
        DB::transaction(function () use ($pesanan) {
            $pesanan->sapi->update(['status' => 'Tersedia']);
            $pesanan->pembeli->delete();
            $pesanan->delete();
        });

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibatalkan');
    }
}
