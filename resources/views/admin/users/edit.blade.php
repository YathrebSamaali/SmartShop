@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Modifier l'utilisateur</h1>
        <form action="{{ route('admin.users.edit', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmation du mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
    </div>
@endsection
