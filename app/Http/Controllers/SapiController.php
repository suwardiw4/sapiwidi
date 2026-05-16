<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;
use Illuminate\Support\Facades\Storage;

class SapiController extends Controller
{
    public function index(){
        $sapis = Sapi::all();
        return view('sapis.index', ['sapis' => $sapis]);
        
    }

    public function create(){
        return view('sapis.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
        'kode_sapi'  => 'required',
        'jenis_sapi' => 'required',
        'bobot'      => 'required|numeric',
        'harga_jual' => 'required|numeric',
        'foto_path'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $validatedData['status'] = 'Tersedia';

    // PROSES FOTO:
    if ($request->hasFile('foto_path')) {
        // 1. Simpan file fisiknya ke storage/app/public/sapi_images
        $path = $request->file('foto_path')->store('sapi_images', 'public');
        
        // 2. Timpa isi 'foto_path' dengan alamat string-nya saja
        $validatedData['foto_path'] = $path;
    }

    // SIMPAN KE DATABASE (Isinya sekarang sudah aman karena string semua)
    Sapi::create($validatedData);

    return redirect()->route('sapi.index');
    }

    public function edit(Sapi $sapi){
        return view('sapis.edit', ['sapi' => $sapi]);

    }

    public function update(Sapi $sapi, Request $request){
    $validatedData = $request->validate([
        'kode_sapi'  => 'required',
        'jenis_sapi' => 'required',
        'bobot'      => 'required|numeric',
        'harga_jual' => 'required|numeric',
        'foto_path'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // required -> nullable
    ]);

    // Handle foto
    if ($request->hasFile('foto_path')) {
        // Ada foto baru, hapus yang lama lalu simpan yang baru
        Storage::delete('public/' . $sapi->foto_path);
        $validatedData['foto_path'] = $request->file('foto_path')->store('sapi_images', 'public');
    } else {
        // Tidak ada foto baru, pakai foto lama
        unset($validatedData['foto_path']);
    }

    $sapi->update($validatedData);

    return redirect()->route('sapi.index')->with('success', 'Berhasil meng-update sapi');
}

    public function destroy(sapi $sapi){
        $sapi->delete();

        return redirect()->route('sapi.index')->with('success', 'Berhasil meng-hapus sapi');
    }
}
