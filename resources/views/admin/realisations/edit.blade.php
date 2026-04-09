@extends('layouts.admin')

@section('title', 'Modifer une réalisation')

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

    <form action="{{ route('realisations.update', $reals->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

        {{-- Image + Prévisualisation (Alpine.js pour gérer l'URL) --}}
        <div x-data="{
                preview: '{{ $reals->image ? asset('storage/'.$reals->image) : '' }}',
                tempUrl: null
            }"
            x-cloak
        >
            <label class="block font-semibold text-gray-700 mb-3 text-sm sm:text-base">
                Image de couverture (Laisser vide pour garder l'image actuelle)
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
                        {{-- Style de bordure mis à jour --}}
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


        {{-- Boutons --}}
        <div class="flex justify-between pt-4 border-t border-gray-200">
            {{-- Bouton Annuler (Style neutre) --}}
            <a href="{{route('realisations.index')}}" 
                class="px-5 py-2.5 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition shadow-sm text-sm sm:text-base flex items-center gap-2">
                <i class="fa-solid fa-xmark"></i> Annuler
            </a>
            
            {{-- Bouton Modifier (Style de couleur principal) --}}
            <button 
                type="submit" 
                class="bg-[#1a3a8f] text-white px-6 py-2.5 rounded-xl font-semibold text-sm sm:text-base shadow-md
                      transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Modifier
            </button>
        </div>

    </form>

</div>

@endsection