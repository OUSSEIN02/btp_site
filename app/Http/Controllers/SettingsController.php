<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Afficher la page paramètres
     */
    public function index()
    {
        $admin = Auth::user();
        $settings = Setting::first();

        return view('admin.settings.index', compact('admin', 'settings'));
    }


    /**
     * ==============================
     * METTRE À JOUR PROFIL ADMIN
     * ==============================
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
        ]);

        $admin->update([
            'name' => $request->nom,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Informations administrateur mises à jour avec succès.');
    }


    /**
     * ==============================
     * METTRE À JOUR MOT DE PASSE
     * ==============================
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    
        $admin = Auth::user();
    
        // Vérifier si le mot de passe actuel est correct
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('error', 'Le mot de passe actuel est incorrect.');
        }
    
        // Mettre à jour le mot de passe
        $admin->update([
            'password' => Hash::make($request->password),
        ]);
    
        return back()->with('success', 'Mot de passe modifié avec succès.');
    }


    /**
     * ==============================
     * METTRE À JOUR INFOS CONTACT
     * ==============================
     */
    public function updateContact(Request $request)
    {
        $request->validate([
            'adresse' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        $settings = Setting::first();

        if (!$settings) {
            $settings = Setting::create([
                'adresse' => $request->adresse,
                'contact_email' => $request->contact_email,
                'telephone' => $request->telephone,
            ]);
        } else {
            $settings->update([
                'adresse' => $request->adresse,
                'contact_email' => $request->contact_email,
                'telephone' => $request->telephone,
            ]);
        }

        return back()->with('success', 'Informations de contact mises à jour avec succès.');
    }
}