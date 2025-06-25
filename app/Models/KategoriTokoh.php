<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTokoh extends Model
{
    use HasFactory;

    protected $table = 'kategori_tokohs';

    protected $fillable = [
        'nama'
    ];

    // Relationship dengan products
    public function products()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }

    // Alias untuk backward compatibility jika ada yang pakai 'produks'
    public function produks()
    {
        return $this->products();
    }
}