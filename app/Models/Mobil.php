<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'plat_mobil',
        'merk',
        'tipe',
        'warna',
        'tahun',
        'status',
    ];

    public function pengecekans()
    {
        return $this->hasMany(Pengecekan_Mobil::class);
    }
}
