<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Aspirasi;

class DashboardController extends Controller
{
    public function index()
    {
        // hitung data
        $jumlahSiswa = Siswa::count();

        $aspirasiDiproses = Aspirasi::where('status', 'diproses')->count();
        $aspirasiSelesai  = Aspirasi::where('status', 'selesai')->count();

        // 🔥 ambil 3 aspirasi terbaru dengan status MENUNGGU
        $aspirasiTerbaru = Aspirasi::with(['siswa', 'kategori'])
            ->where('status', 'menunggu')
            ->latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'aspirasiDiproses',
            'aspirasiSelesai',
            'aspirasiTerbaru'
        ));
    }

    public function detail($id)
    {
        $aspirasi = Aspirasi::with(['siswa', 'kategori'])->findOrFail($id);

        return view('admin.aspirasi-detail', compact('aspirasi'));
    }
}
