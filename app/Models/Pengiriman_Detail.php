<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman_Detail extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_details';

    protected $fillable = [
        'pengiriman_id',
        'kertas_id',
        'tonase_kg',
        'ritase',
        'lokasi',
        'user_1',
        'approval_1',
        'remaks_1',
        'user_2',
        'approval_2',
        'remaks_2',
    ];

    // Relasi ke model Pengiriman
    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class);
    }

    // Relasi ke model Kertas
    public function kertas()
    {
        return $this->belongsTo(Kertas::class);
    }

    // Relasi ke model User untuk user_1
    public function user1()
    {
        return $this->belongsTo(User::class, 'user_1');
    }

    // Relasi ke model User untuk user_2
    public function user2()
    {
        return $this->belongsTo(User::class, 'user_2');
    }
}
