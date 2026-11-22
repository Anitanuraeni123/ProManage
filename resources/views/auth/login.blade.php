<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ProManage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center antialiased px-4">
    <div class="bg-white p-8 rounded-2xl shadow-md border border-slate-200/70 w-full max-w-md">
        <h1 class="text-2xl font-bold text-blue-600">ProManage.</h1>
        <p class="text-slate-500 text-sm mt-1 mb-6">Silakan masuk ke akun Anda</p>

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-2.5 rounded-xl text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                    class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                <div class="relative">
                    <input type="password" id="passwordInput" name="password" placeholder="Masukkan password"
                        class="w-full border border-slate-300 rounded-xl pl-3.5 pr-11 py-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition" required>

                    <button type="button" onclick="togglePassword()" aria-label="Tampilkan atau sembunyikan password"
                        class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 hover:text-slate-600 transition">
                        <span id="eyeOpen">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </span>
                        <span id="eyeClosed" class="hidden">
                            <i data-lucide="eye-off" class="w-4 h-4"></i>
                        </span>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl shadow-sm shadow-blue-200 transition">
                Login
            </button>
        </form>

        <div class="text-center mt-5">
            <a href="{{ url('/') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeClosed.classList.add('hidden');
                eyeOpen.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
