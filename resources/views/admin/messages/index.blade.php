@extends('layouts.admin')

@section('content')
@include('admin.includes.sidebar')
<div class="content" style="background-color: #f8f9fa; margin-left:250px; min-height:100vh; padding: 25px;">
    <!-- En-tête amélioré -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">Messages des utilisateurs</h1>
            <p class="text-muted mb-0">Gestion des messages reçus</p>
        </div>
        <div class="badge bg-primary p-2">
            <i class="fas fa-envelope me-1"></i> {{ count($messages) }} messages
        </div>
    </div>

    <!-- Tableau amélioré -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Nom</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Sujet</th>
                            <th class="py-3 px-4">Message</th>
                            <th class="py-3 px-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr>
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
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> Voir
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
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
</div>

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
</style>
@endsection