@extends('layouts.main')

@section('title', isset($recipe) ? 'Modifier la recette' : 'Ajouter une recette')

@section('content')
    <h1>{{ isset($recipe) ? 'Modifier la recette' : 'Ajouter une recette' }}</h1>

    <form action="{{ isset($recipe) ? route('recipes.update', $recipe->id) : route('recipes.store') }}" method="POST">
        @csrf
        @if (isset($recipe))
            @method('PUT')
        @endif


        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $recipe->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $recipe->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingrédients</label>
            <textarea id="ingredients" name="ingredients" class="form-control" required>{{ old('ingredients', $recipe->ingredients ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="steps" class="form-label">Étapes</label>
            <textarea id="steps" name="steps" class="form-control" required>{{ old('steps', $recipe->steps ?? '') }}</textarea>
        </div>


    <div class="mb-3">
        <label for="image" class="form-label">Image de la recette</label>
        <input type="file" id="image" name="image" class="form-control">
    </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
