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
            'login' => ['nullable', 'string', 'required_without:email'],
            'email' => ['nullable', 'string', 'required_without:login'],
            'password' => ['required', 'string'],
        ]);

        $login = trim((string) ($request->input('login') ?? $request->input('email')));

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
                'email' => 'Email/NIP atau password salah.',
            ])->onlyInput('login', 'email');
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
