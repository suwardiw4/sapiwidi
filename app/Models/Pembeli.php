<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
    ];

    public function pesanan()
    {
        return $this->hasOne(Pesanan::class); //ini relasi, PEMBELI punya SATu Pesanan
    }
}