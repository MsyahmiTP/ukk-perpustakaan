<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'petugas',
            'email' => 'petugas@gmail.com',
            'nama_lengkap' => 'Christiano Ronaldo',
            'alamat' => 'Jln Baduy',
            'password' => bcrypt('petugas123'), // Change 'password' to your desired password
            'role' => 'petugas',
            // other fields if necessary
        ]);
    }
}
