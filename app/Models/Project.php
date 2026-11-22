<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'nama_proyek', 'deskripsi', 'team_id', 'github_repo',
        'deadline', 'progress', 'status', 'catatan_evaluasi'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Sesuai Flowchart: Hitung Ulang Persentase Progress Bar Project
    public function hitungUlangProgress()
    {
        $totalTasks = $this->tasks()->count();
        if ($totalTasks === 0) {
            $this->progress = 0;
        } else {
            $doneTasks = $this->tasks()->where('status', 'done')->count();
            $this->progress = round(($doneTasks / $totalTasks) * 100);
        }

        if ($this->progress == 100) {
            $this->status = 'selesai';
        }
        $this->save();
    }
}
