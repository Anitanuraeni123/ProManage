<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anak Magang - ProManage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar Putih Minimalis -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between sticky top-0 h-screen">
            <div class="p-6">
                <div class="flex items-center gap-2.5 mb-8">
                    <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold shadow-sm shadow-blue-200">
                        P
                    </div>
                    <div>
                        <span class="text-xl font-bold text-slate-900 tracking-tight">ProManage<span class="text-blue-600">.</span></span>
                        <span class="block text-[11px] font-semibold uppercase tracking-wider text-emerald-600">Anak Magang</span>
                    </div>
                </div>

                <!-- Menu Navigasi Tab (Klik 1 per 1) -->
                <nav class="space-y-1.5 text-sm font-medium">
                    <button type="button" onclick="switchMagangTab('tugas')" id="nav-tugas"
                        class="nav-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-blue-50 text-blue-700 font-semibold transition text-left">
                        <i data-lucide="check-square" class="w-4 h-4 shrink-0"></i>
                        <span>Tugas Harian</span>
                    </button>

                    <button type="button" onclick="switchMagangTab('github')" id="nav-github"
                        class="nav-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition text-left">
                        <i data-lucide="git-branch" class="w-4 h-4 shrink-0"></i>
                        <span>Repo GitHub</span>
                    </button>

                    <button type="button" onclick="switchMagangTab('notifikasi')" id="nav-notifikasi"
                        class="nav-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition text-left">
                        <i data-lucide="bell" class="w-4 h-4 shrink-0"></i>
                        <span>Notifikasi Reminder</span>
                        @if($reminders->count() > 0)
                            <span class="ml-auto bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $reminders->count() }}</span>
                        @endif
                    </button>
                </nav>
            </div>

            <div class="p-4 border-t border-slate-100">
                <div class="flex items-center gap-3 px-2 py-2 mb-3">
                    <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">
                        {{ strtoupper(substr($user->name ?? 'M', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-slate-400 truncate">Peserta Magang / PKL</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-rose-50 hover:bg-rose-100 text-rose-600 py-2.5 rounded-xl text-xs font-semibold transition">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                        Keluar Akun
                    </button>
                </form>
            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 p-8 max-w-7xl mx-auto space-y-6">
            <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 id="page-title" class="text-2xl font-bold text-slate-900 tracking-tight">Tugas Harian & Manual Update Status</h1>
                    <p id="page-subtitle" class="text-sm text-slate-500 mt-0.5">Halo {{ $user->name }}, perbarui progres tugas harian Anda secara manual.</p>
                </div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-slate-200 text-xs font-medium text-slate-600 shadow-sm">
                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-blue-600"></i>
                    {{ now()->format('d M Y') }}
                </div>
            </header>

            @if(session('success'))
                <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- ========================================== -->
            <!-- TAB 1: TUGAS HARIAN & MANUAL UPDATE STATUS -->
            <!-- ========================================== -->
            <div id="tab-tugas" class="tab-content bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Daftar Tugas Harian Anda</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Ubah status menjadi Done untuk memperbarui progress bar proyek.</p>
                    </div>
                    <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-3 py-1 rounded-full">{{ $tasks->count() }} Tugas</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                <th class="py-3.5 px-6">Kode Task</th>
                                <th class="py-3.5 px-4">Tugas Harian</th>
                                <th class="py-3.5 px-4">Proyek</th>
                                <th class="py-3.5 px-4">Status Saat Ini</th>
                                <th class="py-3.5 px-6">Manual Update Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($tasks as $task)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-4 px-6">
                                        <span class="font-mono text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md border border-blue-100">
                                            {{ $task->kode_task ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 font-semibold text-slate-800">{{ $task->judul_tugas }}</td>
                                    <td class="py-4 px-4 text-xs text-slate-500">{{ $task->project->nama_proyek ?? '-' }}</td>
                                    <td class="py-4 px-4">
                                        @if($task->status == 'done')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Done</span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">In Progress</span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">Pending</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <form action="{{ route('tasks.status', $task->id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="bg-white border border-slate-200 rounded-xl px-3 py-1.5 text-xs text-slate-700 focus:outline-none focus:border-blue-500">
                                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                                            </select>
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3.5 py-1.5 rounded-xl transition">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="py-12 text-center text-slate-500 text-sm">Belum ada tugas harian.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 2: REPO GITHUB & PROGRESS BAR          -->
            <!-- ========================================== -->
            <div id="tab-github" class="tab-content hidden grid md:grid-cols-2 gap-6">
                @forelse($projects as $project)
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="font-bold text-slate-900 text-base">{{ $project->nama_proyek }}</h3>
                                <p class="text-xs text-slate-500 mt-1">Deadline: {{ $project->deadline ?? '-' }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $project->progress }}%
                            </span>
                        </div>

                        <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $project->progress }}%"></div>
                        </div>

                        @if($project->catatan_evaluasi)
                            <div class="text-xs bg-slate-50 border border-slate-200/80 text-slate-600 px-3 py-2 rounded-xl">
                                <span class="font-semibold text-slate-800">Evaluasi Pembimbing:</span> "{{ $project->catatan_evaluasi }}"
                            </div>
                        @endif

                        <form action="{{ route('projects.github', $project->id) }}" method="POST" class="pt-3 border-t border-slate-100">
                            @csrf
                            @method('PATCH')
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">URL Repository GitHub</label>
                            <div class="flex gap-2">
                                <input type="text" name="github_repo" value="{{ $project->github_repo }}" placeholder="https://github.com/username/repo" class="flex-1 text-xs bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 focus:bg-white focus:outline-none focus:border-blue-500" required>
                                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold px-4 py-2 rounded-xl transition">
                                    Hubungkan
                                </button>
                            </div>
                        </form>
                    </div>
                @empty
                    <div class="col-span-2 bg-white border border-slate-200/80 rounded-2xl p-8 text-center text-sm text-slate-500">
                        Belum ada proyek yang terhubung.
                    </div>
                @endforelse
            </div>

            <!-- ========================================== -->
            <!-- TAB 3: NOTIFIKASI REMINDER                 -->
            <!-- ========================================== -->
            <div id="tab-notifikasi" class="tab-content hidden bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i data-lucide="bell-ring" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Notifikasi & Reminder Deadline</h2>
                        <p class="text-xs text-slate-500">Peringatan otomatis untuk proyek yang mendekati batas waktu H-1 / H.</p>
                    </div>
                </div>

                @forelse($reminders as $rem)
                    <div class="flex items-start gap-3 p-4 bg-amber-50/80 border border-amber-200 rounded-xl text-amber-900 text-sm">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-amber-600 shrink-0 mt-0.5"></i>
                        <div>
                            <p class="font-semibold">Deadline Mendekat: {{ $rem->nama_proyek }}</p>
                            <p class="text-xs text-amber-700 mt-0.5">Batas waktu <strong>{{ $rem->deadline }}</strong> &bull; Progres saat ini <strong>{{ $rem->progress }}%</strong>.</p>
                        </div>
                    </div>
                @empty
                    <div class="flex items-center gap-2.5 text-sm text-slate-500 bg-slate-50 px-4 py-4 rounded-xl">
                        <i data-lucide="sparkles" class="w-4 h-4 text-emerald-500"></i>
                        <span>Semua aman! Tidak ada peringatan deadline mendesak hari ini.</span>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();

        const magangTitles = {
            tugas: {
                title: 'Tugas Harian & Manual Update Status',
                subtitle: 'Perbarui status tugas Anda untuk memperbarui progress bar proyek secara otomatis.'
            },
            github: {
                title: 'Hubungkan Repo GitHub',
                subtitle: 'Tautkan URL repository GitHub agar setiap push/commit terdeteksi otomatis.'
            },
            notifikasi: {
                title: 'Notifikasi Reminder',
                subtitle: 'Pantau pengingat deadline dan status peringatan proyek Anda.'
            }
        };

        function switchMagangTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('tab-' + tabName).classList.remove('hidden');

            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('bg-blue-50', 'text-blue-700', 'font-semibold');
                btn.classList.add('text-slate-600', 'hover:bg-slate-50', 'hover:text-slate-900');
            });

            const activeBtn = document.getElementById('nav-' + tabName);
            activeBtn.classList.remove('text-slate-600', 'hover:bg-slate-50', 'hover:text-slate-900');
            activeBtn.classList.add('bg-blue-50', 'text-blue-700', 'font-semibold');

            document.getElementById('page-title').textContent = magangTitles[tabName].title;
            document.getElementById('page-subtitle').textContent = magangTitles[tabName].subtitle;

            sessionStorage.setItem('magangActiveTab', tabName);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedTab = sessionStorage.getItem('magangActiveTab');
            if (savedTab && document.getElementById('tab-' + savedTab)) {
                switchMagangTab(savedTab);
            }
        });
    </script>
</body>
</html>
