<?php

namespace App\Http\Controllers;

use App\Models\ConceptTheme;
use Illuminate\Http\Request;

class ConceptThemeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'concept_type_id' => 'required|exists:concept_types,id',
        ]);

        ConceptTheme::create($request->only(['nombre', 'concept_type_id']));

        return redirect()->route('concepts.categories')
            ->with('success', 'Tema creado exitosamente');
    }

    public function destroy($id)
    {
        $theme = ConceptTheme::findOrFail($id);
        $theme->delete();

        return redirect()->route('concepts.categories')
            ->with('success', 'Tema eliminado exitosamente');
    }
}