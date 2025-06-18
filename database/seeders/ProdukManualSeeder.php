<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukManualSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode' => 'BRG001',
                'nama' => 'Boneka 1',
                'kategori_id' => 1,
                'jenis_produk_id' => 8,
                'harga' => 25000,
                'stok' => 100,
                'foto' => 'boneka_1.jpg',
            ],
            [
                'kode' => 'BRG002',
                'nama' => 'Boneka 2',
                'kategori_id' => 1,
                'jenis_produk_id' => 8,
                'harga' => 30000,
                'stok' => 80,
                'foto' => 'boneka_2.jpg',
            ],
        ];

        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}
