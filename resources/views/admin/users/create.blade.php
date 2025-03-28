@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 230px; background-color: #f8f9fa; min-height: 100vh;">

    <div class="container">
        <h1>Ajouter un utilisateur</h1>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmation du mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    </div>
@endsection
