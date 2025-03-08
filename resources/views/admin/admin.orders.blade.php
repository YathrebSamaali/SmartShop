@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📦 Gestion des Commandes</h2>

    <!-- Filtrage des commandes -->
    <form action="{{ route('admin.orders') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" value="{{ request()->get('start_date') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date" class="form-control" value="{{ request()->get('end_date') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">Sélectionner un statut</option>
                    <option value="pending" {{ request()->get('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="completed" {{ request()->get('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                    <option value="canceled" {{ request()->get('status') == 'canceled' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Table des commandes -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->total }}€</td>
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    @if ($order->status == 'pending')
                        <span class="badge bg-warning">En attente</span>
                    @elseif ($order->status == 'completed')
                        <span class="badge bg-success">Terminé</span>
                    @elseif ($order->status == 'canceled')
                        <span class="badge bg-danger">Annulé</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>
@endsection
