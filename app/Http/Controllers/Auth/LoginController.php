<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    // TAMPILKAN HALAMAN LOGIN
    public function index()
    {
        return view('auth.login');
    }

    // PROSES LOGIN
    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'login'    => 'required',
            'password' => 'required',
        ], [
            'login.required'    => 'NIS wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // CARI USER BERDASARKAN NIS
        $user = User::where('nis', $request->login)->first();

        if (!$user) {
            return back()->withErrors([
                'login' => 'NIS tidak ditemukan.',
            ])->withInput();
        }

        // CEK PASSWORD
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ])->withInput();
        }

        // LOGIN MANUAL
        Auth::login($user);
        $request->session()->regenerate();

        // REDIRECT SESUAI ROLE
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/siswa/dashboard');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
