<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data untuk tabel alat
        DB::table('alat')->insert([
            ['id_status' => 1], // Assuming 1 is the id for 'offline' in status_alat
            ['id_status' => 2], // Assuming 2 is the id for 'online' in status_alat
            ['id_status' => 2], // Assuming 2 is the id for 'online' in status_alat
        ]);
    }
}
