<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Log::info('Login attempt', ['email' => $request->input('email')]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            Log::info('Login successful', ['email' => $request->input('email')]);

            // Redirect berdasarkan role
            $user = Auth::user();
            if ($user->role === 'admin' || $user->role === 'staff') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('homepage');
        }

        Log::warning('Login failed', ['email' => $request->input('email')]);

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userClass = config('auth.providers.users.model');

        $user = $userClass::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'customer',
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login dengan email dan password Anda.');
    }
}
