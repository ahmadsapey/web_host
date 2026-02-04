<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HomeContent::create([
            'title' => 'Solusi Gas Industri Terpercaya',
            'subtitle' => 'Full Tank, Full Volume!',
            'content' => 'Penyedia gas industri berkualitas tinggi dengan jaringan distribusi terluas dan layanan pelanggan terbaik.',
            'poster_image' => null,
        ]);
    }
}
