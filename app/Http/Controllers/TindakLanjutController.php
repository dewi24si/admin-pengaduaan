<?php

namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TindakLanjutController extends Controller
{
    public function index()
    {
        $tindakLanjut = TindakLanjut::with('pengaduan')->latest()->paginate(10);
        return view('tindak-lanjut.index', compact('tindakLanjut'));
    }

    public function create()
    {
        $pengaduan = Pengaduan::whereDoesntHave('tindakLanjut')->get();
        return view('tindak-lanjut.create', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id|unique:tindak_lanjut,pengaduan_id',
            'petugas' => 'required|string|max:255',
            'aksi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['pengaduan_id', 'petugas', 'aksi', 'catatan']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('tindak', 'public');
        }

        TindakLanjut::create($data);

        return redirect()->route('tindak.index')->with('success', 'Tindak lanjut berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tindak = TindakLanjut::findOrFail($id);
        $pengaduan = Pengaduan::all();
        return view('tindak-lanjut.edit', compact('tindak', 'pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $tindak = TindakLanjut::findOrFail($id);

        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id|unique:tindak_lanjut,pengaduan_id,' . $tindak->tindak_id . ',tindak_id',
            'petugas' => 'required|string|max:255',
            'aksi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['pengaduan_id', 'petugas', 'aksi', 'catatan']);

        if ($request->hasFile('foto')) {
            if ($tindak->foto) {
                Storage::disk('public')->delete($tindak->foto);
            }
            $data['foto'] = $request->file('foto')->store('tindak', 'public');
        }

        $tindak->update($data);

        return redirect()->route('tindak.index')->with('success', 'Tindak lanjut berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tindak = TindakLanjut::findOrFail($id);

        if ($tindak->foto) {
            Storage::disk('public')->delete($tindak->foto);
        }

        $tindak->delete();

        return redirect()->route('tindak.index')->with('success', 'Tindak lanjut berhasil dihapus.');
    }
}