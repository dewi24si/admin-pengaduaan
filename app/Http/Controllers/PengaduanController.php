<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use App\Models\Warga;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['kategori', 'warga'])->latest();

        // Search (no tiket / judul / nama warga)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nomor_tiket', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%")
                    ->orWhereHas('warga', function ($qw) use ($search) {
                        $qw->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $pengaduan = $query->paginate(10)->appends($request->query());

        // list kategori untuk dropdown filter
        $kategoriList = KategoriPengaduan::all();

        return view('pages.pengaduan.index', compact('pengaduan', 'kategoriList'));
    }

    public function create()
    {
        $kategori = KategoriPengaduan::all();
        $warga = Warga::all();
        return view('pages.pengaduan.create', compact('kategori', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_tiket' => 'required|unique:pengaduan,nomor_tiket',
            'warga_id' => 'required|exists:warga,warga_id',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_pengaduan,kategori_id',
            'deskripsi' => 'required|string',
            'status' => 'nullable|string|in:baru,proses,selesai',
            'lokasi_text' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
        ]);

        Pengaduan::create($request->all());
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $kategori = KategoriPengaduan::all();
        $warga = Warga::all();
        return view('pages.pengaduan.edit', compact('pengaduan', 'kategori', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'nomor_tiket' => 'required|unique:pengaduan,nomor_tiket,' . $pengaduan->pengaduan_id . ',pengaduan_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_pengaduan,kategori_id',
            'deskripsi' => 'required|string',
            'status' => 'nullable|string|in:baru,proses,selesai',
            'lokasi_text' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
        ]);

        $pengaduan->update($request->all());
        return redirect()->route('pengaduan.index')->with('success', 'Data pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pengaduan::findOrFail($id)->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Data pengaduan berhasil dihapus.');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['kategori', 'warga', 'tindakLanjut', 'penilaian'])->findOrFail($id);
        return view('pages.pengaduan.show', compact('pengaduan'));
    }
}
