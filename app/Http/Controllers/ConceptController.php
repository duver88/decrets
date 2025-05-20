<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\ConceptType;
use App\Models\ConceptTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConceptController extends Controller
{
   // Lista de conceptos
    public function index()
    {
        if (auth()->user()->is_admin) {
            // Admin ve todos los conceptos
            $concepts = Concept::with(['conceptType', 'conceptTheme', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Usuarios regulares ven conceptos según permisos
            $conceptTypeIds = auth()->user()->conceptTypes()
                ->pluck('concept_types.id')
                ->toArray();
            
            $concepts = Concept::with(['conceptType', 'conceptTheme', 'user'])
                ->whereIn('concept_type_id', $conceptTypeIds)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('admin.concepts.index', compact('concepts'));
    }

    // Formulario para crear concepto
// ConceptController.php - actualiza el método create
public function create(Request $request)
{
    if (auth()->user()->is_admin) {
        $conceptTypes = ConceptType::all();
    } else {
        $conceptTypeIds = auth()->user()->conceptTypes()
            ->wherePivot('can_create', true)
            ->pluck('concept_types.id')
            ->toArray();
        
        $conceptTypes = ConceptType::whereIn('id', $conceptTypeIds)->get();
        
        if ($conceptTypes->isEmpty()) {
            return redirect()->route('concepts.index')
                ->with('error', 'No tienes permiso para crear conceptos');
        }
    }
    
    // Cargar todos los tipos con sus temas usando la relación directa
    $conceptTypesWithThemes = ConceptType::with('themes')->get();
    
    // Crear un arreglo asociativo de tipos y sus temas para usar
    $themesForTypes = [];
    foreach ($conceptTypesWithThemes as $type) {
        $themesForTypes[$type->id] = $type->themes;
    }
    
    // El tipo seleccionado actualmente
    $selectedTypeId = $request->query('concept_type_id');
    
    return view('admin.concepts.create_document', compact('conceptTypes', 'themesForTypes', 'selectedTypeId'));
}

    // Obtener temas por AJAX
    public function getThemes($typeId)
    {
        $themes = ConceptTheme::where('concept_type_id', $typeId)->get();
        return response()->json($themes);
    }

    // Guardar concepto
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'nullable|string',
            'concept_type_id' => 'required|exists:concept_types,id',
            'concept_theme_id' => 'required|exists:concept_themes,id',
            'tipo_documento' => 'required|in:Decreto,Resolución',
            'año' => 'required|string|max:4',
            'fecha' => 'required|date',
            'archivo' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        // Verificar permiso
        if (!auth()->user()->is_admin && 
            !auth()->user()->hasConceptPermissionFor($request->concept_type_id, 'create')) {
            return redirect()->back()
                ->with('error', 'No tienes permiso para crear conceptos en esta categoría');
        }

        // Procesar archivo
        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreOriginal = $archivo->getClientOriginalName();
            $nombreLimpio = time() . '_' . str_replace(' ', '_', $nombreOriginal);
            $archivoPath = $archivo->storeAs('concepts', $nombreLimpio, 'public');
        }

        // Crear concepto
        Concept::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'concept_type_id' => $request->concept_type_id,
            'concept_theme_id' => $request->concept_theme_id,
            'tipo_documento' => $request->tipo_documento,
            'año' => $request->año,
            'fecha' => $request->fecha,
            'archivo' => $archivoPath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('concepts.index')
            ->with('success', 'Concepto creado exitosamente');
    }

    // Mostrar concepto
    public function show($id)
    {
        $concept = Concept::with(['conceptType', 'conceptTheme', 'user'])
            ->findOrFail($id);
        
        // Verificar permiso si no es admin
        if (!auth()->user()->is_admin && 
            !auth()->user()->hasConceptPermissionFor($concept->concept_type_id)) {
            return redirect()->route('admin.concepts.index')
                ->with('error', 'No tienes permiso para ver este concepto');
        }
        
        return view('admin.concepts.show', compact('concept'));
    }

    // Formulario para editar concepto
public function edit(Request $request, $id)
{
    $concept = Concept::findOrFail($id);

    // tipos disponibles para usuario/admin
    $conceptTypes = ConceptType::all(); // o filtrado según permisos

    $selectedTypeId = $request->query('concept_type_id', $concept->concept_type_id);

    $themesForTypes = [];
    if ($selectedTypeId) {
        $themesForTypes[$selectedTypeId] = ConceptTheme::where('concept_type_id', $selectedTypeId)->get();
    }

    return view('admin.concepts.edit_document', compact('concept', 'conceptTypes', 'selectedTypeId', 'themesForTypes'));
}


    // Actualizar concepto
    public function update(Request $request, $id)
    {
        $concept = Concept::findOrFail($id);
        
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'nullable|string',
            'concept_type_id' => 'required|exists:concept_types,id',
            'concept_theme_id' => 'required|exists:concept_themes,id',
            'tipo_documento' => 'required|in:Decreto,Resolución',
            'año' => 'required|string|max:4',
            'fecha' => 'required|date',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        // Verificar permisos si no es admin
        if (!auth()->user()->is_admin) {
            // Verificar permiso para la categoría actual
            if (!auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'edit')) {
                return redirect()->route('admin.concepts.index')
                    ->with('error', 'No tienes permiso para editar conceptos en esta categoría');
            }
            
            // Verificar permiso para la nueva categoría si cambia
            if ($concept->concept_type_id != $request->concept_type_id && 
                !auth()->user()->hasConceptPermissionFor($request->concept_type_id, 'edit')) {
                return redirect()->route('admin.concepts.index')
                    ->with('error', 'No tienes permiso para cambiar el concepto a esta categoría');
            }
        }

        // Datos a actualizar
        $data = $request->only([
            'titulo', 'contenido', 'concept_type_id', 
            'concept_theme_id', 'tipo_documento', 'año', 'fecha'
        ]);
        
        // Procesar archivo si existe
        if ($request->hasFile('archivo')) {
            // Eliminar archivo antiguo
            if ($concept->archivo && Storage::disk('public')->exists($concept->archivo)) {
                Storage::disk('public')->delete($concept->archivo);
            }
            
            $archivo = $request->file('archivo');
            $nombreOriginal = $archivo->getClientOriginalName();
            $nombreLimpio = time() . '_' . str_replace(' ', '_', $nombreOriginal);
            $data['archivo'] = $archivo->storeAs('concepts', $nombreLimpio, 'public');
        }

        // Actualizar concepto
        $concept->update($data);

        return redirect()->route('concepts.index')
            ->with('success', 'Concepto actualizado exitosamente');
    }

    // Eliminar concepto
    public function destroy($id)
    {
        $concept = Concept::findOrFail($id);
        
        // Verificar permiso si no es admin
        if (!auth()->user()->is_admin && 
            !auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'delete')) {
            return redirect()->route('admin.concepts.index')
                ->with('error', 'No tienes permiso para eliminar este concepto');
        }
        
        // Eliminar archivo si existe
        if ($concept->archivo && Storage::disk('public')->exists($concept->archivo)) {
            Storage::disk('public')->delete($concept->archivo);
        }
        
        // Eliminar concepto
        $concept->delete();
        
        return redirect()->route('concepts.index')
            ->with('success', 'Concepto eliminado exitosamente');
    }

    public function listPublic(Request $request)
{
    $query = Concept::with(['conceptType', 'conceptTheme']);
    
    // Aplicar filtros
    if ($request->filled('tema')) {
        $query->whereHas('conceptTheme', function($q) use ($request) {
            $q->where('nombre', 'LIKE', '%' . $request->tema . '%');
        });
    }
    
    if ($request->filled('numero')) {
        $query->where('año', 'LIKE', '%' . $request->numero . '%');
    }
    
    if ($request->filled('tipo_concepto')) {
        $query->where('concept_type_id', $request->tipo_concepto);
    }
    
    if ($request->filled('fecha')) {
        $query->whereDate('fecha', $request->fecha);
    }
    
    $concepts = $query->orderBy('fecha', 'desc')->get();
    $conceptTypes = ConceptType::all();
    
    return view('public.concepts', compact('concepts', 'conceptTypes'));
}
// Mostrar detalle de concepto (vista pública)

public function showPublic($id)
{
    $concept = Concept::with(['conceptType', 'conceptTheme'])
        ->findOrFail($id);
    
    return view('public.concepts_detail', compact('concept'));
}



}