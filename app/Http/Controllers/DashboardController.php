<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalAnggota = User::where('role', 'anak_magang')->count();
        $proyekBerjalan = Project::where('status', 'berjalan')->count();
        $projectStagnant = Project::where('status', 'stagnant')->count();
        $projects = Project::with(['team', 'tasks'])->latest()->get();
        $teams = Team::all();

        return view('dashboard.admin', compact(
            'totalAnggota', 'proyekBerjalan', 'projectStagnant',
            'projects', 'teams'
        ));
    }

    public function magang()
    {
        $user = Auth::user();
        $projects = Project::with('tasks')->get();
        $tasks = Task::with('project')
            ->where('user_id', $user->id)
            ->orWhereNull('user_id')
            ->latest()
            ->get();

        $reminders = Project::whereDate('deadline', '<=', now()->addDay())
            ->where('status', '!=', 'selesai')
            ->get();

        return view('dashboard.siswa', compact('user', 'projects', 'tasks', 'reminders'));
    }
}
