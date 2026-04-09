<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

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
            return redirect()->intended('/admin/dashboard')
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

        return redirect('/auth')->with('success', 'Déconnexion réussie !');
    }
}
