<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['name' => 'Hành động'],
            ['name' => 'Võ thuật'],
            ['name' => 'Phim ăn thịt người'],
            ['name' => 'Chiến tranh']
        ]);
    }
}
