@extends('layouts.main')

@section('title', 'Ajouter une recette')

@section('content')
    <h1>Ajouter une nouvelle recette</h1>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf <!-- Protection contre les attaques CSRF -->

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingrédients</label>
            <textarea id="ingredients" name="ingredients" class="form-control" required>{{ old('ingredients') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="steps" class="form-label">Étapes</label>
            <textarea id="steps" name="steps" class="form-control" required>{{ old('steps') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
