@extends('layouts.admin')

@section('content')
@include('admin.includes.sidebar')
<div class="content" style="background-color: #f8f9fa; margin-left:250px; min-height:100vh; padding: 25px;">
    <!-- En-tête amélioré avec boutons d'action -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">Messages des utilisateurs</h1>
            <p class="text-muted mb-0">Gestion des messages reçus</p>
        </div>
        <div class="d-flex">
            <div class="dropdown me-2">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i> Filtrer
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Tous les messages</a></li>
                    <li><a class="dropdown-item" href="#">Non lus</a></li>
                    <li><a class="dropdown-item" href="#">Archivés</a></li>
                </ul>
            </div>
            <div class="badge bg-primary p-2">
                <i class="fas fa-envelope me-1"></i> <span id="messageCount">{{ count($messages) }}</span> messages
            </div>
        </div>
    </div>



    <!-- Tableau amélioré -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="messagesTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-4" style="width:5%">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th class="py-3 px-4" style="width:10%">#</th>
                            <th class="py-3 px-4" style="width:15%">Nom</th>
                            <th class="py-3 px-4" style="width:20%">Email</th>
                            <th class="py-3 px-4" style="width:15%">Sujet</th>
                            <th class="py-3 px-4" style="width:30%">Message</th>
                            <th class="py-3 px-4 text-end" style="width:15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr data-id="{{ $message->id }}">
                            <td class="py-3 px-4"><input type="checkbox" class="message-checkbox"></td>
                            <td class="py-3 px-4">{{ $message->id }}</td>
                            <td class="py-3 px-4">{{ $message->name }}</td>
                            <td class="py-3 px-4">
                                <a href="mailto:{{ $message->email }}" class="text-primary text-decoration-none">
                                    {{ $message->email }}
                                </a>
                            </td>
                            <td class="py-3 px-4">{{ $message->subject }}</td>
                            <td class="py-3 px-4 text-truncate" style="max-width: 200px;">{{ $message->message }}</td>
                            <td class="py-3 px-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary btn-view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary btn-archive">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Actions groupées -->
    <div class="mt-3" id="bulkActions" style="display:none;">
        <div class="card shadow-sm">
            <div class="card-body py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <span id="selectedCount">0</span> message(s) sélectionné(s)
                    <div>
                        <button class="btn btn-sm btn-outline-danger me-2" id="deleteSelected">
                            <i class="fas fa-trash-alt me-1"></i> Supprimer
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" id="archiveSelected">
                            <i class="fas fa-archive me-1"></i> Archiver
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            Affichage de <span id="showingFrom">1</span> à <span id="showingTo">{{ count($messages) }}</span> sur <span id="totalMessages">{{ count($messages) }}</span> messages
        </div>
        <nav>
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Précédent</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Modal de confirmation -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    Êtes-vous sûr de vouloir supprimer ce message ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmAction">Confirmer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles supplémentaires -->
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .card {
        border-radius: 8px;
        border: none;
    }
    .badge {
        font-size: 0.9rem;
    }
    .btn-group .btn {
        border-radius: 4px !important;
    }
    .text-truncate {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    #messageSearch:focus {
        box-shadow: none;
        border-color: #86b7fe;
    }
</style>

<!-- JavaScript professionnel -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélection multiple
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.message-checkbox');
    const bulkActions = document.getElementById('bulkActions');
    const selectedCount = document.getElementById('selectedCount');

    // Recherche instantanée
    const searchInput = document.getElementById('messageSearch');
    const clearSearch = document.getElementById('clearSearch');
    const messagesTable = document.getElementById('messagesTable');

    // Modal de confirmation
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    const confirmAction = document.getElementById('confirmAction');
    let currentAction = null;

    // Sélection/désélection de tous les messages
    selectAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });

    // Mise à jour des actions groupées
    function updateBulkActions() {
        const selected = document.querySelectorAll('.message-checkbox:checked').length;
        if (selected > 0) {
            bulkActions.style.display = 'block';
            selectedCount.textContent = selected;
        } else {
            bulkActions.style.display = 'none';
            selectAll.checked = false;
        }
    }

    // Écouteurs pour les cases à cocher
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    // Bouton de suppression
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const messageId = this.closest('tr').dataset.id;
            showConfirmationModal(
                'Supprimer le message',
                'Êtes-vous sûr de vouloir supprimer ce message ? Cette action est irréversible.',
                () => {
                    // Ici, vous ajouteriez la logique de suppression AJAX
                    console.log('Suppression du message', messageId);
                    // Simuler une suppression
                    setTimeout(() => {
                        alert('Message supprimé avec succès');
                    }, 500);
                }
            );
        });
    });

    // Actions groupées
    document.getElementById('deleteSelected').addEventListener('click', function() {
        const selected = Array.from(document.querySelectorAll('.message-checkbox:checked'))
                            .map(checkbox => checkbox.closest('tr').dataset.id);
        
        showConfirmationModal(
            'Supprimer les messages sélectionnés',
            `Êtes-vous sûr de vouloir supprimer ${selected.length} message(s) ? Cette action est irréversible.`,
            () => {
                // Logique de suppression groupée
                console.log('Suppression des messages:', selected);
                // Simuler une suppression
                setTimeout(() => {
                    alert(`${selected.length} message(s) supprimé(s) avec succès`);
                }, 500);
            }
        );
    });

    // Fonction pour afficher la modal de confirmation
    function showConfirmationModal(title, message, callback) {
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalBody').textContent = message;
        
        confirmAction.onclick = function() {
            callback();
            confirmModal.hide();
        };
        
        confirmModal.show();
    }

    // Recherche dans les messages
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        clearSearch.style.display = searchTerm ? 'block' : 'none';
        
        // Filtrage côté client (simplifié)
        document.querySelectorAll('#messagesTable tbody tr').forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
        
        updateShowingCount();
    });

    // Effacer la recherche
    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        document.querySelectorAll('#messagesTable tbody tr').forEach(row => {
            row.style.display = '';
        });
        updateShowingCount();
    });

    // Mettre à jour le compteur d'affichage
    function updateShowingCount() {
        const visibleRows = document.querySelectorAll('#messagesTable tbody tr').length;
        document.getElementById('showingTo').textContent = visibleRows;
    }
});
</script>
@endsection