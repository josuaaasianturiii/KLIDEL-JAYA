<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user();

            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Selamat datang kembali di Portal Administrator, '.$user->name);
            }

            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang kembali, '.$user->name);
        }

        return back()->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Kombinasi email dan kata sandi tidak cocok dengan data kami.',
            ]);
    }

    /**
     * Handle quick demo login for testing purposes.
     */
    public function quickLogin(string $role): RedirectResponse
    {
        $email = $role === 'admin' ? 'admin@aihealth.com' : 'user@aihealth.com';
        $user = User::where('email', $email)->first();

        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();

            return $user->isAdmin()
                ? redirect()->route('admin.dashboard')->with('success', 'Masuk cepat sebagai Administrator ('.$user->name.')')
                : redirect()->route('home')->with('success', 'Masuk cepat sebagai Pasien / User ('.$user->name.')');
        }

        return redirect()->route('login')->with('error', 'Akun demo tidak ditemukan.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Anda telah berhasil keluar.');
    }
}
