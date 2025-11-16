<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('kategori_pengaduan')->insert([
            [
                'nama' => 'Infrastruktur Jalan',
                'sla_hari' => 7,
                'prioritas' => 'tinggi',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama' => 'Pelayanan Publik',
                'sla_hari' => 3,
                'prioritas' => 'sedang',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama' => 'Kebersihan Lingkungan',
                'sla_hari' => 5,
                'prioritas' => 'sedang',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama' => 'Keamanan dan Ketertiban',
                'sla_hari' => 10,
                'prioritas' => 'tinggi',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama' => 'Administrasi Kependudukan',
                'sla_hari' => 4,
                'prioritas' => 'rendah',
                'created_at' => $now, 'updated_at' => $now
            ],
        ]);
    }
}