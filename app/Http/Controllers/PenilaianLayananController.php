<?php

namespace App\Http\Controllers;

use App\Models\PenilaianLayanan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PenilaianLayananController extends Controller
{
    public function index()
    {
        $penilaian = PenilaianLayanan::with('pengaduan')->latest()->paginate(10);
        return view('pages.penilaian.index', compact('penilaian'));
    }

    public function create()
    {
        $pengaduan = Pengaduan::whereDoesntHave('penilaian')->get();
        return view('pages.penilaian.create', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id|unique:penilaian_layanan,pengaduan_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        PenilaianLayanan::create($request->all());
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penilaian = PenilaianLayanan::findOrFail($id);
        $pengaduan = Pengaduan::all();
        return view('pages.penilaian.edit', compact('penilaian', 'pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $penilaian = PenilaianLayanan::findOrFail($id);

        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id|unique:penilaian_layanan,pengaduan_id,' . $penilaian->penilaian_id . ',penilaian_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        $penilaian->update($request->all());
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PenilaianLayanan::findOrFail($id)->delete();
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }
    public function show($id)
    {
        $penilaian = PenilaianLayanan::with('pengaduan')->findOrFail($id);
        return view('pages.penilaian.show', compact('penilaian'));
    }
}
