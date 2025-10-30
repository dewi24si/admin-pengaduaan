<?php

namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TindakLanjutController extends Controller
{
    public function index()
    {
        $tindakLanjut = TindakLanjut::latest()->get();
        return view('tindak-lanjut.index', compact('tindakLanjut'));
    }

    public function create()
    {
        return view('tindak-lanjut.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_pengaduan' => 'required|string|max:255',
            'petugas' => 'required|string|max:255',
            'aksi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['kategori_pengaduan', 'petugas', 'aksi', 'catatan']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('tindak', 'public');
        }

        TindakLanjut::create($data);

        return redirect()->route('tindak.index')->with('success', 'Data berhasil disimpan.');
    }

    public function destroy($id)
    {
        $tindak = TindakLanjut::findOrFail($id);

        if ($tindak->foto) {
            Storage::disk('public')->delete($tindak->foto);
        }

        $tindak->delete();

        return redirect()->route('tindak.index')->with('success', 'Data berhasil dihapus.');
    }
}
