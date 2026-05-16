<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sapi extends Model
{
    use HasFactory;

    protected $fillable =[
        'kode_sapi',
        'jenis_sapi',
        'bobot',
        'harga_jual',
        'status',
        'foto_path'
    ];

    public function pesanan()
{
    return $this->hasOne(Pesanan::class); //RELASI Sapi PUNYA satu pesanan
}
}
