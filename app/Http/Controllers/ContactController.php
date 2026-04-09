<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string',
            'type_projet' => 'required|string',
            'localisation' => 'nullable|string',
            'budget' => 'nullable|string',
            'message' => 'required|string',
        ],
        [
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être une adresse valide.',
            'type_projet.required' => 'Le type de projet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
        ]);
        
        // Création du message
        $message = Message::create($validated);
        
        // Vérifier si la requête est AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Message envoyé avec succès',
                'data' => $message
            ], 200);
        }
        
        // Pour les requêtes normales (non AJAX)
        return redirect()->back()->with('success', 'Message envoyé avec succès');
    }
}