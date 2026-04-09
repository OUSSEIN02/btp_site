@extends('layouts.admin')

@section('title', 'Gestion des messages - Vision Optique')
@section('header', 'Gestion des messages')

@section('content')
<div class="space-y-6">
   
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="flex flex-wrap gap-3">
            <button onclick="filterMessages('all')" 
                    class="filter-btn px-4 py-2 rounded-lg text-sm transition-all"
                    data-filter="all">
                <i class="fas fa-list mr-1"></i> Tous
            </button>
            <button onclick="filterMessages('unread')" 
                    class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition-all"
                    data-filter="unread">
                <i class="fas fa-envelope-open mr-1"></i> Non lus
            </button>
            <button onclick="filterMessages('read')" 
                    class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition-all"
                    data-filter="read">
                <i class="fas fa-check-circle mr-1"></i> Lus
            </button>
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

    <!-- Liste des messages -->
    <div class="space-y-3" id="messagesList">
        @forelse($messages ?? [] as $message)
        <div class="message-item bg-white rounded-xl p-5 shadow-sm transition-all {{ $message->is_read ? 'opacity-75' : 'border-l-4 border-brand' }}" 
             data-id="{{ $message->id }}"
             data-read="{{ $message->is_read ? 'read' : 'unread' }}">
            
            <div class="flex justify-between items-start mb-3">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fas fa-user-circle {{ $message->is_read ? 'text-gray-400' : 'text-brand' }} text-xl"></i>
                        <h3 class="font-bold {{ $message->is_read ? 'text-gray-600' : 'text-gray-800' }}">
                            {{ $message->nom }} {{ $message->prenom }}
                        </h3>
                        @if(!$message->is_read)
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full">
                            <i class="fas fa-circle text-[6px] mr-1"></i> Non lu
                        </span>
                        @else
                        <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded-full">
                            <i class="fas fa-check-circle text-xs mr-1"></i> Lu
                        </span>
                        @endif
                    </div>
                    
                    <p class="text-sm text-gray-500 mb-2">
                        <i class="fas fa-envelope mr-1"></i> {{ $message->email }}
                        @if($message->telephone)
                        <span class="mx-2">•</span>
                        <i class="fas fa-phone mr-1"></i> {{ $message->telephone }}
                        @endif
                    </p>
                    
                    <p class="text-xs text-gray-400 mb-3">
                        <i class="far fa-calendar-alt mr-1"></i> 
                        {{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y - H:i') }}
                    </p>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-3">
                        <p class="{{ $message->is_read ? 'text-gray-600' : 'text-gray-700' }}">
                            {{ $message->message }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3">
                @if(!$message->is_read)
                <button onclick="markAsRead({{ $message->id }})" 
                        class="px-4 py-2 bg-brand text-white rounded-lg text-sm hover:bg-brand-dark transition-colors">
                    <i class="fas fa-check mr-1"></i> Marquer comme lu
                </button>
                @else
                <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded-lg text-sm cursor-not-allowed" disabled>
                    <i class="fas fa-check mr-1"></i> Déjà lu
                </button>
                @endif
            
                
                <button onclick="deleteMessage({{ $message->id }})" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition-colors">
                    <i class="fas fa-trash mr-1"></i> Supprimer
                </button>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl p-12 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-envelope text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Aucun message</h3>
                <p class="text-gray-400">Aucun message n'a été trouvé</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(method_exists($messages, 'links') && $messages->hasPages())
    <div class="flex justify-center mt-6">
        <div class="bg-white px-4 py-3 rounded-xl shadow-sm border border-gray-100">
            {{ $messages->links() }}
        </div>
    </div>
    @endif
</div>

{{-- ========== MODAL RÉPONDRE ========== --}}
<div id="replyModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl transform transition-all duration-300">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-reply text-brand mr-2"></i> Répondre au message
                </h3>
                <button onclick="closeReplyModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="replyForm" class="p-6" onsubmit="sendReply(event)">
                @csrf
                <input type="hidden" id="reply_message_id" name="message_id">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Destinataire</label>
                        <input type="email" id="reply_email" readonly
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 text-gray-600">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Objet</label>
                        <input type="text" id="reply_subject" required
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20"
                               placeholder="Re: Votre message">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                        <textarea id="reply_message" rows="5" required
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 resize-none"
                                  placeholder="Votre réponse..."></textarea>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-brand text-white py-2.5 rounded-xl hover:bg-brand-dark transition-all font-medium shadow-md">
                            <i class="fas fa-paper-plane mr-2"></i> Envoyer
                        </button>
                        <button type="button" onclick="closeReplyModal()" class="flex-1 bg-gray-100 text-gray-700 py-2.5 rounded-xl hover:bg-gray-200 transition-all font-medium">
                            Annuler
                        </button>
                    </div>
                </div>
            </form>
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
    let currentFilter = 'all';
    
    // Filtrer les messages
    window.filterMessages = function(filter) {
        currentFilter = filter;
        const messages = document.querySelectorAll('.message-item');
        
        // Mettre à jour l'apparence des boutons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('bg-brand', 'text-white');
            btn.classList.add('bg-gray-100', 'text-gray-700');
        });
        
        const activeBtn = document.querySelector(`.filter-btn[data-filter="${filter}"]`);
        activeBtn.classList.remove('bg-gray-100', 'text-gray-700');
        activeBtn.classList.add('bg-brand', 'text-white');
        
        // Filtrer les messages
        messages.forEach(message => {
            const isRead = message.getAttribute('data-read');
            if (filter === 'all') {
                message.style.display = '';
            } else if (filter === 'unread') {
                message.style.display = isRead === 'unread' ? '' : 'none';
            } else if (filter === 'read') {
                message.style.display = isRead === 'read' ? '' : 'none';
            }
        });
    };
    
    // Marquer comme lu
    window.markAsRead = async function(id) {
        try {
            const response = await fetch(`/admin/messages/${id}/read`, {
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
            } else {
                alert(data.message || 'Erreur lors de la mise à jour');
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors de la mise à jour');
        }
    };
    
    // Répondre au message
    window.replyToMessage = function(id, email, name) {
        document.getElementById('reply_message_id').value = id;
        document.getElementById('reply_email').value = email;
        document.getElementById('reply_subject').value = `Re: Votre message - Vision Optique`;
        document.getElementById('reply_message').value = `Bonjour ${name},\n\n`;
        
        const modal = document.getElementById('replyModal');
        modal.classList.remove('hidden');
        modal.style.display = 'block';
    };
    
    window.closeReplyModal = function() {
        const modal = document.getElementById('replyModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.getElementById('replyForm').reset();
    };
    
    // Envoyer la réponse
    window.sendReply = async function(event) {
        event.preventDefault();
        
        const messageId = document.getElementById('reply_message_id').value;
        const email = document.getElementById('reply_email').value;
        const subject = document.getElementById('reply_subject').value;
        const message = document.getElementById('reply_message').value;
        
        const submitBtn = event.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Envoi...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch(`/admin/messages/${messageId}/reply`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    email: email,
                    subject: subject,
                    message: message
                })
            });
            
            const data = await response.json();
            if (data.success) {
                alert('Réponse envoyée avec succès !');
                closeReplyModal();
                // Marquer comme lu automatiquement
                await markAsRead(messageId);
            } else {
                alert(data.message || 'Erreur lors de l\'envoi');
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Erreur lors de l\'envoi du message');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    };
    
    // Supprimer un message
    window.deleteMessage = function(id) {
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
            const response = await fetch(`/admin/messages/${deleteId}`, {
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