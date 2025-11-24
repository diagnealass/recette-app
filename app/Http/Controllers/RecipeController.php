<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index(Request $request){
        $query =Recipe::query();
        // Filtrer par recherche si un terme est fourni
    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }
       // Ajouter la pagination
        $recipes = $query->paginate(5);

        return view('recipes.index', compact('recipes'));
    }


    public function show($id){
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', compact('recipe'));
    }

    public function create(){
        return view('recipes.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation pour l'image
        ]);
         if ($request->hasFile('image')) {
        // Stocker l'image dans le répertoire public
        $imagePath = $request->file('image')->store('recipes', 'public');
        $validated['image'] = $imagePath;
    }
        Recipe::create($validated);
        return redirect()->route('recipes.index')->with('success', 'Recette creee avec succes !');
    }

    public function edit($id){
        $recipe = Recipe::findOrFail($id);
        return view('recipes.form', compact('recipe'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $recipe = Recipe::findOrFail($id);
        
        if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($recipe->image) {
            \Storage::disk('public')->delete($recipe->image);
        }

        // Stocker la nouvelle image
        $imagePath = $request->file('image')->store('recipes', 'public');
        $validated['image'] = $imagePath;
    }

        $recipe->update($validated);
        return redirect()->route('recipes.index')->with('success', 'Recette mise a jour avec succes !');
    }

    public function destroy($id){
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recette supprimee avec succes !');
    }


}
