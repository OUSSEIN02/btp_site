@extends('layouts.admin')

@section('title', 'Gestion des rendez-vous - Vision Optique')
@section('header', 'Gestion des rendez-vous')

@section('content')
<div class="space-y-6">
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm p-4 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="relative w-full sm:w-96">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="text" 
                   id="searchInput" 
                   placeholder="Rechercher par nom, email ou téléphone..." 
                   class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20">
        </div>
        
        <div class="flex gap-3 w-full sm:w-auto">
            <select id="statusFilter" class="px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-brand">
                <option value="">Tous les statuts</option>
                <option value="en_attente">En attente</option>
                <option value="confirme">Confirmé</option>
                <option value="annule">Annulé</option>
            </select>
            
            <select id="dateFilter" class="px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-brand">
                <option value="">Toutes les dates</option>
                <option value="today">Aujourd'hui</option>
                <option value="tomorrow">Demain</option>
                <option value="week">Cette semaine</option>
                <option value="month">Ce mois</option>
            </select>
        </div>
    </div>

   

    <!-- Messages flash -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Tableau des rendez-vous -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full" id="appointmentsTable">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Client</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Contact</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Date/Heure</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Message</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Statut</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments ?? [] as $appointment)
                    <tr class="border-b hover:bg-gray-50 transition-colors" 
                        data-status="{{ $appointment->statut }}"
                        data-name="{{ strtolower($appointment->nom . ' ' . $appointment->prenom) }}"
                        data-email="{{ strtolower($appointment->email) }}"
                        data-phone="{{ $appointment->telephone }}">
                        
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">{{ $appointment->prenom }} {{ $appointment->nom }}</div>
                            <div class="text-xs text-gray-400">N°: #{{ $loop->iteration }}</div>
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <div><i class="fas fa-envelope text-gray-400 text-xs mr-1"></i> {{ $appointment->email }}</div>
                                <div class="mt-1"><i class="fas fa-phone text-gray-400 text-xs mr-1"></i> {{ $appointment->telephone }}</div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="font-medium">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $appointment->heure }}</div>
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600 max-w-xs truncate" title="{{ $appointment->message }}">
                                {{ $appointment->message ?: 'Aucun message' }}
                            </div>
                        </td>
                        
                        <td class="px-6 py-4">
                        <select onchange="updateStatus({{ $appointment->id }}, this.value)" 
                            class="status-select text-sm border rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-brand/20">
                            <option value="en_attente" {{ $appointment->status == 'en_attente' ? 'selected' : '' }} class="text-orange-600">
                                ⏳ En attente
                            </option>
                            <option value="confirme" {{ $appointment->status == 'confirme' ? 'selected' : '' }} class="text-green-600">
                                ✓ Confirmé
                            </option>
                            <option value="annule" {{ $appointment->status == 'annule' ? 'selected' : '' }} class="text-red-600">
                                ✗ Annulé
                            </option>
                        </select>

                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <button onclick="viewAppointment({{ $appointment->id }})" 
                                        class="text-blue-500 hover:text-blue-700 transition-colors p-1.5 hover:bg-blue-50 rounded-lg"
                                        title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="deleteAppointment({{ $appointment->id }})" 
                                        class="text-red-500 hover:text-red-700 transition-colors p-1.5 hover:bg-red-50 rounded-lg"
                                        title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-calendar-alt text-4xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-1">Aucun rendez-vous</h3>
                                <p class="text-gray-400">Aucun rendez-vous n'a été trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($appointments, 'links') && $appointments->hasPages())
    <div class="flex justify-center">
        <div class="bg-white px-4 py-3 rounded-xl shadow-sm border border-gray-100">
            {{ $appointments->links() }}
        </div>
    </div>
    @endif
</div>

