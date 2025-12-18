<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use App\Models\Warga;
use App\Models\Media;
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
            'files.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Create pengaduan
        $pengaduan = Pengaduan::create($request->all());

        // Upload files jika ada
        if ($request->hasFile('files')) {
            $this->uploadMediaFiles($request, $pengaduan->pengaduan_id, 'pengaduan');
        }

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $kategori = KategoriPengaduan::all();
        $warga = Warga::all();
        $mediaFiles = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.pengaduan.edit', compact('pengaduan', 'kategori', 'warga', 'mediaFiles'));
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
            'files.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'delete_media' => 'nullable|string', 
        ]);

        $pengaduan->update($request->all());

        // Upload new files
        if ($request->hasFile('files')) {
            $this->uploadMediaFiles($request, $pengaduan->pengaduan_id, 'pengaduan');
        }

        // Delete selected media files (convert string to array)
        if ($request->filled('delete_media')) {
            $mediaIds = explode(',', $request->delete_media);
            $mediaIds = array_filter($mediaIds); 
            if (!empty($mediaIds)) {
                $this->deleteMediaFiles($mediaIds, $pengaduan->pengaduan_id, 'pengaduan');
            }
        }

        return redirect()->route('pengaduan.index')->with('success', 'Data pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // Delete media files
        $this->deleteMediaFiles(null, $pengaduan->pengaduan_id, 'pengaduan');

        // Delete pengaduan
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Data pengaduan berhasil dihapus.');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['kategori', 'warga', 'tindakLanjut', 'penilaian'])->findOrFail($id);
        $mediaFiles = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.pengaduan.show', compact('pengaduan', 'mediaFiles'));
    }

    /**
     * Helper method untuk upload media files
     */
    private function uploadMediaFiles(Request $request, $refId, $refTable)
    {
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {
                if ($file->isValid()) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . uniqid() . '.' . $extension;

                    // Store file
                    $file->storeAs('uploads', $fileName, 'public');

                    // Create media record
                    Media::create([
                        'ref_table' => $refTable,
                        'ref_id' => $refId,
                        'file_name' => $fileName,
                        'caption' => pathinfo($originalName, PATHINFO_FILENAME),
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => Media::where('ref_table', $refTable)
                            ->where('ref_id', $refId)
                            ->max('sort_order') + 1
                    ]);
                }
            }
        }
    }

    /**
     * Helper method untuk delete media files
     */
    private function deleteMediaFiles($mediaIds, $refId, $refTable)
    {
        $query = Media::where('ref_table', $refTable)
            ->where('ref_id', $refId);

        if ($mediaIds) {
            $query->whereIn('media_id', (array) $mediaIds);
        }

        $mediaFiles = $query->get();

        foreach ($mediaFiles as $media) {
            // Delete file from storage
            $filePath = 'uploads/' . $media->file_name;
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($filePath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($filePath);
            }

            // Delete record
            $media->delete();
        }
    }

    /**
     * Delete single media file
     */
    public function deleteMediaFile($id, $mediaId)
    {
        $media = Media::where('media_id', $mediaId)
            ->where('ref_table', 'pengaduan')
            ->where('ref_id', $id)
            ->firstOrFail();

        // Delete file from storage
        $filePath = 'uploads/' . $media->file_name;
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($filePath)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($filePath);
        }

        // Delete record
        $media->delete();

        return response()->json(['success' => true]);
    }
}