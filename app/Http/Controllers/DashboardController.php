<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Warga;
use App\Models\KategoriPengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengaduan = Pengaduan::count();
        $totalWarga = Warga::count();
        $totalKategori = KategoriPengaduan::count();
        $pengaduanTerbaru = Pengaduan::with(['warga', 'kategori'])->latest()->take(5)->get();

        return view('pages.dashboard', compact(
            'totalPengaduan',
            'totalWarga',
            'totalKategori',
            'pengaduanTerbaru'
        ));
    }
}
