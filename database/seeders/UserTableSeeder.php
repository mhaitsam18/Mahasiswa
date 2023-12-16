<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
            'foto' => 'foto-profil/admin.png',
        ]);
        // User::create([
        //     'name' => 'Reza',
        //     'email' => 'reza@gmail.com',
        //     'password' => Hash::make('1234'),
        //     'role' => 'mahasiswa',
        //     'foto' => 'mahasiswa.png',
        // ]);
    }

    /**
     * Seed kabupaten based on provinsi.
     *
     * @param \App\Models\Provinsi $provinsi
     * @param array $kabupatenList
     */
}
