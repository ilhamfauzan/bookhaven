<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    // Validasi login (email atau username)
    $request->validate([
        'login' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $login = $request->input('login');

    // Tentukan apakah login menggunakan email atau username
    $user = filter_var($login, FILTER_VALIDATE_EMAIL)
        ? User::where('email', $login)->first()
        : User::where('username', $login)->first();

    // Cek apakah user ditemukan dan password cocok
    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);

        // Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // Redirect ke halaman dashboard atau halaman yang diinginkan
        return redirect()->intended(route('home'));
    }

    // Jika login gagal
    return back()->withErrors([
        'login' => 'The provided credentials do not match our records.',
    ]);
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
