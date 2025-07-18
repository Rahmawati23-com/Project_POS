<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
    use HasFactory;

    protected $table = 'jenis_produks'; 

    protected $fillable = [
        'nama',
        'kategori_id'  
    ]; 

    public function produks()
    {
        return $this->hasMany(Produk::class, 'jenis_produk_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriTokoh::class, 'kategori_id');
    }
}