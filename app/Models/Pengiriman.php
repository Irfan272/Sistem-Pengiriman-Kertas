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
        'user_1',
        'status_approval_1',
        'remaks_1',
        'user_2',
        'status_approval_2',
        'remaks_2',
        'status',
        'kerugian_terlambat',
        'kerugian_duplikasi',
        'total_kerugian',
        'status_pengiriman'

    ];

    public function supir(){
        return $this->belongsTo(Supir::class);
    }

    public function Pengecekan(){
        return $this->belongsTo(Pengecekan_Mobil::class);
    }
}
