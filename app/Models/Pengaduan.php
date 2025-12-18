<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    use \App\Traits\HasMediaUpload; 

    protected $table = 'pengaduan';
    protected $primaryKey = 'pengaduan_id';

    protected $fillable = [
        'nomor_tiket',
        'warga_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'status',
        'lokasi_text',
        'rt',
        'rw'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPengaduan::class, 'kategori_id', 'kategori_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function penilaian()
    {
        return $this->hasOne(PenilaianLayanan::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function tindakLanjut()
    {
        return $this->hasOne(TindakLanjut::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'pengaduan_id')
            ->where('ref_table', 'pengaduan')
            ->orderBy('sort_order', 'asc');
    }

    public function getStatusTextAttribute()
    {
        $status = [
            'baru' => 'Baru',
            'proses' => 'Proses',
            'selesai' => 'Selesai'
        ];

        return $status[$this->status] ?? 'Tidak Diketahui';
    }
}