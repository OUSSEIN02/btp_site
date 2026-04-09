@extends('layouts.admin')

@section('title', 'Gestion des Actualités')

@section('content')

<div class="flex justify-center mb-6 px-4 sm:px-0">
  <h1 class="text-3xl text-center satisfy font-bold text-[#1a3a8f] mb-3 md:mb-0">
    📰 Nos Réalisations
  </h1>
</div>


<div class="hidden lg:block bg-white shadow-lg rounded-xl border border-yellow-300 overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-[#1a3a8f] text-white font-bold uppercase text-sm">
                <th class="py-3 px-4">#</th>
                <th class="py-3 px-4">Image</th>
                <th class="py-3 px-4">Titre</th>
                <th class="py-3 px-4">Contenu</th>
                <th class="py-3 px-4 text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($reals  as $actu)
            <tr class="hover:bg-yellow-50 transition align-top">
                <td class="py-4 px-4 font-semibold text-gray-800">
                    {{ $loop->iteration }}
                </td>

                <td class="py-4 px-4">
                    <img src="{{ asset('storage/' . $actu->image) }}" 
                         class="w-20 h-14 rounded-lg object-cover shadow">
                </td>

                <td class="py-4 px-4 font-semibold text-gray-800 max-w-xs">
                    {{ Str::limit($actu->title, 40) }}
                </td>

                <td class="py-4 px-4 max-w-lg">
                    <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($actu->content), 120) }}
                    </p>
                </td>

                <td class="py-4 px-4 text-center">
                    <div class="flex justify-center gap-2">
                        <button
                            onclick="openViewActuModal(
                                '{{ $actu->title }}',
                                `{{ Str::limit(strip_tags($actu->content), 120) }}`,
                                '{{ asset('storage/' . $actu->image) }}'
                            )"
                            class="bg-blue-500 text-white px-3 py-1.5 text-xs rounded-lg shadow hover:bg-blue-600 flex items-center gap-1">
                            👁 Voir
                        </button>

                        <a href="{{ route('realisations.edit', $actu->id) }}"
                           class="bg-[#1a3a8f] text-white px-3 py-1.5 text-xs rounded-lg font-medium shadow  flex items-center gap-1">
                            ✏️ Modifier
                        </a>

                        <button
                            onclick="openDeleteModal({{ $actu->id }})"
                            class="bg-red-500 text-white px-3 py-1.5 text-xs rounded-lg font-medium shadow hover:bg-red-600 flex items-center gap-1">
                            🗑 Supprimer
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-8 text-gray-500">
                    Aucune actualité publiée
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="lg:hidden space-y-4 px-4 sm:px-0">
    @forelse ($reals  as $actu)
    <div class="bg-white p-4 rounded-xl shadow-lg border-l-4 border-[#1a3a8f] hover:shadow-xl transition">
        <div class="flex items-start gap-4 mb-3">
            <img src="{{ asset('storage/' . $actu->image) }}" 
                 class="w-20 h-14 rounded-lg object-cover shadow flex-shrink-0">
            
            <div class="flex-grow min-w-0">
                <span class="text-xs font-light text-gray-500 block mb-1">#{{ $loop->iteration }}</span>
                <h3 class="font-bold text-lg text-blue-700 truncate">
                    {{ $actu->title }}
                </h3>
            </div>
        </div>

        <div class="mb-4 pt-2 border-t border-gray-100">
             <p class="text-gray-700 text-sm leading-snug line-clamp-3">
                {{ Str::limit(strip_tags($actu->content), 150) }}
            </p>
        </div>

        <div class="flex justify-center flex-wrap gap-2 mt-4">
            <button
                onclick="openViewActuModal(
                    '{{ $actu->title }}',
                    `{{ Str::limit(strip_tags($actu->content), 120) }}`,
                    '{{ asset('storage/' . $actu->image) }}'
                )"
                class="flex-1 min-w-[100px] bg-blue-500 text-white px-3 py-2 text-sm rounded-lg shadow hover:bg-blue-600 flex items-center justify-center gap-1">
                👁 Voir
            </button>

            <a href="{{ route('realisations.edit', $actu->id) }}"
               class="flex-1 min-w-[100px] bg-[#1a3a8f] text-white px-3 py-2 text-sm rounded-lg font-medium shadow flex items-center justify-center gap-1">
                ✏️ Modifier
            </a>

            <button
                onclick="openDeleteModal({{ $actu->id }})"
                class="flex-1 min-w-[100px] bg-red-500 text-white px-3 py-2 text-sm rounded-lg font-medium shadow hover:bg-red-600 flex items-center justify-center gap-1">
                🗑 Supprimer
            </button>
        </div>
    </div>
    @empty
    <div class="bg-white p-8 rounded-xl shadow-lg border border-yellow-300 text-center text-gray-500">
        Aucune actualité publiée
    </div>
    @endforelse
</div>


<div id="deleteModal"
     class="fixed inset-0 bg-[#00000088] flex items-center justify-center z-50 hidden">

    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl border-2 border-blue-400">

        <div class="flex justify-center mb-4">
            <div class="text-6xl animate-bounce">⚠️</div>
        </div>

        <h2 class="text-2xl font-bold text-blue-700 text-center">
            Confirmation requise
        </h2>

        <p class="text-center text-gray-700 mt-2 mb-6">
            Voulez-vous vraiment supprimer cette actualité ?
        </p>

        <form id="deleteForm" method="POST" class="flex justify-center gap-4">
            @csrf
            @method('DELETE')

            <button
                class="px-5 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 transition">
                Oui
            </button>

            <button type="button" onclick="closeDeleteModal()"
                class="px-5 py-2 bg-[#1a3a8f] text-white font-semibold rounded-lg shadow  transition">
                Annuler
            </button>
        </form>
    </div>
</div>

<div id="viewActuModal"
     class="fixed inset-0 bg-[#0000008] flex items-center justify-center z-50 hidden">

    <div class="bg-white w-full max-w-2xl rounded-2xl p-6 shadow-xl border-2 border-blue-400 animate-[fade_0.3s_ease]">

        <div class="flex justify-center mb-4">
            <img id="viewActuImage"
                 class="w-full max-h-64 object-cover rounded-xl shadow border-4 border-blue-400">
        </div>

        <h2 id="viewActuTitre"
            class="text-2xl font-bold text-blue-700 text-center mb-3">
        </h2>

        <p id="viewActuContenu"
           class="text-gray-700 leading-relaxed text-justify max-h-60 overflow-y-auto px-2">
        </p>

        <div class="flex justify-center mt-6">
            <button onclick="closeViewActuModal()"
                class="px-6 py-2 bg-[#1a3a8f] text-white font-semibold rounded-lg shadow  transition">
                Fermer
            </button>
        </div>
    </div>
</div>


<script>
    function openDeleteModal(id) {
        const modal = document.getElementById('deleteModal');
        const form  = document.getElementById('deleteForm');

        form.action = "/admin/realisations/" + id;
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    function openViewActuModal(titre, contenu, image) {
        document.getElementById('viewActuTitre').innerText = titre;
        document.getElementById('viewActuContenu').innerText = contenu;
        document.getElementById('viewActuImage').src = image;

        document.getElementById('viewActuModal').classList.remove('hidden');
    }

    function closeViewActuModal() {
        document.getElementById('viewActuModal').classList.add('hidden');
    }
</script>

@endsection