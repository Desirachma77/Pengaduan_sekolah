<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function admin()
    {
        $data = Aspirasi::with('siswa')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'judul' => 'Aspirasi Baru',
                    'pesan' => 'Aspirasi baru dari ' . $item->nama_siswa
                ];
            });

        return response()->json($data);
    }

    public function siswa()
    {
        $user = Auth::user();

        $data = Aspirasi::where('siswa_id', $user->id)
            ->whereIn('status', ['Diproses', 'Selesai'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'judul' => 'Update Aspirasi',
                    'pesan' => 'Aspirasi kamu ' . strtolower($item->status)
                ];
            });

        return response()->json($data);
    }
}