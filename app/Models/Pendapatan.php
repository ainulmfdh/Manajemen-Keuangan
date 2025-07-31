<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'jumlah',
        'kategori',
        'deskripsi',
    ];

    // Relasi dengan User 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
