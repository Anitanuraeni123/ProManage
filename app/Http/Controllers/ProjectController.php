<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Admin: Buat Proyek Baru & Assign Tim
    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'team_id' => 'nullable|exists:teams,id',
            'deadline' => 'required|date',
        ]);

        Project::create($request->all());
        return back()->with('success', 'Proyek baru berhasil dibuat!');
    }

    // Admin: Assign Tim ke Proyek
    public function assignTeam(Request $request, Project $project)
    {
        $request->validate(['team_id' => 'required|exists:teams,id']);
        $project->update(['team_id' => $request->team_id]);
        return back()->with('success', 'Tim berhasil di-assign ke proyek.');
    }

    // Admin: Evaluasi Proyek
    public function evaluasi(Request $request, Project $project)
    {
        $request->validate([
            'catatan_evaluasi' => 'required|string',
            'status' => 'required|in:berjalan,selesai,stagnant',
        ]);

        $project->update($request->only('catatan_evaluasi', 'status'));
        return back()->with('success', 'Evaluasi proyek berhasil disimpan.');
    }

    // Siswa: Hubungkan Repo GitHub
    public function connectGithub(Request $request, Project $project)
    {
        $request->validate(['github_repo' => 'required|string']);
        $project->update(['github_repo' => $request->github_repo]);
        return back()->with('success', 'Repository GitHub berhasil dihubungkan!');
    }
}
