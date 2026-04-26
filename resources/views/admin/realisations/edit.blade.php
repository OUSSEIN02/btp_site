@extends('layouts.admin')

@section('title', 'Modifier une réalisation')

@section('content')

<h1 class="text-2xl lg:text-3xl font-bold satisfy text-blue-700 mb-6 px-4 lg:px-0">
    ✏️ Modifier une réalisation
</h1>

<div class="bg-white shadow rounded-lg p-4 sm:p-6 mx-4 lg:mx-0">

    {{-- Erreurs --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg border border-red-300">
            <ul class="list-disc ml-4 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('realisations.update', $reals->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="realisationForm">
        @csrf
        @method('PUT')

        {{-- Titre --}}
        <div> 
            <label class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base">Titre *</label>
            <input 
                type="text" 
                name="title"
                value="{{ old('title', $reals->title) }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 
                    focus:bg-white focus:ring-2 focus:ring-[#1a3a8f] focus:border-[#1a3a8f] transition shadow-sm"
                placeholder="Titre de l'article"
                aria-label="Titre de l'actualité" required>
        </div>

        {{-- Contenu --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2 text-sm sm:text-base">Contenu *</label>
            <textarea id="editor" name="content" rows="6"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                    focus:bg-white focus:ring-2 focus:ring-[#1a3a8f] focus:border-[#1a3a8f] transition shadow-sm"
                placeholder="Écrivez le contenu détaillé de l'actualité...">{{ old('content' , $reals->content) }}</textarea>
        </div>

        {{-- Image + Prévisualisation --}}
        <div x-data="{
                preview: '{{ $reals->image ? asset('storage/'.$reals->image) : '' }}',
                tempUrl: null
            }"
            x-cloak
        >
            <label class="block font-semibold text-gray-700 mb-3 text-sm sm:text-base">
                Image principale (Laisser vide pour garder l'image actuelle)
            </label>

            <input
                type="file"
                name="image"
                accept="image/*"
                @change="
                    const file = $event.target.files[0];
                    if (!file) {
                        if (tempUrl) URL.revokeObjectURL(tempUrl);
                        preview = '{{ $reals->image ? asset('storage/'.$reals->image) : '' }}';
                        return;
                    }

                    if (tempUrl) URL.revokeObjectURL(tempUrl);
                    tempUrl = URL.createObjectURL(file);
                    preview = tempUrl;
                "
                class="w-full text-gray-700 text-sm file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100
                    border border-gray-300 rounded-xl p-3 shadow-sm"
                aria-label="Sélectionner une nouvelle image"
            >

            <div class="mt-4">
                <template x-if="preview">
                    <img :src="preview"
                        class="w-24 h-24 sm:w-32 sm:h-32 rounded-lg shadow-md object-cover border-2 border-[#1a3a8f] transition hover:shadow-xl"
                        alt="Prévisualisation image actuelle ou nouvelle">
                </template>

                <template x-if="!preview">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 text-xs sm:text-sm border border-dashed border-gray-300">
                        Pas d'image
                    </div>
                </template>
            </div>
        </div>

        {{-- Images supplémentaires --}}
        <div class="pt-4">
            <label class="block font-semibold text-gray-700 mb-3 text-sm sm:text-base">
                Images supplémentaires (max 5)
            </label>

            <input 
                type="file" 
                name="additional_images[]" 
                id="multipleImages"
                accept="image/*"
                multiple
                class="w-full text-gray-700 text-sm file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100
                    border border-gray-300 rounded-xl p-3 shadow-sm"
            >

            <p class="text-xs text-gray-500 mt-2">
                Vous pouvez sélectionner jusqu'à 5 nouvelles images (JPEG, PNG, GIF). Les anciennes images seront conservées sauf si vous les supprimez manuellement.
            </p>

            <!-- Container des images existantes -->
            <div id="existingImagesContainer" class="mt-6">
                <h4 class="font-semibold text-gray-700 mb-3 text-sm">Images actuelles :</h4>
                <div id="existingImages" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                    @php
                        $additionalImages = is_string($reals->additional_images) 
                            ? json_decode($reals->additional_images, true) 
                            : $reals->additional_images;
                    @endphp
                    
                    @if(!empty($additionalImages) && is_array($additionalImages))
                        @foreach($additionalImages as $index => $image)
                            @if($image && Illuminate\Support\Facades\Storage::disk('public')->exists($image))
                                <div class="relative group existing-image" data-image="{{ $image }}">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         alt="Image {{ $index + 1 }}"
                                         class="w-full h-28 sm:h-32 object-cover rounded-lg shadow-md border-2 border-gray-200">
                                    <button type="button" 
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-lg font-bold hover:bg-red-600 transition shadow-md opacity-0 group-hover:opacity-100"
                                            onclick="markImageForDeletion(this, '{{ $image }}')">
                                        ✕
                                    </button>
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-span-full text-center text-gray-400 text-sm py-4">
                            Aucune image supplémentaire
                        </div>
                    @endif
                </div>
            </div>

            <!-- Container des nouvelles miniatures -->
            <div id="multiplePreview" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mt-4">
            </div>
        </div>

        {{-- Input caché pour les images à supprimer --}}
        <input type="hidden" name="delete_additional_images" id="deleteAdditionalImages" value="">

        {{-- Boutons --}}
        <div class="flex justify-between pt-4 border-t border-gray-200">
            <a href="{{route('realisations.index')}}" 
                class="px-5 py-2.5 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition shadow-sm text-sm sm:text-base flex items-center gap-2">
                <i class="fa-solid fa-xmark"></i> Annuler
            </a>
            
            <button 
                type="submit" 
                class="bg-[#1a3a8f] text-white px-6 py-2.5 rounded-xl font-semibold text-sm sm:text-base shadow-md
                      transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Modifier
            </button>
        </div>

    </form>

</div>

<script>
// Variable globale pour stocker les images à supprimer
window.imagesToDelete = [];

document.addEventListener('DOMContentLoaded', function() {
    // ========== IMAGES SUPPLÉMENTAIRES - GESTION ==========
    const multipleInput = document.getElementById('multipleImages');
    const previewContainer = document.getElementById('multiplePreview');
    
    // Stocker tous les nouveaux fichiers sélectionnés
    let newSelectedFiles = [];

    // Fonction pour mettre à jour l'input caché
    function updateDeleteInput() {
        const deleteInput = document.getElementById('deleteAdditionalImages');
        if (deleteInput) {
            deleteInput.value = window.imagesToDelete.join(',');
            console.log('Images à supprimer:', window.imagesToDelete);
        }
    }

    // Fonction pour mettre à jour l'affichage des nouvelles miniatures
    function updateNewPreviews() {
        if (!previewContainer) return;
        
        previewContainer.innerHTML = '';
        
        if (newSelectedFiles.length === 0) {
            previewContainer.classList.add('hidden');
            return;
        }
        
        previewContainer.classList.remove('hidden');
        
        // Créer les miniatures pour tous les nouveaux fichiers
        newSelectedFiles.forEach((file, index) => {
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'relative group';
            
            const img = document.createElement('img');
            img.className = 'w-full h-28 sm:h-32 object-cover rounded-lg shadow-md border-2 border-green-500';
            img.alt = `Nouvelle image ${index + 1}`;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
            
            const badge = document.createElement('div');
            badge.className = 'absolute top-2 left-2 bg-green-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center';
            badge.textContent = index + 1;
            
            const removeBtn = document.createElement('button');
            removeBtn.innerHTML = '✕';
            removeBtn.type = 'button';
            removeBtn.className = 'absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-lg font-bold hover:bg-red-600 transition shadow-md opacity-0 group-hover:opacity-100';
            removeBtn.title = 'Supprimer cette image';
            
            removeBtn.addEventListener('click', function() {
                // Supprimer le fichier du tableau
                newSelectedFiles.splice(index, 1);
                // Mettre à jour l'input file
                updateFileInput();
                // Rafraîchir l'affichage
                updateNewPreviews();
            });
            
            previewWrapper.appendChild(img);
            previewWrapper.appendChild(badge);
            previewWrapper.appendChild(removeBtn);
            previewContainer.appendChild(previewWrapper);
        });
    }
    
    // Fonction pour mettre à jour l'input file avec les nouveaux fichiers
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        newSelectedFiles.forEach(file => dataTransfer.items.add(file));
        multipleInput.files = dataTransfer.files;
    }
    
    // Gérer l'ajout de nouveaux fichiers
    if (multipleInput) {
        multipleInput.addEventListener('change', function(event) {
            const newFiles = Array.from(event.target.files);
            
            // Ajouter les nouveaux fichiers à la collection existante
            for (let file of newFiles) {
                // Vérifier le type
                if (!file.type.startsWith('image/')) {
                    alert(`Le fichier "${file.name}" n'est pas une image valide.`);
                    continue;
                }
                
                // Vérifier la taille (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    alert(`L'image "${file.name}" dépasse 2MB.`);
                    continue;
                }
                
                // Vérifier le nombre total (images existantes non supprimées + nouvelles)
                const existingCount = document.querySelectorAll('#existingImages .existing-image:not(.marked-for-deletion)').length;
                if ((newSelectedFiles.length + existingCount) >= 5) {
                    alert('Vous ne pouvez pas avoir plus de 5 images au total. Supprimez des images existantes ou annulez l\'ajout.');
                    break;
                }
                
                newSelectedFiles.push(file);
            }
            
            // Mettre à jour l'input file
            updateFileInput();
            
            // Rafraîchir l'affichage
            updateNewPreviews();
            
            // Reset l'input pour permettre de sélectionner à nouveau
            multipleInput.value = '';
        });
    }
    
    // Initialiser l'affichage
    updateNewPreviews();
    
    // Initialiser window.imagesToDelete avec les valeurs existantes si nécessaire
    const deleteInput = document.getElementById('deleteAdditionalImages');
    if (deleteInput && deleteInput.value) {
        window.imagesToDelete = deleteInput.value.split(',').filter(path => path !== '');
    }
    
    // ========== VALIDATION AVANT SOUMISSION ==========
    const form = document.getElementById('realisationForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Mettre à jour l'input caché avec les images à supprimer
            updateDeleteInput();
            
            // Vérifier le nombre total d'images (existantes non supprimées + nouvelles)
            const existingImagesCount = document.querySelectorAll('#existingImages .existing-image:not(.marked-for-deletion)').length;
            const totalImages = existingImagesCount + newSelectedFiles.length;
            
            console.log('=== SOUMISSION FORMULAIRE ===');
            console.log('Total images:', totalImages);
            console.log('Images existantes non supprimées:', existingImagesCount);
            console.log('Nouvelles images:', newSelectedFiles.length);
            console.log('Images à supprimer:', window.imagesToDelete);
            console.log('Input value:', document.getElementById('deleteAdditionalImages').value);
            
            if (totalImages > 5) {
                e.preventDefault();
                alert('Vous ne pouvez pas avoir plus de 5 images supplémentaires au total.');
                return;
            }
        });
    }
});

// Fonction globale pour marquer une image à supprimer
function markImageForDeletion(button, imagePath) {
    const imageDiv = button.closest('.existing-image');
    
    if (imageDiv.classList.contains('marked-for-deletion')) {
        // Annuler la suppression
        imageDiv.classList.remove('marked-for-deletion');
        imageDiv.style.opacity = '1';
        const img = imageDiv.querySelector('img');
        if (img) img.classList.remove('opacity-50');
        button.innerHTML = '✕';
        button.classList.remove('bg-gray-500');
        button.classList.add('bg-red-500');
        button.title = 'Supprimer cette image';
        
        // Retirer de la liste des images à supprimer
        const index = window.imagesToDelete.indexOf(imagePath);
        if (index > -1) {
            window.imagesToDelete.splice(index, 1);
        }
    } else {
        // Marquer pour suppression
        imageDiv.classList.add('marked-for-deletion');
        imageDiv.style.opacity = '0.5';
        const img = imageDiv.querySelector('img');
        if (img) img.classList.add('opacity-50');
        button.innerHTML = '↺';
        button.classList.remove('bg-red-500');
        button.classList.add('bg-gray-500');
        button.title = 'Annuler la suppression';
        
        // Ajouter à la liste des images à supprimer
        if (!window.imagesToDelete.includes(imagePath)) {
            window.imagesToDelete.push(imagePath);
        }
    }
    
    // Mettre à jour l'input caché
    const deleteInput = document.getElementById('deleteAdditionalImages');
    if (deleteInput) {
        deleteInput.value = window.imagesToDelete.join(',');
        console.log('Images à supprimer mises à jour:', deleteInput.value);
        console.log('Tableau imagesToDelete:', window.imagesToDelete);
    }
}
</script>

<style>
    .group:hover .group-hover\:opacity-100 {
        opacity: 1;
    }
    
    #multiplePreview .relative,
    #existingImages .relative {
        transition: transform 0.2s ease;
    }
    
    #multiplePreview .relative:hover,
    #existingImages .relative:hover {
        transform: translateY(-2px);
    }
    
    .marked-for-deletion {
        position: relative;
    }
    
    .marked-for-deletion::after {
        content: 'À supprimer';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
        white-space: nowrap;
        z-index: 10;
        pointer-events: none;
    }
</style>

@endsection