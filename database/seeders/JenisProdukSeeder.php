<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisProdukSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_produks')->insert([
            ['nama' => 'Makanan'],
            ['nama' => 'Minuman'],
            ['nama' => 'Elektronik'],
        ]);
    }
}
