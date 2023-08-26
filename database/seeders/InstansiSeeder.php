<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instansis')->insert([
            'logo' => 'storage/image/tutwuri1.png',
            'name' => 'Tadika',
            'telepon' => '087784644359',
            'email' => 'john@example.com',
            'alamat' => 'l Mangga Besar 38 AI, DKI Jakarta',
            'tanda_tangan' => 'storage/image/Tanda_tangan_bapak.png',
        ]);
    }
}
