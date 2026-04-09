@extends('layouts.admin')

@section('title', 'Paramètres - Vision Optique')
@section('header', 'Paramètres du site')

@section('content')
<div class="space-y-6">

    {{-- ================== MESSAGES FLASH ================== --}}
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
    </div>
    @endif


    {{-- ================== PROFIL ADMIN ================== --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-6">
            <i class="fas fa-user-cog text-brand mr-2"></i>
            Informations Administrateur
        </h2>

        <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Nom</label>
                    <input type="text" name="nom" value="{{ $admin->name }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:border-brand focus:ring-2 focus:ring-brand/20">
                </div>

               
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-600">Email</label>
                <input type="email" name="email" value="{{ $admin->email }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:border-brand focus:ring-2 focus:ring-brand/20">
            </div>

            <button type="submit"
                class="bg-brand text-white px-6 py-2.5 rounded-xl hover:bg-brand-dark transition-all shadow-md">
                <i class="fas fa-save mr-2"></i> Mettre à jour
            </button>
        </form>
    </div>


    {{-- ================== MOT DE PASSE ================== --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-6">
            <i class="fas fa-lock text-brand mr-2"></i>
            Changer le mot de passe
        </h2>

        <form action="{{ route('admin.settings.password') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Mot de passe actuel --}}
            <div>
                <label class="text-sm font-semibold text-gray-600">
                    Mot de passe actuel
                </label>
                <input type="password" name="current_password" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:border-brand focus:ring-2 focus:ring-brand/20">
            </div>

            {{-- Nouveau mot de passe --}}
            <div>
                <label class="text-sm font-semibold text-gray-600">
                    Nouveau mot de passe
                </label>
                <input type="password" name="password" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:border-brand focus:ring-2 focus:ring-brand/20">
            </div>

            {{-- Confirmation --}}
            <div>
                <label class="text-sm font-semibold text-gray-600">
                    Confirmer le mot de passe
                </label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:border-brand focus:ring-2 focus:ring-brand/20">
            </div>

            <button type="submit"
                class="bg-brand text-white px-6 py-2.5 rounded-xl hover:bg-brand-dark transition-all shadow-md">
                <i class="fas fa-key mr-2"></i> Modifier le mot de passe
            </button>
        </form>
    </div>


    {{-- ================== INFOS CONTACT SITE ================== --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-6">
            <i class="fas fa-building text-brand mr-2"></i>
            Informations de contact du site
        </h2>

        <form action="{{ route('admin.settings.contact') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm font-semibold text-gray-600">Adresse</label>
                <input type="text" name="adresse" value="{{ $settings->adresse ?? '' }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:border-brand focus:ring-2 focus:ring-brand/20">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-600">Email public</label>
                <input type="email" name="contact_email" value="{{ $settings->contact_email ?? '' }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:border-brand focus:ring-2 focus:ring-brand/20">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-600">Téléphone</label>
                <input type="text" name="telephone" value="{{ $settings->telephone ?? '' }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:border-brand focus:ring-2 focus:ring-brand/20">
            </div>

            <button type="submit"
                class="bg-brand text-white px-6 py-2.5 rounded-xl hover:bg-brand-dark transition-all shadow-md">
                <i class="fas fa-save mr-2"></i> Enregistrer
            </button>
        </form>

    </div>

</div>
@endsection