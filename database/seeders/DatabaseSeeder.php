<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
{
    $this->call([
        KategoriPengaduanSeeder::class, // Parent table 1
        WargaSeeder::class,             // Parent table 2
        PengaduanSeeder::class,         // Child table (relies on others)
    ]);
}
}
