<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin Utama
        User::create([
            'name' => 'Admin Pembimbing',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // Contoh Proyek & Tugas Harian Awal
        $project = Project::create([
            'nama_proyek' => 'Sistem Monitoring PKL & Magang',
            'deskripsi' => 'Aplikasi monitoring proyek harian berbasis Laravel & GitHub Webhook',
            'deadline' => now()->addDays(7),
            'progress' => 0,
            'status' => 'berjalan',
        ]);

        Task::create([
            'project_id' => $project->id,
            'user_id' => null, // Tampil untuk semua anak magang yang masuk
            'judul_tugas' => 'Membuat Halaman Login & Validasi Role',
            'kode_task' => '#TASK-01',
            'status' => 'pending',
        ]);

        Task::create([
            'project_id' => $project->id,
            'user_id' => null,
            'judul_tugas' => 'Integrasi Webhook GitHub & Progress Bar',
            'kode_task' => '#TASK-02',
            'status' => 'pending',
        ]);
    }
}
