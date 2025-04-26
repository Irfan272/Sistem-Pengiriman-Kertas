<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kertas extends Model
{
    use HasFactory;

    
    protected $fillable =[
        'jenis_kertas',
        'lokasi'
    ];

    public function pengiriman_detail(){
        return $this->hasMany(Pengiriman_Detail::class);
    }
}
