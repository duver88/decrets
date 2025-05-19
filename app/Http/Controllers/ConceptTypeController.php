<?php

namespace App\Http\Controllers;

use App\Models\ConceptType;
use Illuminate\Http\Request;

class ConceptTypeController extends Controller
{
    public function index()
    {
        $conceptTypes = ConceptType::with('themes')->get();
        return view('admin.concepts.categories', compact('conceptTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:concept_types,nombre',
            'descripcion' => 'nullable|string',
        ]);

        ConceptType::create($request->only(['nombre', 'descripcion']));

        return redirect()->route('concepts.categories')
            ->with('success', 'Tipo de concepto creado exitosamente');
    }

    public function destroy($id)
    {
        $type = ConceptType::findOrFail($id);
        $type->delete();

        return redirect()->route('concepts.categories')
            ->with('success', 'Tipo de concepto eliminado exitosamente');
    }
}