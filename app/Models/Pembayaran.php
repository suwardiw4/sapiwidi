<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pesanan;
class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'jumlah_bayar',
        'sisa_bayar',
        'tipe',
        'status_bayar',
        'foto_bukti',
        'tanggal_transaksi',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}