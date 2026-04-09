<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Realisation;

class RealisationController extends Controller
{
    public function index(Request $request){
        $reals = Realisation::latest()->get();

        return view('admin.realisations.index', compact('reals'));
    }

    public function create()
    {
        return view('admin.realisations.create');
    }

    public function store (Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ],
        [
            'title.required' => 'Le titre est obligatoire.',
            'content.required' => 'Le contenu est obligatoire.',
            'image.image' => "Le fichier doit être une image valide.",
            'image.max' => "L'image ne doit pas dépasser 2MB."
        ]);

        $imagePath = null;
    
        if ($request->hasFile('image')) {
            // Traitement et stockage dans MembresPhotos
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('RealisationsPhoto', $imageName, 'public');
        }

        Realisation::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('realisations.index')->with('success', 'Réalisation créée avec succès.');
    }


    public function edit($id)
    {
        $reals = Realisation::findOrFail($id);
        return view('admin.realisations.edit', compact('reals'));
    }


     
    public function update(Request $request, Realisation $reals)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ],
        [
            'title.required' => 'Le titre est obligatoire.',
            'content.required' => 'Le contenu est obligatoire.',
            'image.image' => "Le fichier doit être une image valide.",
            'image.max' => "L'image ne doit pas dépasser 2MB."
        ]
        );
    
        $reals->title = $request->title;
        $reals->content = $request->content;
    
        if ($request->hasFile('image')) {
            if ($reals->image && Storage::disk('public')->exists($reals->image)) {
                Storage::disk('public')->delete($reals->image);
            }
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $reals->image = $request->file('image')->storeAs('RealisationsPhoto', $imageName, 'public');
        }
    
        $reals->save();
    
        return redirect()->route('realisations.index')->with('success', 'Réalisation modifiée avec succès.');
    }


    public function destroy(Realisation $reals)
    {
        // Supprimer l'image si elle existe
        if ($reals->image && Storage::disk('public')->exists($reals->image)) {
            Storage::disk('public')->delete($reals->image);
        }

        // Supprimer l'actualité
        $reals->delete();

        // Redirection
        return redirect()->route('realisations.index')
                        ->with('success', 'Réalisation supprimée avec succès.');
    }   

   

}