{{-- ========== MODAL DÉTAILS RENDEZ-VOUS ========== --}}
<div id="viewModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl transform transition-all duration-300">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-calendar-check text-brand mr-2"></i> Détails du rendez-vous
                </h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="p-6" id="appointmentDetails">
                <!-- Les détails seront chargés dynamiquement -->
            </div>
            
            <div class="flex gap-3 p-6 border-t border-gray-100">
                <button onclick="closeViewModal()" class="flex-1 bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition-all font-medium">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ========== MODAL SUPPRESSION ========== --}}
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Confirmer la suppression</h3>
                <p class="text-gray-500 mb-6">Cette action est irréversible.</p>
                <div class="flex gap-3">
                    <button onclick="confirmDelete()" class="flex-1 bg-red-500 text-white py-2.5 rounded-xl hover:bg-red-600 transition-all font-medium">
                        <i class="fas fa-trash mr-2"></i> Supprimer
                    </button>
                    <button onclick="closeDeleteModal()" class="flex-1 bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition-all font-medium">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let deleteId = null;
    
    // Filtres et recherche
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');
    const rows = document.querySelectorAll('#appointmentsTable tbody tr[data-status]');
    
    function filterTable() {
        const searchTerm = searchInput?.value.toLowerCase() || '';
        const status = statusFilter?.value || '';
        const dateRange = dateFilter?.value || '';
        const today = new Date().toISOString().split('T')[0];
        
        rows.forEach(row => {
            const name = row.getAttribute('data-name') || '';
            const email = row.getAttribute('data-email') || '';
            const phone = row.getAttribute('data-phone') || '';
            const rowStatus = row.getAttribute('data-status') || '';
            
            // Recherche
            const matchesSearch = name.includes(searchTerm) || 
                                 email.includes(searchTerm) || 
                                 phone.includes(searchTerm);
            
            // Statut
            const matchesStatus = !status || rowStatus === status;
            
            // Date (à implémenter selon vos besoins)
            let matchesDate = true;
            if (dateRange === 'today') {
                // Vérifier si la date du rendez-vous = aujourd'hui
            }
            
            row.style.display = matchesSearch && matchesStatus && matchesDate ? '' : 'none';
        });
    }
    
    searchInput?.addEventListener('keyup', filterTable);
    statusFilter?.addEventListener('change', filterTable);
    dateFilter?.addEventListener('change', filterTable);
    
    // Mettre à jour le statut
    window.updateStatus = async function(id, status) {
        try {
            const response = await fetch(`/admin/appointments/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: status })
            });
            
            const data = await response.json();
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Erreur lors de la mise à jour');
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors de la mise à jour du statut');
        }
    };
    
    // Voir les détails
    window.viewAppointment = async function(id) {
        try {
            const response = await fetch(`/admin/appointments/${id}`);
            const data = await response.json();
            
            if (data.success) {
                const apt = data.appointment;
                const statusText = {
                    'en_attente': 'En attente',
                    'confirme': 'Confirmé',
                    'annule': 'Annulé'
                }[apt.statut] || apt.statut;
                
                const statusColor = {
                    'en_attente': 'text-orange-600 bg-orange-50',
                    'confirme': 'text-green-600 bg-green-50',
                    'annule': 'text-red-600 bg-red-50'
                }[apt.statut] || 'text-gray-600 bg-gray-50';
                
                document.getElementById('appointmentDetails').innerHTML = `
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 uppercase">Client</label>
                                <p class="font-medium text-gray-800">${apt.last_name} ${apt.first_name}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 uppercase">Statut</label>
                                <p><span class="inline-block px-3 py-1 rounded-full text-sm ${statusColor}">${statusText}</span></p>
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Contact</label>
                            <p class="text-gray-800">${apt.email}</p>
                            <p class="text-gray-800">${apt.phone}</p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 uppercase">Date</label>
                                <p class="text-gray-800">${new Date(apt.date).toLocaleDateString('fr-FR')}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 uppercase">Heure</label>
                                <p class="text-gray-800">${apt.apointment_time}</p>
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Message</label>
                            <p class="text-gray-800 bg-gray-50 p-3 rounded-lg">${apt.message || 'Aucun message'}</p>
                        </div>
                        
                        <div>
                            <label class="text-xs text-gray-500 uppercase">Créé le</label>
                            <p class="text-gray-600 text-sm">${new Date(apt.created_at).toLocaleString('fr-FR')}</p>
                        </div>
                    </div>
                `;
                
                const modal = document.getElementById('viewModal');
                modal.classList.remove('hidden');
                modal.style.display = 'block';
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des détails');
        }
    };
    
    window.closeViewModal = function() {
        const modal = document.getElementById('viewModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    };
    
    // Supprimer
    window.deleteAppointment = function(id) {
        deleteId = id;
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.style.display = 'block';
    };
    
    window.closeDeleteModal = function() {
        deleteId = null;
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    };
    
    window.confirmDelete = async function() {
        if (!deleteId) return;
        
        try {
            const response = await fetch(`/admin/appointments/${deleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const data = await response.json();
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Erreur lors de la suppression');
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors de la suppression');
        }
        
        closeDeleteModal();
    };
</script>
@endpush
@endsection