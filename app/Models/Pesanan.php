<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembeli_id',
        'sapi_id',
        'status',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class); //PESANAN INI milik seorang PEMBELI
    }

    public function sapi()
    {
        return $this->belongsTo(Sapi::class); //PESANAN INI milik/merujuk ke satu SAPI
    }
}