<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianLayanan extends Model
{
    use HasFactory;

    protected $table = 'penilaian_layanan';
    protected $primaryKey = 'penilaian_id';

    protected $fillable = [
        'pengaduan_id',
        'rating',
        'komentar'
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function getRatingBintangAttribute()
    {
        return str_repeat('⭐', $this->rating) . ' (' . $this->rating . '/5)';
    }

    public function getRatingTextAttribute()
    {
        $ratings = [
            1 => 'Sangat Tidak Puas',
            2 => 'Tidak Puas',
            3 => 'Cukup',
            4 => 'Puas',
            5 => 'Sangat Puas'
        ];

        return $ratings[$this->rating] ?? 'Tidak Diketahui';
    }
}