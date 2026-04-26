<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realisation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RealisationController extends Controller
{
    public function index(Request $request)
    {
        $reals = Realisation::latest()->get();
        return view('admin.realisations.index', compact('reals'));
    }

    public function create()
    {
        return view('admin.realisations.create');
    }

    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'title'               => 'required|string|max:255',
            'content'             => 'required|string',
            'image'               => 'required|image|max:2048',
            'additional_images'   => 'nullable|array|max:5',         // ✅ Corrigé
            'additional_images.*' => 'nullable|image|max:2048',      // ✅ Corrigé
        ], [
            'title.required'               => 'Le titre est obligatoire.',
            'content.required'             => 'Le contenu est obligatoire.',
            'image.required'               => 'L\'image de couverture est obligatoire.',
            'image.image'                  => 'Le fichier doit être une image valide.',
            'image.max'                    => 'L\'image de couverture ne doit pas dépasser 2MB.',
            'additional_images.max'        => 'Vous ne pouvez pas ajouter plus de 5 images supplémentaires.',  // ✅ Corrigé
            'additional_images.*.image'    => 'Chaque fichier supplémentaire doit être une image valide.',     // ✅ Corrigé
            'additional_images.*.max'      => 'Chaque image supplémentaire ne doit pas dépasser 2MB.'         // ✅ Corrigé
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Traitement de l'image principale
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('RealisationsPhoto', $imageName, 'public');
        }

        // Traitement des images supplémentaires
        $additionalImages = [];
        if ($request->hasFile('additional_images')) {                             // ✅ Corrigé
            $images = $request->file('additional_images');                        // ✅ Corrigé

            // Limiter à 5 images
            $imagesToProcess = array_slice($images, 0, 5);

            foreach ($imagesToProcess as $index => $image) {
                $imageName = time() . '_' . ($index + 1) . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                $imagePathAdditional = $image->storeAs('RealisationsPhoto/Additional', $imageName, 'public');
                $additionalImages[] = $imagePathAdditional;
            }
        }

        // Création de la réalisation
        $realisation = Realisation::create([
            'title'              => $request->title,
            'content'            => $request->content,
            'image'              => $imagePath,
            'additional_images'  => $additionalImages,
        ]);

        return redirect()->route('realisations.index')
            ->with('success', 'Réalisation créée avec succès. ' . count($additionalImages) . ' image(s) supplémentaire(s) ajoutée(s).');
    }

    public function edit($id)
    {
        $reals = Realisation::findOrFail($id);
        return view('admin.realisations.edit', compact('reals'));
    }


    public function update(Request $request, Realisation $reals)
    {

        $validator = Validator::make($request->all(), [
            'title'               => 'required|string|max:255',
            'content'             => 'required|string',
            'image'               => 'nullable|image|max:2048',
            'additional_images'   => 'nullable|array|max:5',
            'additional_images.*' => 'nullable|image|max:2048',
            'delete_additional_images' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $reals->title   = $request->title;
        $reals->content = $request->content;

        // Mettre à jour l'image principale
        if ($request->hasFile('image')) {
            if ($reals->image && Storage::disk('public')->exists($reals->image)) {
                Storage::disk('public')->delete($reals->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $reals->image = $image->storeAs('RealisationsPhoto', $imageName, 'public');
        }

        // Gestion des images supplémentaires
        $currentImages = is_string($reals->additional_images) 
            ? json_decode($reals->additional_images, true) 
            : ($reals->additional_images ?? []);
        
        // Supprimer les images marquées
        if ($request->filled('delete_additional_images')) {
            $imagesToDelete = explode(',', $request->delete_additional_images);
            $imagesToDelete = array_filter($imagesToDelete); // Enlever les valeurs vides
            
            
            
            foreach ($imagesToDelete as $imageToDelete) {
                $imageToDelete = trim($imageToDelete); // Nettoyer l'URL
                
                
                if (Storage::disk('public')->exists($imageToDelete)) {
                    Storage::disk('public')->delete($imageToDelete);
                    \Log::info('Image deleted successfully: ' . $imageToDelete);
                } else {
                    \Log::warning('Image not found: ' . $imageToDelete);
                }
                
                // Retirer de la liste des images actuelles
                $key = array_search($imageToDelete, $currentImages);
                if ($key !== false) {
                    unset($currentImages[$key]);
                }
            }
            // Réindexer le tableau
            $currentImages = array_values($currentImages);
        }
        
        // Ajouter les nouvelles images
        if ($request->hasFile('additional_images')) {
            $newImages = $request->file('additional_images');
            $imagesToProcess = array_slice($newImages, 0, 5);
            
            // Vérifier le nombre total après ajout
            if ((count($currentImages) + count($imagesToProcess)) > 5) {
                return redirect()->back()
                    ->withErrors(['additional_images' => 'Vous ne pouvez pas avoir plus de 5 images supplémentaires au total.'])
                    ->withInput();
            }
            
            foreach ($imagesToProcess as $index => $image) {
                $imageName = time() . '_' . ($index + 1) . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('RealisationsPhoto/Additional', $imageName, 'public');
                $currentImages[] = $imagePath;
                
            }
        }
        
        // Sauvegarder les images supplémentaires
        $reals->additional_images = $currentImages;
        $reals->save();
        
        

        return redirect()->route('realisations.index')
            ->with('success', 'Réalisation modifiée avec succès. ' . count($imagesToDelete ?? []) . ' image(s) supprimée(s), ' . count($newImages ?? []) . ' nouvelle(s) image(s) ajoutée(s).');
    }

    public function destroy(Realisation $reals)
    {
        // Supprimer l'image principale
        if ($reals->image && Storage::disk('public')->exists($reals->image)) {
            Storage::disk('public')->delete($reals->image);
        }

        // Supprimer les images supplémentaires
        $additionalImages = $reals->additional_images;
        if (is_array($additionalImages) && count($additionalImages) > 0) {
            foreach ($additionalImages as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        // Supprimer la réalisation
        $reals->delete();

        return redirect()->route('realisations.index')
            ->with('success', 'Réalisation supprimée avec succès.');
    }
}