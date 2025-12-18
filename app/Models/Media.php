<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];

    /**
     * Scope untuk mendapatkan media berdasarkan tabel dan ID referensi
     */
    public function scopeForTable($query, $table, $id)
    {
        return $query->where('ref_table', $table)
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc');
    }

    /**
     * Get file URL
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/uploads/' . $this->file_name);
    }

    /**
     * Check if file is image
     */
    public function getIsImageAttribute()
    {
        $imageMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        return in_array($this->mime_type, $imageMimes);
    }

    /**
     * Check if file is PDF
     */
    public function getIsPdfAttribute()
    {
        return $this->mime_type == 'application/pdf';
    }

    /**
     * Check if file is document (word, excel, etc)
     */
    public function getIsDocumentAttribute()
    {
        $docMimes = [
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ];
        return in_array($this->mime_type, $docMimes);
    }

    /**
     * Get file icon based on mime type
     */
    public function getFileIconAttribute()
    {
        if ($this->is_image)
            return 'bi-image';
        if ($this->is_pdf)
            return 'bi-file-pdf';
        if ($this->is_document) {
            if (str_contains($this->mime_type, 'excel'))
                return 'bi-file-excel';
            if (str_contains($this->mime_type, 'word'))
                return 'bi-file-word';
            if (str_contains($this->mime_type, 'powerpoint'))
                return 'bi-file-ppt';
        }
        return 'bi-file-earmark';
    }
}