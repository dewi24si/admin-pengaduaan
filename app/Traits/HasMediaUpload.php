<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HasMediaUpload
{
    /**
     * Upload multiple files and save to media table
     */
    public function uploadMedia(Request $request, $refTable, $refId, $fieldName = 'files')
    {
        if (!$request->hasFile($fieldName)) {
            return collect();
        }

        $uploadedFiles = collect();

        $files = $request->file($fieldName);

        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                // Generate unique filename
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . uniqid() . '.' . $extension;

                // Store file
                $file->storeAs('uploads', $fileName, 'public');

                // Create media record
                $media = Media::create([
                    'ref_table' => $refTable,
                    'ref_id' => $refId,
                    'file_name' => $fileName,
                    'caption' => $request->input('caption') ?? pathinfo($originalName, PATHINFO_FILENAME),
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => Media::where('ref_table', $refTable)
                        ->where('ref_id', $refId)
                        ->max('sort_order') + 1
                ]);

                $uploadedFiles->push($media);
            }
        }

        return $uploadedFiles;
    }

    /**
     * Delete media files
     */
    public function deleteMedia($refTable, $refId, $mediaIds = null)
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

        return true;
    }

    /**
     * Get media for specific reference
     */
    public function getMedia($refTable, $refId)
    {
        return Media::forTable($refTable, $refId)->get();
    }

    /**
     * Reorder media
     */
    public function reorderMedia(Request $request, $refTable, $refId)
    {
        $order = $request->input('order', []);

        foreach ($order as $position => $mediaId) {
            Media::where('media_id', $mediaId)
                ->where('ref_table', $refTable)
                ->where('ref_id', $refId)
                ->update(['sort_order' => $position + 1]);
        }

        return true;
    }
}