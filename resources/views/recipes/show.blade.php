@extends('layouts.main')

@section('title', $recipe->title)

@section('content')
@if ($recipe->image)
    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="img-fluid mb-3" style="max-width: 100%; height: auto;">
@endif

    <h1>{{ $recipe->title }}</h1>
    <p><strong>Description :</strong> {{ $recipe->description }}</p>
    <p><strong>Ingrédients :</strong></p>
    <p>{{ $recipe->ingredients }}</p>
    <p><strong>Étapes :</strong></p>
    <p>{{ $recipe->steps }}</p>

    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning">Modifier</a>

    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">
        <i class="fas fa-trash"></i> Supprimer</button>
    </form>
    <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection
