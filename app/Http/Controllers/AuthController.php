<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1. Jika yang login adalah Admin (admin@gmail.com) -> wajib cek password di database
        if ($request->email === 'admin@gmail.com') {
            if (Auth::attempt(['email' => 'admin@gmail.com', 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors([
                'email' => 'Password untuk Admin salah!',
            ])->onlyInput('email');
        }

        // 2. Selain admin@gmail.com -> otomatis masuk sebagai Anak Magang tanpa perlu daftar dulu
        $namaOtomatis = ucwords(str_replace(['.', '_', '-'], ' ', explode('@', $request->email)[0]));

        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $namaOtomatis,
                'password' => Hash::make($request->password),
                'role' => 'anak_magang',
            ]
        );

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('magang.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
