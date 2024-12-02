<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::all();

        for ($i = 0; $i < 50; $i++) {
            Movie::create([
                'title' => fake()->text(25),
                'poster' => fake()->imageUrl(200, 300, 'movies', true),
                'intro' => fake()->text(100),
                'release_date' => fake()->date(),
                'genre_id' => $genres->random()->id,
            ]);
        }
    }
}
