<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    use HasFactory;
    use \App\Traits\HasMediaUpload;

    protected $table = 'tindak_lanjut';
    protected $primaryKey = 'tindak_id';

    protected $fillable = [
        'pengaduan_id',
        'petugas',
        'aksi',
        'catatan',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'tindak_id')
            ->where('ref_table', 'tindak_lanjut')
            ->orderBy('sort_order', 'asc');
    }

    /**
     * Get first image (for thumbnail)
     */
    public function getFirstImageAttribute()
    {
        return Media::forTable('tindak_lanjut', $this->tindak_id)
            ->whereIn('mime_type', ['image/jpeg', 'image/png', 'image/gif'])
            ->first();
    }
}