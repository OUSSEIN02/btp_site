@extends('layouts.admin')

@section('title', 'Gestion des lunettes - Vision Optique')
@section('header', 'Gestion des lunettes')

@section('content')
<div class="space-y-6">
    <!-- Bouton Ajouter -->
    <div class="flex justify-end">
        <button onclick="openAddModal()" 
                class="bg-[#0f2544] text-white px-5 py-2.5 rounded-lg hover:bg-brand-dark transition-colors flex items-center gap-2 shadow-sm">
            <i class="fas fa-plus"></i>
            Ajouter une lunette
        </button>
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

    <!-- Tableau -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">N°</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Catégorie</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Marque</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Prix</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($glasses as $glass)
                    <tr class="border-b hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            @if($glass->image)
                                <img src="{{ asset('storage/' . $glass->image) }}" alt="{{ $glass->name }}" class="w-12 h-12 object-cover rounded-lg">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-glasses text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $glass->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">{{ $glass->category }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $glass->brand }}</td>
                        <td class="px-6 py-4 font-bold text-brand">{{ number_format($glass->price, 0, ',', ' ') }} €</td>
                        <td class="px-6 py-4">
                            @if($glass->is_active)
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                    <i class="fas fa-check-circle text-xs mr-1"></i> Actif
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs">
                                    <i class="fas fa-ban text-xs mr-1"></i> Inactif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <button onclick="editGlass({{ $glass->id }})" class="text-blue-500 hover:text-blue-700" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="toggleStatus({{ $glass->id }})" class="text-orange-500 hover:text-orange-700" title="{{ $glass->is_active ? 'Désactiver' : 'Activer' }}">
                                    <i class="fas {{ $glass->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                </button>
                                <button onclick="deleteGlass({{ $glass->id }})" class="text-red-500 hover:text-red-700" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-gray-500">
                            <i class="fas fa-glasses text-5xl mb-3 block text-gray-300"></i>
                            <p>Aucune lunette enregistrée</p>
                            <button onclick="openAddModal()" class="mt-3 text-brand hover:underline">Cliquez ici pour ajouter votre première lunette</button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($glasses, 'links') && $glasses->hasPages())
    <div class="flex justify-center mt-6">
        {{ $glasses->links() }}
    </div>
    @endif
</div>


{{-- ========== MODAL AJOUTER / MODIFIER ========== --}}
{{-- ========== MODAL AJOUTER / MODIFIER ========== --}}
{{-- ========== MODAL AJOUTER / MODIFIER ========== --}}
<div id="glassModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div id="modalContent" class="bg-white rounded-2xl max-w-lg w-full shadow-2xl transform transition-all duration-300 scale-95 opacity-0" style="max-height: 90vh; display: flex; flex-direction: column;">
            
            <!-- En-tête fixe -->
            <div class="flex justify-between items-center p-6 border-b border-gray-100" style="flex-shrink: 0;">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-800">
                    <i class="fas fa-plus-circle text-brand mr-2"></i> Ajouter une lunette
                </h3>
                <button onclick="closeGlassModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Corps scrollable -->
            <div style="flex: 1; overflow-y: auto; padding: 24px;">
                <form id="glassForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="glass_id" name="glass_id">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nom <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" required placeholder="Ex: Lunette Classique"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 transition-all">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Catégorie <span class="text-red-500">*</span>
                                </label>
                                <select id="category" name="category" required
                                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20">
                                    <option value="">Sélectionnez</option>
                                    <option value="Lunettes de vue">👓 Lunettes de vue</option>
                                    <option value="Lunettes de soleil">🕶️ Lunettes de soleil</option>
                                    <option value="Lunettes enfant">🧒 Lunettes enfant</option>
                                    <option value="Lunettes sport">🏃 Lunettes sport</option>
                                    <option value="Lunettes connectées">📱 Lunettes connectées</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Marque <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="brand" name="brand" required placeholder="Ex: Ray-Ban"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Prix (€) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="price" name="price" step="0.01" required placeholder="0.00"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Statut
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer mt-3">
                                    <input type="checkbox" id="is_active" name="is_active" checked
                                           class="w-4 h-4 rounded border-gray-300 text-brand focus:ring-brand">
                                    <span class="text-sm text-gray-700">Actif</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4" placeholder="Description détaillée..."
                                      class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 resize-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Image
                            </label>
                            <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-brand transition-colors cursor-pointer"
                                 onclick="document.getElementById('image').click()">
                                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Cliquez pour choisir une image</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG jusqu'à 2MB</p>
                            </div>
                            <div id="currentImage" class="hidden mt-3">
                                <p class="text-xs text-gray-500 mb-2">Image actuelle :</p>
                                <img id="currentImagePreview" src="" class="w-16 h-16 object-cover rounded-lg border-2 border-brand">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Pied de page fixe avec boutons -->
            <div class="flex gap-3 p-6 border-t border-gray-100" style="flex-shrink: 0;">
                <button type="button" onclick="submitGlassForm()"
                        class="flex-1 bg-[#0f2544] text-white py-2.5 rounded-xl hover:bg-brand-dark transition-all font-medium shadow-md">
                    <i class="fas fa-save mr-2"></i> Enregistrer
                </button>
                <button type="button" onclick="closeGlassModal()"
                        class="flex-1 bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition-all font-medium">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ========== MODAL SUPPRESSION ========== --}}
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl">
        <div class="text-center p-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Confirmer la suppression</h3>
            <p class="text-gray-500 mb-6">Cette action est irréversible.</p>
            <div class="flex gap-3">
                <button onclick="confirmDelete()"
                        class="flex-1 bg-red-500 text-white py-2.5 rounded-xl hover:bg-red-600 transition-all font-medium">
                    <i class="fas fa-trash mr-2"></i> Supprimer
                </button>
                <button onclick="closeDeleteModal()"
                        class="flex-1 bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition-all font-medium">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
