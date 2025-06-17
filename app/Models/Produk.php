<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; 

    protected $fillable = [
        'kode',
        'nama',
        'harga',
        'stok',
        'rating',
        'min_stok',
        'jenis_produk_id',
        'deskripsi',
    ];

    public function jenisProduk()
    {
        return $this->belongsTo(JenisProduk::class, 'jenis_produk_id');
    }

    public function testimonis()
    {
        return $this->hasMany(Testimoni::class, 'produk_id');
    }
}
