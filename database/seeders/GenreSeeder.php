<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = collect([
            'Speed Metal',
            'Heavy Metal',
            'Thrash Metal',
            'Power Metal',
            'Death Metal',
            'Black Metal',
            'Pagan Metal',
            'Viking Metal',
            'Folk Metal',
            'Symphonic Metal',
            'Gothic Metal',
            'Glam Metal',
            'Hair Metal',
            'Doom Metal',
            'Groove Metal',
            'Industrial Metal',
            'Modern Metal',
            'Neoclassical Metal',
            'New Wave Of British Heavy Metal',
            'Post Metal',
            'Progressive Metal',
            'Indie'
        ]);

        $genres->each( function ($genre) {
            Genre::create([
                'name' => $genre,
                'slug' => Str::slug($genre)
            ]);
        });
    }
}
