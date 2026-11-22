<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckProjectDaily extends Command
{
    // Nama perintah yang akan dijalankan oleh Cron Job / Scheduler
    protected $signature = 'promanage:check-daily';
    protected $description = 'Pengecekan harian deadline proyek H-1/H dan deteksi project stagnant';

    public function handle()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        // 1. CEK DEADLINE MENDEKATI H-1 / H
        $deadlineProjects = Project::where('status', '!=', 'selesai')
            ->whereDate('deadline', '<=', $tomorrow)
            ->get();

        foreach ($deadlineProjects as $project) {
            $pesan = "⚠️ *REMINDER DEADLINE PROMANAGE*\n"
                   . "Proyek: *{$project->nama_proyek}*\n"
                   . "Deadline: *{$project->deadline}*\n"
                   . "Progress saat ini: *{$project->progress}%*\n"
                   . "Segera selesaikan task harian Anda!";

            $this->kirimWhatsApp($pesan);
            Log::info("Reminder Deadline dikirim untuk proyek: {$project->nama_proyek}");
        }

        // 2. CEK PROJECT STAGNANT (Tidak ada update task/GitHub lebih dari 3 hari)
        $batasStagnant = Carbon::now()->subDays(3);
        $stagnantProjects = Project::where('status', 'berjalan')
            ->where('updated_at', '<', $batasStagnant)
            ->get();

        foreach ($stagnantProjects as $project) {
            // Ubah status proyek menjadi stagnant agar muncul di Dashboard Admin
            $project->update(['status' => 'stagnant']);

            $pesan = "🚨 *PERINGATAN PROJECT STAGNANT*\n"
                   . "Proyek: *{$project->nama_proyek}*\n"
                   . "Status: Tidak ada aktivitas update task maupun commit GitHub selama lebih dari 3 hari.\n"
                   . "Mohon perhatian Pembimbing & Siswa PKL.";

            $this->kirimWhatsApp($pesan);
            Log::warning("Peringatan Stagnant dikirim untuk proyek: {$project->nama_proyek}");
        }

        $this->info('Pengecekan harian ProManage selesai dijalankan.');
    }

    // Helper pengiriman pesan ke WhatsApp Gateway (Contoh: Fonnte / Wablas)
    private function kirimWhatsApp(string $pesan)
    {
        $token = env('FONNTE_TOKEN'); // Isi di file .env jika sudah punya token WA Gateway
        $target = env('WA_TARGET_GROUP_OR_ADMIN'); // Nomor WA Pembimbing/Grup

        if (!$token || !$target) {
            // Jika token WA belum diisi, catat ke storage/logs/laravel.log agar tetap bisa diuji
            Log::info("[SIMULASI WHATSAPP]\n" . $pesan);
            return;
        }

        Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $pesan,
        ]);
    }
}
