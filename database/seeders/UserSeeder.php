<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'ADMIN',
            'telepon' => '08921890312',
            'image' => 'storage/image/profile1.jpeg',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Alegrich',
            'email' => 'alegrich@example.com',
            'role' => 'ADMIN',
            'telepon' => '087784644359',
            'image' => '/storage/image/1692242791.jpg',
            'password' => Hash::make('alegrichrey12123'),
        ]);
    }
}
