<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Boneka'],
            ['nama' => 'Mobil Remote'],
            ['nama' => 'Action Figure'],
            ['nama' => 'Edukasi'],
            ['nama' => 'Puzzle'],
            ['nama' => 'Mainan Edukasi'],
        ];

        DB::table('jenis_produks')->insert($data);
    }
}
