<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukManualSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['nama' => 'Action Figure Anime Girl', 'foto' => 'action3.jpg', 'jenis' => 2, 'harga' => 89000],
            ['nama' => 'Action Figure Adventure', 'foto' => 'action4.jpg', 'jenis' => 2, 'harga' => 92000],
            ['nama' => 'Action Figure Classic', 'foto' => 'action5.jpg', 'jenis' => 2, 'harga' => 78000],
            ['nama' => 'Boneka Karakter Lucu', 'foto' => 'boneka.jpg', 'jenis' => 1, 'harga' => 67809],
            ['nama' => 'Boneka Teddy Bear Premium', 'foto' => 'boneka_1.jpg', 'jenis' => 1, 'harga' => 125000],
            ['nama' => 'Boneka Kucing Menggemaskan', 'foto' => 'boneka_2.jpg', 'jenis' => 1, 'harga' => 89000],
            ['nama' => 'Mainan Edukasi Angka', 'foto' => 'edukasi_4.jpg', 'jenis' => 3, 'harga' => 65000],
            ['nama' => 'Rubik Cube 3x3 Original', 'foto' => 'edukasi_5.jpg', 'jenis' => 3, 'harga' => 45000],
            ['nama' => 'Set Mainan Edukasi Lengkap', 'foto' => 'mainan_edukasi.jpg', 'jenis' => 3, 'harga' => 150000],
            ['nama' => 'Mobil Remote Control Sport Car', 'foto' => 'mobil_remote.jpg', 'jenis' => 4, 'harga' => 285000],
            ['nama' => 'RC Car Racing Professional', 'foto' => 'mobil1.jpg', 'jenis' => 4, 'harga' => 320000],
            ['nama' => 'RC Car Off Road Monster', 'foto' => 'mobil2.jpg', 'jenis' => 4, 'harga' => 295000],
            ['nama' => 'Puzzle Warna-Warni 100 Pieces', 'foto' => 'puzzle5.jpg', 'jenis' => 5, 'harga' => 35000],
            ['nama' => 'Puzzle Edukatif Anak', 'foto' => 'puzzle6.jpg', 'jenis' => 5, 'harga' => 42000],
            ['nama' => 'Puzzle Adventure 200 Pieces', 'foto' => 'puzzle7.jpg', 'jenis' => 5, 'harga' => 38000],
        ];

        foreach ($products as $product) {
            DB::table('produks')->insert([
                'kode' => strtoupper(Str::random(6)),
                'nama' => $product['nama'],
                'harga' => $product['harga'],
                'stok' => rand(5, 20),
                'rating' => rand(40, 50) / 10,
                'min_stok' => rand(2, 5),
                'jenis_produk_id' => $product['jenis'],
                'deskripsi' => 'Produk berkualitas tinggi dengan harga terjangkau',
                'foto' => $product['foto'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        echo "Berhasil menambahkan " . count($products) . " produk!\n";
    }
}