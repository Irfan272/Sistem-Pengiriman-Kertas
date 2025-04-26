<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $fillable = [
        'supir_id',
        'pengecekan_mobil_id',
        'shift',
        'total_tonase',
        'total_ritase',
        'tanggal_pengiriman',
        'jam_masuk',
        'jam_keluar',
        'status'
    ];

    public function supir(){
        return $this->belongsTo(Supir::class);
    }

    public function pengecekan(){
        return $this->belongsTo(Pengecekan_Mobil::class);
    }
}
