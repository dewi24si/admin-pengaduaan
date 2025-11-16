<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menginisialisasi Faker dengan lokal Indonesia (id_ID)
        $faker = Faker::create('id_ID');
        $warga_data = [];

        for ($i = 0; $i < 50; $i++) {
            $gender = $faker->randomElement(['L', 'P']);
            $warga_data[] = [
                // 16 digit angka unik untuk KTP
                'no_ktp' => $faker->unique()->numerify('################'),
                'nama' => $faker->name($gender == 'L' ? 'male' : 'female'),
                'jenis_kelamin' => $gender,
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan' => $faker->jobTitle(),

                // PENTING: Perbaikan untuk kolom 'telp'
                // Menghasilkan 12 digit angka murni (max 15 karakter)
                'telp' => $faker->numerify('08##########'),

                // Kolom email (nullable: YES)
                'email' => $faker->unique()->safeEmail(),

                // Kolom timestamp (nullable: YES)
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(1, 10)),
            ];
        }

        // Memasukkan 50 data ke tabel 'warga'
        DB::table('warga')->insert($warga_data);
    }
}