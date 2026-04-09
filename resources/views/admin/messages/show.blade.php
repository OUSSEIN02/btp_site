@extends('layouts.admin')

@section('title', 'Message reçu')

@section('content')

<div class="max-w-4xl mx-auto px-4 lg:px-0">

    <div class="mb-6">
        <a href="{{ route('messages.index') }}"
           class="inline-flex items-center gap-2 text-sm sm:text-base text-blue-600 hover:underline font-medium hover:text-blue-800 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Retour à la liste des messages
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100">

        <div class="px-5 sm:px-6 py-4 border-b flex flex-wrap justify-between items-center bg-yellow-50">
            <div class="flex-1 min-w-0 pr-4">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800 break-words">
                    {{ $message->subject ?? 'Message sans objet' }}
                </h1>

                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Reçu le {{ optional($message->created_at)->format('d/m/Y à H:i') ?? 'Date inconnue' }}
                </p>
            </div>

            @if (!$message->is_read)
                <span class="mt-2 sm:mt-0 px-3 py-1 text-xs rounded-full bg-blue-500 text-white font-semibold flex-shrink-0 shadow">
                    Nouveau
                </span>
            @endif
        </div>

        <div class="px-5 sm:px-6 py-6 space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 text-sm">
                <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                    <p class="text-gray-500 text-xs uppercase font-medium">Nom de l'expéditeur</p>
                    <p class="font-bold text-gray-800 text-base mt-1">
                        {{ $message->name }}
                    </p>
                </div>

                <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                    <p class="text-gray-500 text-xs uppercase font-medium">Email</p>
                    <p class="font-bold text-gray-800 text-base mt-1">
                         <a href="mailto:{{ $message->email }}" class="text-blue-600 hover:text-blue-700">
                             {{ $message->email }}
                         </a>
                    </p>
                </div>
            </div>

            <div>
                <p class="text-gray-500 text-sm font-medium mb-2">Contenu du message</p>

                <div class="bg-white border rounded-xl p-4 sm:p-5 text-gray-800 leading-relaxed text-sm sm:text-base whitespace-pre-line shadow-inner min-h-[150px]">
                    {{ $message->body }}
                </div>
            </div>
        </div>

        <div class="px-5 sm:px-6 py-4 border-t flex flex-col sm:flex-row justify-end sm:justify-between gap-4 sm:gap-3 bg-gray-50">

            <form action="{{ route('messages.destroy', $message) }}" method="POST"
                  class="w-full sm:w-auto order-last sm:order-first"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce message ?')">
                @csrf
                @method('DELETE')

                <button class="w-full sm:w-auto flex items-center justify-center gap-2 text-red-600 hover:text-red-800 font-medium px-4 py-2 text-sm rounded-lg border border-red-300 bg-white hover:bg-red-50 transition">
                    <i class="fa-solid fa-trash"></i>
                    Supprimer
                </button>
            </form>

            <a href="mailto:{{ $message->email }}"
               class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm shadow-md">
                <i class="fa-solid fa-reply"></i>
                Répondre par Email
            </a>
        </div>

    </div>
</div>

@endsection