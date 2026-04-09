@extends('layouts.admin')

@section('title', 'Tableau de bord - Vision Optique')
@section('header', 'Tableau de bord')

@section('content')
<div class="space-y-6">
    <!-- Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="stat-card bg-white rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Rendez-vous totaux</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalAppointments ?? 0 }}</p>
                </div>
                <i class="fas fa-calendar text-3xl text-brand opacity-50"></i>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">En attente</p>
                    <p class="text-3xl font-bold mt-2 text-orange-500">{{ $pendingAppointments ?? 0 }}</p>
                </div>
                <i class="fas fa-clock text-3xl text-orange-500 opacity-50"></i>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Confirmés</p>
                    <p class="text-3xl font-bold mt-2 text-green-600">{{ $confirmedAppointments ?? 0 }}</p>
                </div>
                <i class="fas fa-check-circle text-3xl text-green-600 opacity-50"></i>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Messages non lus</p>
                    <p class="text-3xl font-bold mt-2 text-blue-600">{{ $unreadMessages ?? 0 }}</p>
                </div>
                <i class="fas fa-envelope text-3xl text-blue-600 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Derniers rendez-vous -->
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-gray-800">Derniers rendez-vous</h3>
            <a href="{{ route('admin.rendezvous') }}" class="text-brand hover:text-brand-dark text-sm">
                Voir tous <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b">
                    <tr>
                        <th class="text-left py-3">Client</th>
                        <th class="text-left py-3">Email</th>
                        <th class="text-left py-3">Téléphone</th>
                        <th class="text-left py-3">Date</th>
                        <th class="text-left py-3">Heure</th>
                        <th class="text-left py-3">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentAppointments ?? [] as $appointment)
                    <tr class="border-b hover:bg-gray-50 transition-colors">
                        <td class="py-3 font-medium">{{ $appointment->first_name }} {{ $appointment->last_name }}</td>
                        <td class="py-3 text-gray-600">{{ $appointment->email }}</td>
                        <td class="py-3 text-gray-600">{{ $appointment->phone }}</td>
                        <td class="py-3">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</td>
                        <td class="py-3">{{ $appointment->appointment_time }}</td>
                        <td class="py-3">
                            @php
                                $statusClass = match($appointment->statut) {
                                    'en_attente' => 'status-pending',
                                    'confirme' => 'status-confirmed',
                                    'annule' => 'status-cancelled',
                                    default => 'status-pending'
                                };
                                $statusText = match($appointment->statut) {
                                    'en_attente' => 'En attente',
                                    'confirme' => 'Confirmé',
                                    'annule' => 'Annulé',
                                    default => 'En attente'
                                };
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            <i class="fas fa-calendar-alt text-4xl mb-2 block text-gray-300"></i>
                            <p>Aucun rendez-vous récent</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
