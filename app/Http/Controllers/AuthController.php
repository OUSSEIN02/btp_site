<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validation
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        // Tentative d’authentification
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Sanctum va gérer la session automatiquement
            return redirect()->intended('/admin/realisations')
                             ->with('success', 'Connexion réussie !');
        }

        // Si échec
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
