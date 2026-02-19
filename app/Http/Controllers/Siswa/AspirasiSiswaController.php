<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;

class AspirasiSiswaController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all(); 

        return view('siswa.aspirasi', compact('kategori'));
    }

    public function store(Request $request)
    {
        try {

            // ✅ VALIDASI
            $request->validate([
                'kategori_id' => 'required',
                'lokasi'      => 'required',
                'keterangan'  => 'required',
                'bukti'       => 'required|image',
            ]);

            // ✅ UPLOAD FOTO
            $path = $request->file('bukti')->store('aspirasi', 'public');

            // ✅ INSERT DATABASE
            Aspirasi::create([
                'siswa_id'    => $request->user()->siswa->id,
                'nama_siswa'  => $request->user()->siswa->nama_lengkap,
                'id_kategori' => $request->kategori_id,
                'lokasi'      => $request->lokasi,
                'ket_laporan' => $request->keterangan,
                'foto_bukti'  => $path,
                'status'      => 'Menunggu',
            ]);

            // ✅ REDIRECT + FLASH MESSAGE
            return redirect()
                ->route('siswa.aspirasi')
                ->with('success', 'Aspirasi berhasil disimpan');

        } catch (\Exception $e) {

            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
}
