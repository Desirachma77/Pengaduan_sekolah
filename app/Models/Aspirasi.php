<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
        'siswa_id',
        'id_kategori',
        'id_admin',
        'lokasi',
        'ket_laporan',
        'foto_bukti',
        'status',
        'feedback',
    ];

    // ================= RELATION =================

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
