<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::patch('/projects/{project}/assign', [ProjectController::class, 'assignTeam'])->name('projects.assign');
    Route::patch('/projects/{project}/evaluasi', [ProjectController::class, 'evaluasi'])->name('projects.evaluasi');
    Route::resource('teams', TeamController::class);

    // Dashboard Anak Magang
    Route::get('/magang/dashboard', [DashboardController::class, 'magang'])->name('magang.dashboard');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.status');
    Route::patch('/projects/{project}/github', [ProjectController::class, 'connectGithub'])->name('projects.github');
});
