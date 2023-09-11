<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NotifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifies')->insert([
            'notif' => 'Assalamualaikum ini 1',
        ]);
        DB::table('notifies')->insert([
            'notif' => 'Assalamualaikum ini 2',
        ]);
        DB::table('notifies')->insert([
            'notif' => 'Assalamualaikum ini 3',
        ]);
        DB::table('notifies')->insert([
            'notif' => 'Assalamualaikum ini 4',
        ]);
        DB::table('notifies')->insert([
            'notif' => 'Assalamualaikum ini 5',
        ]);
    }
}
