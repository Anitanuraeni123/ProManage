<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - Sistem Monitoring PKL & Magang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="#beranda" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold shadow-sm shadow-blue-200">
                    P
                </div>
                <span class="text-xl font-bold text-slate-900 tracking-tight">ProManage<span class="text-blue-600">.</span></span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="#beranda" class="hover:text-blue-600 transition">Beranda</a>
                <a href="#alur-sistem" class="hover:text-blue-600 transition">Alur Sistem</a>
                <a href="#fitur" class="hover:text-blue-600 transition">Fitur Utama</a>
                <a href="#tentang" class="hover:text-blue-600 transition">Tentang</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/login') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-sm shadow-blue-200 transition">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative overflow-hidden pt-16 pb-24 lg:pt-24 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-12 gap-12 items-center">
            <!-- Kiri: Teks Utama -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-xs font-bold tracking-wide uppercase">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    Sistem Monitoring PKL & Magang Terintegrasi
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-[52px] font-extrabold text-slate-900 leading-[1.15] tracking-tight">
                    Pantau Proses PKL
                    <span class="text-blue-600 block mt-1">Lebih Mudah & Terarah.</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl">
                    ProManage menghubungkan aktivitas harian <strong>Anak Magang</strong> dan <strong>Pembimbing Industri (Admin)</strong> dalam satu ekosistem otomatis — terintegrasi langsung dengan <em>GitHub Webhook</em> dan <em>Reminder Otomatis</em>.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ url('/login') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-7 py-3.5 rounded-xl shadow-lg shadow-blue-200 transition">
                        Mulai Sekarang
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <a href="#alur-sistem" class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 font-semibold px-6 py-3.5 rounded-xl transition">
                        Lihat Alur Kerja
                    </a>
                </div>
            </div>

            <!-- Kanan: Preview Dashboard Live -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/50 p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-rose-400"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-emerald-400"></div>
                            <span class="ml-2 text-xs font-bold text-slate-700">ProManage Live Monitor</span>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                            Online
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <p class="text-xs font-semibold text-slate-400 uppercase">Total Proyek</p>
                            <p class="text-2xl font-extrabold text-slate-900 mt-1">12</p>
                            <p class="text-[11px] text-slate-500 mt-1">Proyek Terdaftar</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <p class="text-xs font-semibold text-slate-400 uppercase">Status Sistem</p>
                            <p class="text-2xl font-extrabold text-emerald-600 mt-1">Aktif</p>
                            <p class="text-[11px] text-slate-500 mt-1">Webhook & Cron Ready</p>
                        </div>
                    </div>

                    <div class="bg-blue-50/60 border border-blue-100 p-4 rounded-2xl space-y-2.5">
                        <div class="flex justify-between items-center text-xs font-bold">
                            <span class="text-slate-700">Progress Proyek Utama</span>
                            <span class="text-blue-600">75%</span>
                        </div>
                        <div class="w-full bg-white rounded-full h-2.5 overflow-hidden border border-blue-100">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                        </div>
                        <p class="text-[11px] text-slate-500 flex items-center gap-1.5 pt-1">
                            <i data-lucide="git-commit" class="w-3.5 h-3.5 text-blue-600"></i>
                            Auto-update via push commit #TASK-04
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Alur Sistem (Sesuai Flowchart) -->
    <section id="alur-sistem" class="py-20 bg-white border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 space-y-14">
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Arsitektur & Alur Kerja</span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Bagaimana ProManage Bekerja?</h2>
                <p class="text-sm text-slate-500">Alur sistem terintegrasi dari proses autentikasi peran hingga pembaruan progres otomatis di latar belakang.</p>
            </div>

            <!-- Step 1: Login & Pemisahan Role -->
            <div class="max-w-3xl mx-auto bg-slate-50 border border-slate-200/80 rounded-2xl p-6 text-center space-y-3">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-600 text-white font-bold text-sm shadow-sm">1</div>
                <h3 class="text-lg font-bold text-slate-900">Autentikasi & Validasi Peran (Role)</h3>
                <p class="text-xs text-slate-600 max-w-lg mx-auto">Pengguna masuk menggunakan Email & Password. Sistem memvalidasi akun dan mengarahkan otomatis sesuai peran masing-masing.</p>
            </div>

            <!-- Step 2: Dua Jalur Role (Admin vs Anak Magang) -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Jalur Admin / Pembimbing Industri -->
                <div class="bg-blue-50/40 border border-blue-200/80 rounded-3xl p-7 space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-sm">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Role 1</span>
                            <h3 class="text-lg font-bold text-slate-900">Admin / Pembimbing Industri</h3>
                        </div>
                    </div>
                    <ul class="space-y-3 text-sm text-slate-700">
                        <li class="flex items-center gap-2.5 bg-white px-4 py-2.5 rounded-xl border border-blue-100">
                            <i data-lucide="layout-dashboard" class="w-4 h-4 text-blue-600"></i>
                            <span><strong>Monitoring Global:</strong> Pantau seluruh proyek & peserta magang</span>
                        </li>
                        <li class="flex items-center gap-2.5 bg-white px-4 py-2.5 rounded-xl border border-blue-100">
                            <i data-lucide="users" class="w-4 h-4 text-blue-600"></i>
                            <span><strong>Kelola Anggota & Assign Tim:</strong> Atur pembagian tim proyek</span>
                        </li>
                        <li class="flex items-center gap-2.5 bg-white px-4 py-2.5 rounded-xl border border-blue-100">
                            <i data-lucide="clipboard-check" class="w-4 h-4 text-blue-600"></i>
                            <span><strong>Evaluasi Proyek:</strong> Beri catatan & status penilaian berkala</span>
                        </li>
                    </ul>
                </div>

                <!-- Jalur Anak Magang / Siswa PKL -->
                <div class="bg-emerald-50/40 border border-emerald-200/80 rounded-3xl p-7 space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shadow-sm">
                            <i data-lucide="user-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Role 2</span>
                            <h3 class="text-lg font-bold text-slate-900">Anak Magang / Siswa PKL</h3>
                        </div>
                    </div>
                    <ul class="space-y-3 text-sm text-slate-700">
                        <li class="flex items-center gap-2.5 bg-white px-4 py-2.5 rounded-xl border border-emerald-100">
                            <i data-lucide="list-todo" class="w-4 h-4 text-emerald-600"></i>
                            <span><strong>Lihat Tugas Harian:</strong> Cek daftar task proyek yang harus dikerjakan</span>
                        </li>
                        <li class="flex items-center gap-2.5 bg-white px-4 py-2.5 rounded-xl border border-emerald-100">
                            <i data-lucide="refresh-cw" class="w-4 h-4 text-emerald-600"></i>
                            <span><strong>Manual Update Status:</strong> Perbarui progres task secara langsung</span>
                        </li>
                        <li class="flex items-center gap-2.5 bg-white px-4 py-2.5 rounded-xl border border-emerald-100">
                            <i data-lucide="git-branch" class="w-4 h-4 text-emerald-600"></i>
                            <span><strong>Hubungkan Repo GitHub & Cek Reminder:</strong> Sinkronisasi repository</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 3: Otomatisasi Background (Webhook & Cron Job) -->
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-amber-50/50 border border-amber-200/80 rounded-3xl p-7 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center">
                            <i data-lucide="webhook" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Integrasi Otomatis & Webhook GitHub</h3>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Setiap aktivitas <strong>Push / Commit</strong> ke GitHub mengirim <em>Payload JSON</em> ke API Laravel. Sistem otomatis mengubah status task menjadi selesai dan menghitung ulang persentase <strong>Progress Bar</strong> pada dashboard Admin & Anak Magang.
                    </p>
                </div>

                <div class="bg-purple-50/50 border border-purple-200/80 rounded-3xl p-7 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Laravel Scheduler (Cron Job Harian)</h3>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sistem melakukan pengecekan harian otomatis untuk mendeteksi <strong>Deadline H-1 / H</strong> serta <strong>Project Stagnant</strong> (tidak ada update task/GitHub), lalu mengirimkan pengingat langsung ke Anak Magang dan Pembimbing.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Unggulan -->
    <section id="fitur" class="py-20">
        <div class="max-w-7xl mx-auto px-6 space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Fitur Unggulan</span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Semua Monitoring dalam Satu Sistem</h2>
                <p class="text-sm text-slate-500">Dirancang agar kegiatan magang lebih terstruktur, transparan, dan mudah dievaluasi.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition space-y-3">
                    <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i data-lucide="check-square" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900">Monitoring Tugas</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Pantau tugas harian dan perkembangan pekerjaan anak magang secara terukur.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition space-y-3">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900">Progress Proyek</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Persentase capaian proyek terhitung otomatis berdasarkan penyelesaian task.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition space-y-3">
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i data-lucide="bell-ring" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900">Notifikasi Otomatis</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Peringatan dini untuk jadwal deadline mendekat maupun proyek yang stagnan.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition space-y-3">
                    <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                        <i data-lucide="github" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-900">Integrasi GitHub</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Hubungkan repository kode agar setiap commit langsung memperbarui status tugas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-16 bg-slate-900 text-white">
        <div class="max-w-4xl mx-auto px-6 text-center space-y-4">
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">Tentang ProManage</h2>
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                ProManage dirancang untuk membantu proses monitoring Praktik Kerja Lapangan (PKL) & Magang agar lebih efektif, transparan, dan terorganisasi melalui integrasi otomasi berbasis web.
            </p>
            <div class="pt-4">
                <a href="{{ url('/login') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold px-6 py-3 rounded-xl transition">
                    Masuk ke Aplikasi
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-6 text-center text-xs border-t border-slate-800">
        <p>© 2026 ProManage. Sistem Monitoring PKL & Magang.</p>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
