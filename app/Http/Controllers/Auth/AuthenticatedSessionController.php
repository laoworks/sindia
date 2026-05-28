<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $login = trim($request->login);

        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'nip';

        $credentials = [
            $field => $login,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'login' => 'Email/NIP atau password salah.',
            ])->onlyInput('login');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ FIX REDIRECT FINAL
        return match ($user->role) {

            'admin' => redirect()->route('admin.dashboard'),

            'guru' => redirect()->route('guru.dashboard'),

            'operator' => redirect()->route('operator.dashboard'),

            'kepala_sekolah' => redirect()->route('kepala.dashboard'),

            default => redirect('/login'),
        };
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
