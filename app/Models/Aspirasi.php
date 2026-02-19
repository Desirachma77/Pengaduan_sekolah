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

    public $incrementing = true;     // 🔥 WAJIB
    protected $keyType = 'int';      // 🔥 WAJIB

    protected $fillable = [
        'siswa_id',
        'nama_siswa', 
        'id_kategori',
        'id_admin',
        'lokasi',
        'ket_laporan',
        'foto_bukti',
        'status',
        'feedback',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
