<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;
    protected $fillable =[
        'nik',
        'nama',
        'alamat',
        'department_id',
        'telepon',
        'sim'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    
    public function pengiriman_detail(){
        return $this->hasMany(Pengiriman_Detail::class);
    }
}