(function() {
    let deleteId = null;

    // ── Ouvrir la modale ─────────────────────────────────────────
    window.openAddModal = function() {
        document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle text-brand mr-2"></i> Ajouter une lunette';
        document.getElementById('glassForm').reset();
        document.getElementById('glass_id').value = '';
        document.getElementById('currentImage').classList.add('hidden');
        
        const modal = document.getElementById('glassModal');
        const modalContent = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        modal.style.display = 'block';
        
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    };

    // ── Fermer la modale ─────────────────────────────────────────
    window.closeGlassModal = function() {
        const modal = document.getElementById('glassModal');
        const modalContent = document.getElementById('modalContent');
        
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.style.display = 'none';
            document.getElementById('glassForm').reset();
        }, 200);
    };

    // ── Modifier une lunette ─────────────────────────────────────
    window.editGlass = async function(id) {
        try {
            const response = await fetch(`/admin/glasses/${id}/edit`);
            const data = await response.json();
            
            if (data.success) {
                document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit text-brand mr-2"></i> Modifier la lunette';
                document.getElementById('glass_id').value = data.glass.id;
                document.getElementById('name').value = data.glass.name;
                document.getElementById('category').value = data.glass.category;
                document.getElementById('brand').value = data.glass.brand;
                document.getElementById('price').value = data.glass.price;
                document.getElementById('description').value = data.glass.description || '';
                document.getElementById('is_active').checked = data.glass.is_active === 1;
                
                if (data.glass.image) {
                    document.getElementById('currentImagePreview').src = '/storage/' + data.glass.image;
                    document.getElementById('currentImage').classList.remove('hidden');
                } else {
                    document.getElementById('currentImage').classList.add('hidden');
                }
                
                const modal = document.getElementById('glassModal');
                const modalContent = document.getElementById('modalContent');
                
                modal.classList.remove('hidden');
                modal.style.display = 'block';
                
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des données');
        }
    };

    // ── Soumettre le formulaire ───────────────────────────────────
    window.submitGlassForm = async function() {
        const form = document.getElementById('glassForm');
        const formData = new FormData(form);
        const glassId = document.getElementById('glass_id').value;
        
        let url = '/admin/glasses';
        if (glassId) {
            url = `/admin/glasses/${glassId}`;
            formData.append('_method', 'PUT');
        }
        
        const submitBtn = event?.target;
        const btn = document.querySelector('#glassModal button[onclick="submitGlassForm()"]');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Envoi...';
        btn.disabled = true;
        
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Une erreur est survenue');
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors de l\'enregistrement');
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    };

    // ── Changer le statut ────────────────────────────────────────
    window.toggleStatus = async function(id) {
        if (!confirm('Voulez-vous changer le statut de cette lunette ?')) return;
        
        try {
            const response = await fetch(`/admin/glasses/${id}/toggle`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const data = await response.json();
            if (data.success) {
                location.reload();
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors du changement de statut');
        }
    };

    // ── Supprimer une lunette ────────────────────────────────────
    window.deleteGlass = function(id) {
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
            const response = await fetch(`/admin/glasses/${deleteId}`, {
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
})();
</script>
@endpush
@endsection