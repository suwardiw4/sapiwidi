<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pembeli;
use App\Models\Sapi;
use App\Models\Pembayaran;
class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembeli_id',
        'sapi_id',
        'status',
        'status_pembayaran'
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class); //PESANAN INI milik seorang PEMBELI
    }

    public function sapi()
    {
        return $this->belongsTo(Sapi::class); //PESANAN INI milik/merujuk ke satu SAPI
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}