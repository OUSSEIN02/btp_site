@extends('layouts.admin')

@section('title', 'Messages reçus')

@section('content')

<div class="flex justify-between items-center mb-6 px-4 lg:px-0">
    <h1 class="text-2xl lg:text-3xl satisfy font-bold text-blue-700">
        📩 Messages reçus
    </h1>
</div>

{{-- ===================== DESKTOP ===================== --}}
<div class="hidden lg:block bg-white shadow-lg rounded-xl border border-yellow-300 overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-[#1a3a8f] text-white font-bold uppercase text-sm">
                <th class="py-3 px-4">N°</th>
                <th class="py-3 px-4">Nom</th>
                <th class="py-3 px-4">Email</th>
                <th class="py-3 px-4">Sujet</th>
                <th class="py-3 px-4">Message</th>
                <th class="py-3 px-4">Date</th>
                <th class="py-3 px-4 text-center">Statut</th>
                <th class="py-3 px-4 text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($messages as $message)
            <tr id="message-row-{{ $message->id }}"
                class="{{ $message->is_read ? 'bg-gray-50' : 'bg-yellow-50 font-semibold' }} hover:bg-yellow-100 transition">

                <td class="py-4 px-4">{{ $loop->iteration }}</td>
                <td class="py-4 px-4">{{ $message->nom }}</td>
                <td class="py-4 px-4">{{ $message->email }}</td>
                <td class="py-4 px-4 text-blue-600">{{ $message->type_projet }}</td>
                <td class="py-4 px-4 text-sm">{{ Str::limit($message->message, 50) }}</td>
                <td class="py-4 px-4 text-sm">{{ $message->created_at->format('d/m/Y H:i') }}</td>

                <td class="py-4 px-4 text-center message-status">
                    @if($message->is_read)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Lu</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs animate-pulse">Non lu</span>
                    @endif
                </td>

                <td class="py-4 px-4 text-center">
                    <div class="flex justify-center gap-2">

                        <button 
                        onclick="openViewModal(
                            {{ $message->id }},
                            '{{ addslashes($message->nom) }}',
                            '{{ addslashes($message->email) }}',
                            '{{ addslashes($message->telephone) }}',
                            '{{ addslashes($message->localisation) }}',
                            '{{ addslashes($message->budget) }}',
                            `{{ str_replace(['`'], ['\''], $message->type_projet) }}`,
                            `{{ str_replace(['`'], ['\''], $message->message) }}`
                        )"
                        class="bg-blue-500 text-white px-3 py-1 rounded">
                        👁
                        </button>

                        <button 
                        onclick="openDeleteModal('{{ route('messages.destroy', $message->id) }}')"
                        class="bg-red-500 text-white px-3 py-1 rounded">
                        🗑
                        </button>

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-6">Aucun message</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ===================== MOBILE ===================== --}}
<div class="lg:hidden space-y-4 px-4">
@foreach ($messages as $message)
<div class="bg-white p-4 rounded-xl shadow border-l-4 {{ $message->is_read ? 'border-gray-400' : 'border-red-500' }}">

    <h3 class="font-bold text-blue-700">{{ $message->type_projet }}</h3>

    <p class="text-sm">{{ $message->nom }}</p>
    <p class="text-sm text-gray-500">{{ $message->email }}</p>

    <p class="text-xs mt-2 italic">
        "{{ Str::limit($message->message, 80) }}"
    </p>

    <div class="flex gap-2 mt-3">

        <button
        onclick="openViewModal(
            {{ $message->id }},
            '{{ addslashes($message->nom) }}',
            '{{ addslashes($message->email) }}',
            '{{ addslashes($message->telephone) }}',
            '{{ addslashes($message->localisation) }}',
            '{{ addslashes($message->budget) }}',
            `{{ str_replace(['`'], ['\''], $message->type_projet) }}`,
            `{{ str_replace(['`'], ['\''], $message->message) }}`
        )"
        class="flex-1 bg-blue-500 text-white py-2 rounded">
        Voir
        </button>

        <button
        onclick="openDeleteModal('{{ route('messages.destroy', $message->id) }}')"
        class="bg-red-500 text-white px-3 rounded">
        🗑
        </button>

    </div>

</div>
@endforeach
</div>

{{-- ===================== MODALE VIEW ===================== --}}
<div id="viewModal" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50">

<div class="bg-white w-full max-w-xl p-6 rounded-xl">

    <h2 class="text-xl font-bold text-center mb-4">
        Message de <span id="viewNom"></span>
    </h2>

    <div class="grid grid-cols-2 gap-3 text-sm mb-4">
        <p><b>Email :</b> <span id="viewEmail"></span></p>
        <p><b>Téléphone :</b> <span id="viewTelephone"></span></p>
        <p><b>Localisation :</b> <span id="viewLocalisation"></span></p>
        <p><b>Budget :</b> <span id="viewBudget"></span></p>
    </div>

    <p class="mb-3">
        <b>Type projet :</b> <span id="viewTypeProjet"></span>
    </p>

    <div class="bg-gray-100 p-3 rounded max-h-60 overflow-y-auto">
        <span id="viewMessage"></span>
    </div>

    <div class="text-center mt-4">
        <button onclick="closeViewModal()" class="bg-yellow-400 px-4 py-2 rounded">
            Fermer
        </button>
    </div>

</div>
</div>

{{-- ===================== MODALE DELETE ===================== --}}
<div id="deleteModal" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50">

<div class="bg-white p-6 rounded-xl text-center">

    <p class="mb-4">Supprimer ce message ?</p>

    <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')

        <button class="bg-red-600 text-white px-4 py-2 rounded">Oui</button>
        <button type="button" onclick="closeDeleteModal()" class="bg-gray-300 px-4 py-2 rounded">Non</button>
    </form>

</div>
</div>

{{-- ===================== JS ===================== --}}
<script>

function openViewModal(id, nom, email, telephone, localisation, budget, type_projet, message) {

    document.getElementById('viewNom').innerText = nom || 'Non renseigné';
    document.getElementById('viewEmail').innerText = email || '-';
    document.getElementById('viewTelephone').innerText = telephone || '-';
    document.getElementById('viewLocalisation').innerText = localisation || '-';
    document.getElementById('viewBudget').innerText = budget || '-';
    document.getElementById('viewTypeProjet').innerText = type_projet || '-';
    document.getElementById('viewMessage').innerText = message || '-';

    document.getElementById('viewModal').classList.remove('hidden');

    // Marquer comme lu
    fetch(`/admin/messages/${id}/read`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(() => {
        let row = document.getElementById(`message-row-${id}`);
        if(row){
            row.classList.remove('bg-yellow-50','font-semibold');
            row.classList.add('bg-gray-50');

            let badge = row.querySelector('.message-status');
            if(badge){
                badge.innerHTML = `<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Lu</span>`;
            }
        }
    });
}

function closeViewModal(){
    document.getElementById('viewModal').classList.add('hidden');
}

function openDeleteModal(url){
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal(){
    document.getElementById('deleteModal').classList.add('hidden');
}

</script>

@endsection