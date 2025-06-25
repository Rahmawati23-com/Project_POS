<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'nama_pembeli', 
        'email',
        'telepon',
        'alamat',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'status'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}