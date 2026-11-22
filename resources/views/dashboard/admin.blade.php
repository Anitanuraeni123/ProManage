<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ProManage</title>
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
                        <span class="block text-[11px] font-semibold uppercase tracking-wider text-blue-600">Workspace Admin</span>
                    </div>
                </div>

                <!-- Menu Navigasi Tab -->
                <nav class="space-y-1.5 text-sm font-medium">
                    <button type="button" onclick="switchTab('monitoring')" id="nav-monitoring"
                        class="nav-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-blue-50 text-blue-700 font-semibold transition">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        Monitoring Global
                    </button>

                    <button type="button" onclick="switchTab('assign')" id="nav-assign"
                        class="nav-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Assign Tim
                    </button>

                    <button type="button" onclick="switchTab('evaluasi')" id="nav-evaluasi"
                        class="nav-btn w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                        <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                        Evaluasi Proyek
                    </button>

                    <a href="{{ route('teams.index') }}"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        Kelola Anggota / Tim
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-slate-100">
                <div class="flex items-center gap-3 px-2 py-2 mb-3">
                    <div class="w-9 h-9 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-400 truncate">Pembimbing Industri</p>
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
                    <h1 id="page-title" class="text-2xl font-bold text-slate-900 tracking-tight">Monitoring Global</h1>
                    <p id="page-subtitle" class="text-sm text-slate-500 mt-0.5">Ringkasan statistik peserta magang dan progres proyek keseluruhan.</p>
                </div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-slate-200 text-xs font-medium text-slate-600 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sistem Aktif &bull; {{ now()->format('d M Y') }}
                </div>
            </header>

            @if(session('success'))
                <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ========================================== -->
            <!-- TAB 1: MONITORING GLOBAL                   -->
            <!-- ========================================== -->
            <div id="tab-monitoring" class="tab-content space-y-6">
                <!-- Kartu Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Anak Magang</p>
                                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalAnggota }}</p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <i data-lucide="users" class="w-6 h-6"></i>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 mt-4"><span class="text-blue-600 font-semibold">Aktif</span> terdaftar dalam sistem</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Proyek Berjalan</p>
                                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $proyekBerjalan }}</p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <i data-lucide="activity" class="w-6 h-6"></i>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 mt-4"><span class="text-emerald-600 font-semibold">On Track</span> sedang dikerjakan tim</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Project Stagnant</p>
                                <p class="text-3xl font-bold text-slate-900 mt-2">{{ $projectStagnant }}</p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 mt-4"><span class="text-amber-600 font-semibold">Perlu Perhatian</span> tanpa update &gt;3 hari</p>
                    </div>
                </div>

                <!-- Ringkasan Progres Semua Proyek -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="text-base font-bold text-slate-900">Status & Progres Proyek Terkini</h2>
                        <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-3 py-1 rounded-full">{{ $projects->count() }} Proyek</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                    <th class="py-3.5 px-6">Nama Proyek</th>
                                    <th class="py-3.5 px-4">Tim Pelaksana</th>
                                    <th class="py-3.5 px-4">Progres Capaian</th>
                                    <th class="py-3.5 px-4">Deadline</th>
                                    <th class="py-3.5 px-6">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($projects as $project)
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="py-4 px-6 font-bold text-slate-900">{{ $project->nama_proyek }}</td>
                                        <td class="py-4 px-4 text-slate-600">{{ $project->team->nama_tim ?? $project->team->name ?? 'Belum di-assign' }}</td>
                                        <td class="py-4 px-4 w-48">
                                            <div class="flex justify-between text-xs font-bold mb-1">
                                                <span class="text-slate-500">Selesai</span>
                                                <span class="text-blue-600">{{ $project->progress }}%</span>
                                            </div>
                                            <div class="w-full bg-slate-100 rounded-full h-2">
                                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $project->progress }}%"></div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-xs text-slate-500">{{ $project->deadline ?? '-' }}</td>
                                        <td class="py-4 px-6">
                                            @if($project->status == 'selesai')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai</span>
                                            @elseif($project->status == 'stagnant')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">Stagnant</span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">Berjalan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-8 text-center text-slate-400">Belum ada proyek terdaftar.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 2: ASSIGN TIM                          -->
            <!-- ========================================== -->
            <div id="tab-assign" class="tab-content hidden">
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h2 class="text-base font-bold text-slate-900">Penugasan Tim Proyek (Assign Tim)</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Tentukan tim anak magang yang bertanggung jawab pada masing-masing proyek.</p>
                        </div>
                        <a href="{{ route('teams.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">+ Kelola Daftar Tim</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                    <th class="py-3.5 px-6">Proyek</th>
                                    <th class="py-3.5 px-4">Tim Saat Ini</th>
                                    <th class="py-3.5 px-6">Pilih & Assign Tim</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($projects as $project)
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="py-4 px-6">
                                            <p class="font-bold text-slate-900">{{ $project->nama_proyek }}</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Deadline: {{ $project->deadline ?? '-' }}</p>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="px-3 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700">
                                                {{ $project->team->nama_tim ?? $project->team->name ?? 'Belum ada tim' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <form action="{{ route('projects.assign', $project->id) }}" method="POST" class="flex items-center gap-2 max-w-sm">
                                                @csrf
                                                @method('PATCH')
                                                <select name="team_id" class="flex-1 bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-blue-500" required>
                                                    <option value="">-- Pilih Tim --</option>
                                                    @foreach($teams as $team)
                                                        <option value="{{ $team->id }}" {{ $project->team_id == $team->id ? 'selected' : '' }}>
                                                            {{ $team->nama_tim ?? $team->name ?? 'Tim #'.$team->id }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition">
                                                    Assign Tim
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="py-8 text-center text-slate-400">Belum ada proyek tersedia.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 3: EVALUASI PROYEK                     -->
            <!-- ========================================== -->
            <div id="tab-evaluasi" class="tab-content hidden">
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h2 class="text-base font-bold text-slate-900">Evaluasi & Penilaian Proyek</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Berikan catatan evaluasi pembimbing serta perbarui status kelayakan proyek.</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                    <th class="py-3.5 px-6">Proyek & Progres</th>
                                    <th class="py-3.5 px-4">Catatan Sebelumnya</th>
                                    <th class="py-3.5 px-6">Form Evaluasi Pembimbing</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($projects as $project)
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="py-4 px-6">
                                            <p class="font-bold text-slate-900">{{ $project->nama_proyek }}</p>
                                            <p class="text-xs text-blue-600 font-semibold mt-1">Capaian: {{ $project->progress }}%</p>
                                        </td>
                                        <td class="py-4 px-4 max-w-xs">
                                            @if($project->catatan_evaluasi)
                                                <p class="text-xs bg-blue-50 text-blue-800 px-3 py-2 rounded-xl border border-blue-100">"{{ $project->catatan_evaluasi }}"</p>
                                            @else
                                                <span class="text-xs text-slate-400 italic">Belum ada catatan</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <form action="{{ route('projects.evaluasi', $project->id) }}" method="POST" class="flex flex-wrap items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="catatan_evaluasi" value="{{ $project->catatan_evaluasi }}" placeholder="Tulis masukan evaluasi..." class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs flex-1 min-w-[180px] focus:outline-none focus:border-blue-500" required>
                                                <select name="status" class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-blue-500">
                                                    <option value="berjalan" {{ $project->status == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                                    <option value="stagnant" {{ $project->status == 'stagnant' ? 'selected' : '' }}>Stagnant</option>
                                                    <option value="selesai" {{ $project->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm transition">
                                                    Simpan Evaluasi
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="py-8 text-center text-slate-400">Belum ada proyek untuk dievaluasi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();

        const titles = {
            monitoring: {
                title: 'Monitoring Global',
                subtitle: 'Ringkasan statistik peserta magang dan progres proyek keseluruhan.'
            },
            assign: {
                title: 'Assign Tim Proyek',
                subtitle: 'Atur penugasan tim anak magang ke proyek yang tersedia.'
            },
            evaluasi: {
                title: 'Evaluasi Proyek',
                subtitle: 'Berikan catatan evaluasi berkala dan tentukan status akhir proyek.'
            }
        };

        function switchTab(tabName) {
            // Sembunyikan semua konten tab
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            // Tampilkan tab yang dipilih
            document.getElementById('tab-' + tabName).classList.remove('hidden');

            // Reset semua tombol navigasi sidebar ke style non-aktif
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('bg-blue-50', 'text-blue-700', 'font-semibold');
                btn.classList.add('text-slate-600', 'hover:bg-slate-50', 'hover:text-slate-900');
            });

            // Aktifkan tombol sidebar yang diklik
            const activeBtn = document.getElementById('nav-' + tabName);
            activeBtn.classList.remove('text-slate-600', 'hover:bg-slate-50', 'hover:text-slate-900');
            activeBtn.classList.add('bg-blue-50', 'text-blue-700', 'font-semibold');

            // Ubah judul header
            document.getElementById('page-title').textContent = titles[tabName].title;
            document.getElementById('page-subtitle').textContent = titles[tabName].subtitle;

            // Simpan tab terakhir di sessionStorage agar setelah submit form tetap di tab yang sama
            sessionStorage.setItem('adminActiveTab', tabName);
        }

        // Pulihkan tab terakhir saat halaman reload setelah submit form
        document.addEventListener('DOMContentLoaded', () => {
            const savedTab = sessionStorage.getItem('adminActiveTab');
            if (savedTab && document.getElementById('tab-' + savedTab)) {
                switchTab(savedTab);
            }
        });
    </script>
</body>
</html>
