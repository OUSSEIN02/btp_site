@extends('layouts.admin')

@section('title', 'Ajouter une réalisation')

@section('content')

<h1 class="text-2xl lg:text-3xl satisfy font-bold text-blue-700 mb-6 px-4 lg:px-0">
    ✨ Ajouter une nouvelle réalisation
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

    <form action="{{ route('realisations.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6" id="realisationForm">
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
                required>
        </div>

        {{-- Contenu --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2 text-sm sm:text-base">Contenu *</label>
            <textarea id="editor" name="content" rows="6"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                    focus:bg-white focus:ring-2 focus:ring-[#1a3a8f] focus:border-[#1a3a8f] transition shadow-sm"
                placeholder="Écrivez le contenu détaillé...">{{ old('content') }}</textarea>
        </div>

        {{-- Image principale --}}
        <div class="pt-2">
            <label class="block font-semibold text-gray-700 mb-3 text-sm sm:text-base">Image principale *</label>
            <input type="file" name="image" id="imageInput" accept="image/*"
                class="w-full text-gray-700 text-sm file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100
                    border border-gray-300 rounded-xl p-3 shadow-sm"
                required>
            
            <img id="preview" 
                class="mt-4 w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg shadow-md border-2 border-[#1a3a8f] hidden" 
                alt="Prévisualisation">
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
                Vous pouvez sélectionner jusqu'à 5 images (JPEG, PNG, GIF)
            </p>

            <!-- Container des miniatures -->
            <div id="multiplePreview" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mt-4">
            </div>
        </div>

        {{-- Boutons --}}
        <div class="flex justify-between pt-4 border-t border-gray-200">
            <a href="{{ route('realisations.index')}}" 
                class="px-5 py-2.5 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition shadow-sm text-sm sm:text-base flex items-center gap-2">
                <i class="fa-solid fa-xmark"></i> Annuler
            </a>
            
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
    // ========== IMAGE PRINCIPALE ==========
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Veuillez sélectionner un fichier image valide.');
                this.value = '';
                preview.classList.add('hidden');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('hidden'); 
        }
    });
    
    // ========== IMAGES SUPPLÉMENTAIRES - SOLUTION CORRIGÉE ==========
    const multipleInput = document.getElementById('multipleImages');
    const previewContainer = document.getElementById('multiplePreview');
    
    // Stocker tous les fichiers sélectionnés
    let allSelectedFiles = [];

    // Fonction pour mettre à jour l'affichage des miniatures
    function updatePreviews() {
        previewContainer.innerHTML = '';
        
        if (allSelectedFiles.length === 0) {
            const emptyMessage = document.createElement('div');
            emptyMessage.className = 'col-span-full text-center text-gray-400 text-sm py-4';
            emptyMessage.textContent = 'Aucune image sélectionnée';
            previewContainer.appendChild(emptyMessage);
            return;
        }
        
        // Créer les miniatures pour tous les fichiers
        allSelectedFiles.forEach((file, index) => {
            const previewWrapper = document.createElement('div');
            previewWrapper.className = 'relative group';
            
            const img = document.createElement('img');
            img.className = 'w-full h-28 sm:h-32 object-cover rounded-lg shadow-md border-2 border-gray-200 group-hover:border-red-400 transition';
            img.alt = `Image ${index + 1}`;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
            
            const badge = document.createElement('div');
            badge.className = 'absolute top-2 left-2 bg-black bg-opacity-60 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center';
            badge.textContent = index + 1;
            
            const removeBtn = document.createElement('button');
            removeBtn.innerHTML = '✕';
            removeBtn.type = 'button';
            removeBtn.className = 'absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-lg font-bold hover:bg-red-600 transition shadow-md opacity-0 group-hover:opacity-100';
            removeBtn.title = 'Supprimer cette image';
            
            removeBtn.addEventListener('click', function() {
                // Supprimer le fichier du tableau
                allSelectedFiles.splice(index, 1);
                // Mettre à jour l'input file
                updateFileInput();
                // Rafraîchir l'affichage
                updatePreviews();
            });
            
            previewWrapper.appendChild(img);
            previewWrapper.appendChild(badge);
            previewWrapper.appendChild(removeBtn);
            previewContainer.appendChild(previewWrapper);
        });
    }
    
    // Fonction pour mettre à jour l'input file avec tous les fichiers
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        allSelectedFiles.forEach(file => dataTransfer.items.add(file));
        multipleInput.files = dataTransfer.files;
        console.log(`Input file mis à jour: ${multipleInput.files.length} fichiers`);
        
        // Afficher les noms des fichiers pour déboguer
        for (let i = 0; i < multipleInput.files.length; i++) {
            console.log(`  - ${multipleInput.files[i].name}`);
        }
    }
    
    // Gérer l'ajout de nouveaux fichiers (SANS ÉCRASER)
    multipleInput.addEventListener('change', function(event) {
        const newFiles = Array.from(event.target.files);
        
        console.log('=== NOUVEAUX FICHIERS SÉLECTIONNÉS ===');
        console.log('Nouveaux fichiers sélectionnés:', newFiles.length);
        
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
            
            // Vérifier si on a déjà 5 images
            if (allSelectedFiles.length >= 5) {
                alert('Vous ne pouvez pas ajouter plus de 5 images. Supprimez-en d\'abord.');
                break;
            }
            
            // Vérifier si l'image n'est pas déjà présente
            const isDuplicate = allSelectedFiles.some(f => f.name === file.name && f.size === file.size && f.lastModified === file.lastModified);
            if (!isDuplicate) {
                allSelectedFiles.push(file);
                console.log(`✅ Ajouté: ${file.name}`);
            } else {
                console.log(`⚠️ Ignoré (doublon): ${file.name}`);
            }
        }
        
        // Mettre à jour l'input file
        updateFileInput();
        
        // Rafraîchir l'affichage
        updatePreviews();
        
        // Reset l'input pour permettre de sélectionner à nouveau
        multipleInput.value = '';
        
        console.log(`📊 Total des fichiers après ajout: ${allSelectedFiles.length}`);
        console.log('================================\n');
    });
    
    // Initialiser l'affichage
    updatePreviews();
    
    // ========== VALIDATION AVANT SOUMISSION ==========
    const form = document.getElementById('realisationForm');
    form.addEventListener('submit', function(e) {
        const mainImage = document.getElementById('imageInput');
        
        console.log('=== SOUMISSION DU FORMULAIRE ===');
        console.log('Image principale:', mainImage.files.length);
        console.log('Images supplémentaires dans le input:', multipleInput.files.length);
        console.log('Images supplémentaires dans le tableau:', allSelectedFiles.length);
        
        // Vérifier que l'input file contient bien les fichiers
        if (multipleInput.files.length !== allSelectedFiles.length) {
            console.error('⚠️ Incohérence détectée ! Mise à jour forcée...');
            updateFileInput();
        }
        
        // Afficher tous les fichiers qui seront envoyés
        console.log('📁 Fichiers à uploader:');
        for (let i = 0; i < multipleInput.files.length; i++) {
            console.log(`  ${i+1}. ${multipleInput.files[i].name} (${(multipleInput.files[i].size/1024).toFixed(2)} KB)`);
        }
        
        // Vérifier l'image principale
        if (!mainImage.files || mainImage.files.length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner une image de couverture.');
            return;
        }
        
        // Vérifier la taille de l'image principale
        if (mainImage.files[0].size > 2 * 1024 * 1024) {
            e.preventDefault();
            alert('L\'image de couverture ne doit pas dépasser 2MB.');
            return;
        }
        
        // Vérifier le nombre d'images supplémentaires
        if (allSelectedFiles.length > 5) {
            e.preventDefault();
            alert('Vous ne pouvez pas uploader plus de 5 images supplémentaires.');
            return;
        }
        
        console.log('✅ Formulaire validé, envoi en cours...');
    });
});
</script>

<style>
    .group:hover .group-hover\:opacity-100 {
        opacity: 1;
    }
    
    #multiplePreview .relative {
        transition: transform 0.2s ease;
    }
    
    #multiplePreview .relative:hover {
        transform: translateY(-2px);
    }
</style>

@endsection