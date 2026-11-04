<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Pengguna LMS (1 Dosen & 1 Mahasiswa)
        // TODO 1 : Buat akun awal untuk Dosen.
        // Hint:
        // - Gunakan email sebagai identitas akun.
        // - Lengkapi nama, password yang di-hash, role Dosen,dan nomor induk.

        $dosen = User::updateOrCreate(
            ['email' => 'budi@telkomuniversity.ac.id'],
            [
                'name'     => 'Dr. Ir. Budi Santoso, M.T.',
                'password' => Hash::make('password'),
                'role'     => 'dosen',
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'vitroramadhantam@student.telkomuniversity.ac.id'
            ],
            [
                'name' => 'Vitro Ramadhanta Mawardi',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'mahasiswa',
            ]
        );

        $mk = MataKuliah::updateOrCreate(
            ['kode_mk' => 'CSG2A3'],
            [
                'nama_mk'   => 'Pengembangan Aplikasi Website',
                'sks'       => 3,
                'semester'  => 3,
                'deskripsi' => 'Mempelajari pengembangan aplikasi berbasis web menggunakan kerangka kerja Laravel dan AJAX.',
                'dosen_id'  => $dosen->id,
            ]
        );

        Material::updateOrCreate(
            [
                'course_id' => $mk->id,
                'judul'     => 'Modul 3 - Operasi CRUD dengan Laravel',
            ],
            [
                'konten' => 'Panduan praktikum operasi Create, Read, Update, dan Delete di Laravel.',
                'file_path' => 'materials/modul3.pdf',
                'minggu_ke' => 3,
                'urutan' => 1,
            ]
        );
    }
}
