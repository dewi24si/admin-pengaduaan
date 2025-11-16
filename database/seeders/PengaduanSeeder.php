<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inisialisasi Faker dengan locale Indonesia
        $faker = Faker::create('id_ID');
        $pengaduan_data = [];

        // Asumsi: Kita sudah punya 50 Warga (ID 1-50) dan 5 Kategori (ID 1-5)
        $warga_ids = range(1, 50);
        $kategori_ids = range(1, 5);

        // Buat 50 data pengaduan
        for ($i = 1; $i <= 50; $i++) {
            $createdAt = Carbon::now()->subDays(rand(1, 60));

            // Menggunakan nilai status sesuai validasi Controller: 'baru', 'proses', 'selesai'
            $status = $faker->randomElement(['baru', 'proses', 'selesai']);

            $pengaduan_data[] = [
                // Menggunakan logic seperti nomor tiket
                'nomor_tiket' => 'T-' . $createdAt->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),

                // --- KUNCI RELASI ---
                'warga_id' => $faker->randomElement($warga_ids),
                'kategori_id' => $faker->randomElement($kategori_ids),
                // ---------------------

                'judul' => $faker->sentence(5),
                'deskripsi' => $faker->paragraph(3),
                'status' => $status,
                'lokasi_text' => $faker->address(),
                'rt' => $faker->numerify('0##'),
                'rw' => $faker->numerify('0##'),
                'created_at' => $createdAt,

                // Jika status 'selesai', tanggal update harus setelah tanggal dibuat
                'updated_at' => ($status === 'selesai') ? $faker->dateTimeBetween($createdAt, 'now') : $createdAt,
            ];
        }

        // Masukkan data ke tabel pengaduan
        DB::table('pengaduan')->insert($pengaduan_data);
    }
}