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
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'ADMIN',
            'telepon' => '08921890312',
            'image' => 'storage/image/profile1.jpeg',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'wali',
            'email' => 'wali@example.com',
            'role' => 'WALI',
            'telepon' => '089789766754',
            'password' => Hash::make('sandi'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@example.com',
            'role' => 'ADMIN',
            'telepon' => '0923131290312',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'alegrich',
            'email' => 'alegrich@example.com',
            'role' => 'ADMIN',
            'telepon' => '087784644359',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Ahmad Subardjo',
            'email' => 'subarjo@example.com',
            'role' => 'WALI',
            'telepon' => '6282134698068',
            'alamat' => 'Jl.kaliurang, km.10, sleman,Yogyakarta',
            'password' => Hash::make('sandi'),
            'created_at' => now(),
        ]);
    }
}
