<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'posisi',
        'alamat',
        'umur',
        'kontak'
    ];

     // Relasi dengan User 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
