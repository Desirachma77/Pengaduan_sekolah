<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'nis',
        'nama_lengkap',
        'kelas',
    ];

    // relasi ke user
    public function aspirasi()
{
    return $this->hasMany(Aspirasi::class, 'siswa_id');
}

}
