@extends('layouts.admin')

@section('title', 'Publier une actualité')

@section('content')

<h1 class="text-2xl lg:text-3xl satisfy font-bold text-blue-700 mb-6 px-4 lg:px-0">
    ✨ Publier une actualité
</h1>

<div class="bg-white shadow rounded-lg p-4 sm:p-6 mx-4 lg:mx-0">

    {{-- Erreurs (Optimisé pour être plus compact sur mobile) --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg border border-red-300">
            <ul class="list-disc ml-4 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('realisations.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Titre --}}
        <div> 
            <label class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base">Titre *</label>
            <input 
                type="text" 
                name="title"
                value="{{ old('title') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 
                    focus:bg-white focus:ring-2 focus:ring-[#1a3a8f] focus:border-[#1a3a8f] transition shadow-sm"
                placeholder="Titre de l'article"
                aria-label="Titre de l'actualité" required>
            {{-- Vous pouvez ajouter ici la gestion des erreurs Laravel : @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror --}}
        </div>

        {{-- Contenu --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2 text-sm sm:text-base">Contenu *</label>
            <textarea id="editor" name="content" rows="6"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                    focus:bg-white focus:ring-2 focus:ring-[#1a3a8f] focus:border-[#1a3a8f] transition shadow-sm"
                placeholder="Écrivez le contenu détaillé de l'actualité...">{{ old('content') }}</textarea>
            {{-- Vous pouvez ajouter ici la gestion des erreurs Laravel : @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror --}}
        </div>

        {{-- Image + Prévisualisation --}}
        <div class="pt-2">
            <label class="block font-semibold text-gray-700 mb-3 text-sm sm:text-base">Image de couverture</label>

            <input type="file" name="image" id="imageInput" accept="image/*"
                class="w-full text-gray-700 text-sm file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100
                    border border-gray-300 rounded-xl p-3 shadow-sm"
                aria-label="Sélectionner une image">

            <p class="text-xs text-gray-500 mt-2">Format recommandé : paysage (ratio 16:9 ou 4:3)</p>

            <img id="preview" 
                class="mt-4 w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg shadow-md border-2 border-[#1a3a8f] hidden" 
                alt="Prévisualisation de l'image">
        </div>

        {{-- Boutons --}}
        <div class="flex justify-between pt-4 border-t border-gray-200">
            {{-- Bouton Annuler (Gardé dans un style neutre) --}}
            <a href="{{ route('realisations.index')}}" 
                class="px-5 py-2.5 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition shadow-sm text-sm sm:text-base flex items-center gap-2">
                <i class="fa-solid fa-xmark"></i> Annuler
            </a>
            
            {{-- Bouton Publier (Stylisé avec la couleur principale) --}}
            <button 
                type="submit" 
                class="bg-[#1a3a8f] text-white px-6 py-2.5 rounded-xl font-semibold text-sm sm:text-base shadow-md
                     hover:shadow-lg transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-paper-plane"></i> Publier
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');

        // Gérer la prévisualisation de l'image
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden'); // Afficher l'aperçu
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden'); // Masquer s'il n'y a pas de fichier
            }
        });
        
        // Assurez-vous que l'image est masquée au chargement si elle est vide (cas de création)
        if (!imageInput.value) {
             preview.classList.add('hidden');
        }
    });

    // NOTE: Si vous utilisez un éditeur WYSIWYG comme TinyMCE pour 'editor',
    // vous devez vous assurer que son initialisation est également dans un bloc script.
</script>

@endsection