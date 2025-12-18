<?php

namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use App\Models\Pengaduan;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TindakLanjutController extends Controller
{
    public function index(Request $request)
    {
        $query = TindakLanjut::with('pengaduan')->latest();

        // Search: tiket / judul / petugas / aksi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('petugas', 'like', "%{$search}%")
                    ->orWhere('aksi', 'like', "%{$search}%")
                    ->orWhereHas('pengaduan', function ($qp) use ($search) {
                        $qp->where('nomor_tiket', 'like', "%{$search}%")
                            ->orWhere('judul', 'like', "%{$search}%");
                    });
            });
        }

        // Filter: ada foto / tidak
        if ($request->filled('has_foto')) {
            if ($request->has_foto == '1') {
                $query->whereHas('media');
            } elseif ($request->has_foto == '0') {
                $query->whereDoesntHave('media');
            }
        }

        $tindakLanjut = $query->paginate(10)->appends($request->query());

        return view('pages.tindak-lanjut.index', compact('tindakLanjut'));
    }

    public function create()
    {
        $pengaduan = Pengaduan::whereDoesntHave('tindakLanjut')->get();
        return view('pages.tindak-lanjut.create', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id|unique:tindak_lanjut,pengaduan_id',
            'petugas' => 'required|string|max:255',
            'aksi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        $data = $request->only(['pengaduan_id', 'petugas', 'aksi', 'catatan']);

        // Create tindak lanjut
        $tindak = TindakLanjut::create($data);

        // Upload files jika ada
        if ($request->hasFile('files')) {
            $this->uploadMediaFiles($request, $tindak->tindak_id, 'tindak_lanjut');
        }

        return redirect()->route('tindak.index')->with('success', 'Tindak lanjut berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tindak = TindakLanjut::findOrFail($id);
        $pengaduan = Pengaduan::all();
        $mediaFiles = Media::where('ref_table', 'tindak_lanjut')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.tindak-lanjut.edit', compact('tindak', 'pengaduan', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $tindak = TindakLanjut::findOrFail($id);

        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id|unique:tindak_lanjut,pengaduan_id,' . $tindak->tindak_id . ',tindak_id',
            'petugas' => 'required|string|max:255',
            'aksi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
            'delete_media' => 'nullable|string', 
        ]);

        $data = $request->only(['pengaduan_id', 'petugas', 'aksi', 'catatan']);
        $tindak->update($data);

        // Upload new files
        if ($request->hasFile('files')) {
            $this->uploadMediaFiles($request, $tindak->tindak_id, 'tindak_lanjut');
        }

        // Delete selected media files (convert string to array)
        if ($request->filled('delete_media')) {
            $mediaIds = explode(',', $request->delete_media);
            $mediaIds = array_filter($mediaIds); 
            if (!empty($mediaIds)) {
                $this->deleteMediaFiles($mediaIds, $tindak->tindak_id, 'tindak_lanjut');
            }
        }

        return redirect()->route('tindak.index')->with('success', 'Tindak lanjut berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tindak = TindakLanjut::findOrFail($id);

        // Delete all media files
        $this->deleteMediaFiles(null, $tindak->tindak_id, 'tindak_lanjut');

        // Delete tindak lanjut
        $tindak->delete();

        return redirect()->route('tindak.index')->with('success', 'Tindak lanjut berhasil dihapus.');
    }

    public function show($id)
    {
        $tindak = TindakLanjut::with('pengaduan')->findOrFail($id);
        $mediaFiles = Media::where('ref_table', 'tindak_lanjut')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.tindak-lanjut.show', compact('tindak', 'mediaFiles'));
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
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
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
            ->where('ref_table', 'tindak_lanjut')
            ->where('ref_id', $id)
            ->firstOrFail();

        // Delete file from storage
        $filePath = 'uploads/' . $media->file_name;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Delete record
        $media->delete();

        return response()->json(['success' => true]);
    }
}