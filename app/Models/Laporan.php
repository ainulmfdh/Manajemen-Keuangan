<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'bulan',
        'jumlah_transaksi',
        'total_uang'
    ];

    // Relasi User
    public function user() {
        return $this->belongsTo(User::class);
    }
}
