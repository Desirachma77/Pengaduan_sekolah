<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataSiswaController extends Controller
{
    /**
     * TAMPIL DATA SISWA (PAGINATION)
     */
    public function index()
    {
        $siswa = Siswa::orderBy('nama_lengkap', 'asc')
            ->paginate(5);

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * RESET SANDI SISWA (AJAX)
     */
    public function reset($id)
    {
        // 1. ambil data siswa
        $siswa = Siswa::findOrFail($id);

        // 2. ambil user dari relasi siswa
        $user = User::findOrFail($siswa->user_id);

        // 3. generate password baru (huruf besar, kecil, angka)
        $newPassword = $this->generatePassword(8);

        // 4. simpan password baru (hash)
        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        // 5. kirim response ke frontend
        return response()->json([
            'success'  => true,
            'password' => $newPassword,
        ]);
    }

    /**
     * LIVE SEARCH SISWA (AJAX)
     */
    public function search(Request $request)
    {
        $search = $request->search;

        $siswa = Siswa::where('nis', 'like', "%$search%")
            ->orWhere('nama_lengkap', 'like', "%$search%")
            ->orWhere('kelas', 'like', "%$search%")
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return response()->json($siswa);
    }

    /**
     * GENERATE PASSWORD AMAN
     */
    private function generatePassword($length = 8)
    {
        $upper  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lower  = 'abcdefghijklmnopqrstuvwxyz';
        $number = '0123456789';

        // pastikan ada 1 huruf besar, kecil, dan angka
        $password  = $upper[rand(0, strlen($upper) - 1)];
        $password .= $lower[rand(0, strlen($lower) - 1)];
        $password .= $number[rand(0, strlen($number) - 1)];

        $all = $upper . $lower . $number;

        for ($i = 3; $i < $length; $i++) {
            $password .= $all[rand(0, strlen($all) - 1)];
        }

        return str_shuffle($password);
    }
}
