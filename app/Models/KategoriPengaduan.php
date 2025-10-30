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

 public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'kategori_id', 'kategori_id');
    }
}


