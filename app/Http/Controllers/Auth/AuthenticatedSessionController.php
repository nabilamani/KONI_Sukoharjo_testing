<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
    public function store(LoginRequest $request): RedirectResponse
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
        ]);
    
        $recaptcha = json_decode($response->body());
    
        if (!$recaptcha->success) {
            return back()->withErrors(['g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal.']);
        }
            
            $request->authenticate();
    
            $request->session()->regenerate();
            
    
            // Tambahkan flash message
            return redirect()->intended(route('dashboard', absolute: false))
                ->with('message', 'Login berhasil! Selamat datang kembali.');
        }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/konilogin');
    }
}
