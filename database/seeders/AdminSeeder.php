<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cegah double admin kalau seeder dijalankan ulang
        if (User::where('nis', 'ADMIN01')->exists()) {
            return;
        }

        User::create([
            'nis'      => 'ADMIN01',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);
    }
}
