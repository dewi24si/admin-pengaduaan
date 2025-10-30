<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with('kategori')->latest()->get();
        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        $kategori = KategoriPengaduan::all();
        return view('pengaduan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_tiket' => 'required|unique:pengaduan',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_pengaduan,id',
            'deskripsi' => 'required|string',
            'status' => 'nullable|string',
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
        return view('pengaduan.edit', compact('pengaduan', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'nomor_tiket' => 'required|unique:pengaduan,nomor_tiket,' . $pengaduan->pengaduan_id . ',pengaduan_id',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_pengaduan,id',
            'deskripsi' => 'required|string',
            'status' => 'nullable|string',
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
}
