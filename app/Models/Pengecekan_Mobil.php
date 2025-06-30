<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengecekan_Mobil extends Model
{
    use HasFactory;
    protected $table = 'pengecekan_mobils';

    protected $fillable = [
        'supir_id',
        'mobil_id',
        'tanggal_pengecekan',
        'shift_pengecekan',
        'alarm',
        'lampu_penerangan',
        'lampu_rem',
        'rem',
        'sen_kanan',
        'sen_kiri',
        'klakson',
        'safety_belt',
        'bukti_video',
        'status'
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function mobilPlat()
{
    // relasi hanya jika ingin pakai plat_mobil sebagai key
    return $this->belongsTo(Mobil::class, 'plat_mobil', 'plat_mobil');
}

    public function supir()
    {
        return $this->belongsTo(Supir::class);
    }


    public function pengiriman_detail()
    {
        return $this->hasMany(Pengiriman_Detail::class);
    }


    public function Pengiriman()
    {
        return $this->hasMany(Pengiriman::class);
    }
}

