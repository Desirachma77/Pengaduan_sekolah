<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

class AspirasiSiswaController extends Controller
{
    public function index()
    {
        return view('siswa.aspirasi');
    }
}
