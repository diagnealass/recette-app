@extends('layouts.main')

@section('title', 'Liste des recettes')

@section('content')
    <h1 class="mb-4">Liste des recettes</h1>

    <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">Ajouter une nouvelle recette</a>

    @if ($recipes->isEmpty())
        <p>Aucune recette trouvée pour "{{ request('search') }}"</p>

        <a href="{{ route('recipes.index') }}" class="btn btn-secondary">
            Retour à la liste complète
        </a>
    @else
     @csrf <!-- Token CSRF -->
    <ul class="list-group mb-3">
    @foreach ($recipes as $recipe)
        <li class="list-group-item d-flex align-items-center">
            @if ($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
            @endif
            <a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
        </li>
    @endforeach
    </ul>

        {{ $recipes->links() }}
    @endif
@endsection
