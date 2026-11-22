<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'nullable|exists:users,id',
            'judul_tugas' => 'required|string|max:255',
            'kode_task' => 'nullable|string|max:50',
        ]);

        $task = Task::create($request->all());
        $task->project->hitungUlangProgress();

        return back()->with('success', 'Tugas baru ditambahkan!');
    }

    // Flowchart: Manual Update Status -> Hitung Ulang Persentase Progress Bar Project
    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,done',
        ]);

        $task->update(['status' => $request->status]);
        $task->project->hitungUlangProgress();

        return back()->with('success', 'Status tugas diperbarui & progress bar dihitung ulang!');
    }
}
