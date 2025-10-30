<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengaduan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pengaduan';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'nama',
        'sla_hari',
        'prioritas',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id', 'kategori_id');
    }

    public function getPrioritasTextAttribute()
    {
        $prioritas = [
            'rendah' => 'Rendah',
            'sedang' => 'Sedang',
            'tinggi' => 'Tinggi'
        ];

        return $prioritas[$this->prioritas] ?? 'Tidak Diketahui';
    }
}