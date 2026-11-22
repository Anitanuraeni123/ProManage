<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Anggota / Tim - ProManage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar Putih Minimalis (Seragam dengan Dashboard Admin) -->
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

                <nav class="space-y-1.5 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" onclick="sessionStorage.setItem('adminActiveTab', 'monitoring')"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        Monitoring Global
                    </a>

                    <a href="{{ route('admin.dashboard') }}" onclick="sessionStorage.setItem('adminActiveTab', 'assign')"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Assign Tim
                    </a>

                    <a href="{{ route('admin.dashboard') }}" onclick="sessionStorage.setItem('adminActiveTab', 'evaluasi')"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                        <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                        Evaluasi Proyek
                    </a>

                    <a href="{{ route('teams.index') }}"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-blue-50 text-blue-700 font-semibold transition">
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
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Kelola Anggota & Tim</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Buat kelompok tim anak magang untuk di-assign ke proyek.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" onclick="sessionStorage.setItem('adminActiveTab', 'monitoring')"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-xs font-semibold text-slate-700 shadow-sm transition">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 text-blue-600"></i>
                    Kembali ke Dashboard Admin
                </a>
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

            <!-- Form Tambah Tim Baru -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
                <h2 class="text-base font-bold text-slate-900 mb-4">Tambah Tim Baru</h2>
                <form action="{{ route('teams.store') }}" method="POST" class="space-y-4 text-sm">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Tim</label>
                        <input type="text" name="nama_tim" placeholder="Contoh: Tim Magang Web A" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat mengenai tim..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:outline-none focus:border-blue-500"></textarea>
                    </div>
                    <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-5 py-2.5 rounded-xl shadow-sm shadow-blue-200 transition">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Simpan Tim
                    </button>
                </form>
            </div>

            <!-- Tabel Daftar Tim -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="text-base font-bold text-slate-900">Daftar Tim Terdaftar</h2>
                    <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-3 py-1 rounded-full">{{ $teams->count() }} Tim</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                <th class="py-3.5 px-6 w-16">No</th>
                                <th class="py-3.5 px-4">Nama Tim</th>
                                <th class="py-3.5 px-4">Deskripsi</th>
                                <th class="py-3.5 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($teams as $index => $team)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-4 px-6 text-slate-500">{{ $index + 1 }}</td>
                                    <td class="py-4 px-4 font-bold text-slate-900">{{ $team->nama_tim ?? $team->name }}</td>
                                    <td class="py-4 px-4 text-slate-600">{{ $team->deskripsi ?? '-' }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Hapus tim ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-slate-400 text-sm">Belum ada data tim. Silakan tambah tim baru di atas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
