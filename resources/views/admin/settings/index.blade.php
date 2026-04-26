@extends('layouts.admin')

@section('title', 'Gestion Entreprise')

@section('content')

<div class="px-3 sm:px-6 pb-20">

    <h1 class="text-2xl sm:text-3xl satisfy font-bold text-blue-700 mb-6">
        ⚙️ Gestion du site
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Onglets --}}
    <div class="overflow-x-auto mb-6">
        <div class="flex gap-2 min-w-max">

            <button onclick="showTab(event,'about')" 
            class="tab-btn whitespace-nowrap px-4 py-2.5 text-sm rounded-xl font-medium transition bg-blue-600 text-white">
                🏢 Qui sommes-nous ?
            </button>

            <button onclick="showTab(event,'services')" 
                class="tab-btn whitespace-nowrap px-4 py-2.5 text-sm rounded-xl font-medium transition bg-gray-200 text-gray-700">
                🛠 Nos prestations
            </button>

            <button onclick="showTab(event,'contact')" 
                class="tab-btn whitespace-nowrap px-4 py-2.5 text-sm rounded-xl font-medium transition bg-gray-200 text-gray-700">
                📞 Contact
            </button>

        </div>
    </div>

    {{-- ABOUT --}}
    <div id="about" class="tab-content">
        <form method="POST" action="{{ route('admin.settings.update.about') }}">
            @csrf
            @method('PUT')

            <textarea name="about" id="aboutEditor">
                {{ old('about', $setting->about ?? '') }}
            </textarea>

            <div class="mt-4">
                <button class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                    💾 Enregistrer
                </button>
            </div>
        </form>
    </div>

    {{-- SERVICES --}}
    <div id="services" class="tab-content hidden">

        <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">
            + Ajouter un service
        </button>

        <table class="w-full text-sm text-left text-gray-600" style="border: 3px solid #e5e7eb;">

            <!-- HEADER -->
            <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Titre</th>
                    <th class="px-6 py-4 hidden md:table-cell">Description</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

                @foreach($services as $service)
                <tr class="hover:bg-blue-50 transition duration-200">

                    <!-- TITRE -->
                    <td class="px-6 py-4 font-semibold text-gray-800">
                        {{ $service->title }}
                        
                        <!-- Description affichée sous le titre en mobile -->
                        <p class="text-xs text-gray-500 mt-1 md:hidden">
                            {{ Str::limit($service->description, 80) }}
                        </p>
                    </td>

                    <!-- DESCRIPTION (desktop uniquement) -->
                    <td class="px-6 py-4 text-gray-500 hidden md:table-cell">
                        {{ Str::limit($service->description, 120) }}
                    </td>

                    <!-- ACTIONS -->
                    <td class="px-6 py-4 text-center">

                        <!-- FORM DELETE -->
                        <form id="delete-form-{{ $service->id }}" 
                            action="{{ route('admin.services.destroy', $service->id) }}" 
                            method="POST">
                            @csrf
                            @method('DELETE')
                        </form>

                        <!-- BUTTON DELETE -->
                        <button type="button"
                            onclick="confirmDelete({{ $service->id }})"
                            class="inline-flex items-center gap-1 px-4 py-2 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 hover:text-red-700 transition duration-200">
                            
                            🗑 Supprimer
                        </button>

                    </td>
                </tr>
                @endforeach

            </tbody>
            </table>

        {{-- MODAL AJOUT --}}
        <div id="serviceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="bg-white rounded p-6 w-96">
                <h3 class="text-xl font-bold mb-4">Ajouter un service</h3>

                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Titre</label>
                        <input type="text" name="title" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Description</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL CONFIRMATION --}}
        <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">

            {{-- CLICK OUTSIDE --}}
            <div class="absolute inset-0" onclick="closeConfirmModal()"></div>

            <div class="bg-white rounded p-6 w-96 relative z-10">
                <h3 class="text-xl font-bold mb-4 text-red-600">⚠️ Confirmation</h3>

                <p class="mb-6 text-sm">
                    Êtes-vous sûr de vouloir supprimer ce service ?
                </p>

                <div class="flex justify-end gap-3">
                    <button onclick="closeConfirmModal()" 
                        class="px-4 py-2 border rounded">
                        Annuler
                    </button>

                    <button onclick="submitDelete()" 
                        class="px-4 py-2 bg-red-600 text-white rounded">
                        Oui, supprimer
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{-- CONTACT --}}
    <div id="contact" class="tab-content hidden">
        <form method="POST" action="{{ route('admin.settings.update.contact') }}">
            @csrf
            @method('PUT')

            <div class="grid gap-4 max-w-lg">

                <div>
                    <label>Téléphone</label>
                    <input type="text" name="phone"
                        value="{{ old('phone', $setting->phone ?? '') }}"
                        class="w-full border rounded px-3 py-2 mt-1">
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $setting->email ?? '') }}"
                        class="w-full border rounded px-3 py-2 mt-1">
                </div>

                <div>
                    <label>Adresse</label>
                    <input type="text" name="address"
                        value="{{ old('address', $setting->address ?? '') }}"
                        class="w-full border rounded px-3 py-2 mt-1">
                </div>

            </div>

            <div class="mt-4">
                <button class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                    💾 Enregistrer
                </button>
            </div>
        </form>
    </div>

</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    CKEDITOR.replace('aboutEditor', {
        height: window.innerWidth < 640 ? 250 : 350,
    });
});

// Onglets
function showTab(event, tab) {

// cacher les contenus
document.querySelectorAll('.tab-content').forEach(el => {
    el.classList.add('hidden');
});

document.getElementById(tab).classList.remove('hidden');

// reset boutons
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.classList.remove('bg-blue-600', 'text-white');
    btn.classList.add('bg-gray-200', 'text-gray-700');
});

// activer bouton cliqué
event.currentTarget.classList.remove('bg-gray-200', 'text-gray-700');
event.currentTarget.classList.add('bg-blue-600', 'text-white');
}

// Modal ajout
function openModal() {
    document.getElementById('serviceModal').classList.remove('hidden');
    document.getElementById('serviceModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('serviceModal').classList.add('hidden');
    document.getElementById('serviceModal').classList.remove('flex');
}

// SUPPRESSION
let deleteFormId = null;

function confirmDelete(id) {
    deleteFormId = "delete-form-" + id;
    document.getElementById('confirmModal').classList.remove('hidden');
    document.getElementById('confirmModal').classList.add('flex');
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    document.getElementById('confirmModal').classList.remove('flex');
}

function submitDelete() {
    if (deleteFormId) {
        document.getElementById(deleteFormId).submit();
    }
}
</script>

@endsection