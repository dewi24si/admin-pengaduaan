<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriPengaduanController extends Controller
{
    public function index()
    {
        $kategori = KategoriPengaduan::latest()->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'sla_hari' => 'required|integer|min:1',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
        ]);

        KategoriPengaduan::create($request->only('nama', 'sla_hari', 'prioritas'));

        return redirect()->route('kategori.index')->with('success', 'Kategori pengaduan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'sla_hari' => 'required|integer|min:1',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
        ]);

        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->update($request->only('nama', 'sla_hari', 'prioritas'));

        return redirect()->route('kategori.index')->with('success', 'Kategori pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori pengaduan berhasil dihapus.');
    }
}