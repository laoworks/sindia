<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Ambil input login
        $login = trim($request->login);

        // Cek login email atau NIP
        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'nip';

        // Credentials login
        $credentials = [
            $field => $login,
            'password' => $request->password,
        ];

        // Jika ingin hanya user aktif yang bisa login
        // Uncomment di bawah:
        // $credentials['is_active'] = 1;

        // Proses login
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {

            return back()->withErrors([
                'login' => 'Email/NIP atau password salah.',
            ])->onlyInput('login');
        }

        // Regenerate session
        $request->session()->regenerate();

        // Ambil user login
        $user = Auth::user();

        // Redirect berdasarkan role
        switch ($user->role) {

            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'guru':
                return redirect()->route('guru.dashboard');

            case 'operator':
                return redirect()->route('operator.dashboard');

            case 'kepala_sekolah':
                return redirect()->route('kepala.dashboard');

            case 'waka_kurikulum':
                return redirect()->route('waka.dashboard');

            default:

                Auth::logout();

                return redirect('/')
                    ->with('error', 'Role tidak dikenali.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
