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
        'kategori_id',
        'jenis_id',
        'jenis_produk_id',
        'harga',
        'stok',
        'rating',
        'min_stok',
        'jenis_produk_id',
        'deskripsi',
        'foto'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'rating' => 'decimal:2',
        'stok' => 'integer',
        'min_stok' => 'integer',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriTokoh::class, 'kategori_id');
    }

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return null;
    }

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function scopeActive($query)
    {
        return $query->where('stok', '>', 0);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('kode', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
    }
}