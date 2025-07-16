<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showAuth()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.auth');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password.',
            'password.min' => 'Password minimal 8 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        //user baru dgn password hash
        User::create([
            'email' => $request->email,
            'password' => $request->password, // Autohash karna mutator
        ]);

        return redirect()->route('auth')->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Check if remember me is checked

        // Auth::attempt() dengan remember parameter
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $message = $remember ? 
                'Login berhasil! Anda akan tetap login selama 30 hari.' : 
                'Login berhasil!';
                
            return redirect()->route('dashboard')->with('success', $message);
        }

        return back()->withErrors([
            'login' => 'Email atau password salah. Silakan coba lagi.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Clear remember token from database if user was remembered
        if (Auth::user()) {
            Auth::user()->setRememberToken(null);
            Auth::user()->save();
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Clear remember cookie from browser
        return redirect()->route('auth')
            ->with('success', 'Anda telah logout.')
            ->withCookie(cookie()->forget('remember_web'));
    }
}