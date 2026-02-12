<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Tampilkan data siswa
     */
    public function index()
    {
        $siswa = Siswa::orderBy('nama_lengkap', 'asc')->get();

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Reset sandi siswa oleh admin
     */
    public function resetSandi($id)
{
    $siswa = Siswa::findOrFail($id);

    // CEK apakah siswa punya user
    if (!$siswa->user) {
        return back()->with('error', 'User untuk siswa ini belum tersedia');
    }

    $siswa->user->update([
        'password' => Hash::make('123456'),
    ]);

    return back()->with('success', 'Password siswa berhasil direset ke 123456');
}
}