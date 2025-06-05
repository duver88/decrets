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
// Lista de conceptos con filtros y paginación para el dashboard admin
public function index(Request $request)
{
    $query = Concept::with(['conceptType', 'conceptTheme', 'user']);
    
    // Aplicar filtros según permisos del usuario
    if (auth()->user()->is_admin) {
        // Admin ve todos los conceptos
    } else {
        // Usuarios regulares ven conceptos según permisos
        $conceptTypeIds = auth()->user()->conceptTypes()
            ->pluck('concept_types.id')
            ->toArray();
        
        $query->whereIn('concept_type_id', $conceptTypeIds);
    }
    
    // Filtro por tipo de concepto
    if ($request->filled('concept_type_id')) {
        $query->where('concept_type_id', $request->concept_type_id);
    }

    // Filtro por tema específico
    if ($request->filled('concept_theme_id')) {
        $query->where('concept_theme_id', $request->concept_theme_id);
    }
    
    // Filtro por tipo de documento (Decreto/Resolución)
    if ($request->filled('tipo_documento')) {
        $query->where('tipo_documento', $request->tipo_documento);
    }
    
    // Filtro por año
    if ($request->filled('año')) {
        $query->where('año', $request->año);
    }
    
    // Filtros de fecha
    if ($request->filled('fecha_desde')) {
        $query->whereDate('fecha', '>=', $request->fecha_desde);
    }

    if ($request->filled('fecha_hasta')) {
        $query->whereDate('fecha', '<=', $request->fecha_hasta);
    }

    // Búsqueda general (busca en título y contenido)
    if ($request->filled('busqueda_general')) {
        $busqueda = trim($request->busqueda_general);
        $query->where(function($q) use ($busqueda) {
            $q->where('titulo', 'LIKE', '%' . $busqueda . '%')
              ->orWhere('contenido', 'LIKE', '%' . $busqueda . '%')
              ->orWhere('año', 'LIKE', '%' . $busqueda . '%')
              ->orWhere('tipo_documento', 'LIKE', "%{$busqueda}%");
        });
    }

    // Ordenamiento
    $orden = $request->get('orden', 'fecha_desc');
    switch ($orden) {
        case 'titulo_asc':
            $query->orderBy('titulo', 'asc');
            break;
        case 'titulo_desc':
            $query->orderBy('titulo', 'desc');
            break;
        case 'año_asc':
            $query->orderBy('año', 'asc')->orderBy('fecha', 'asc');
            break;
        case 'año_desc':
            $query->orderBy('año', 'desc')->orderBy('fecha', 'desc');
            break;
        case 'fecha_asc':
            $query->orderBy('fecha', 'asc');
            break;
        case 'tipo_asc':
            $query->join('concept_types', 'concepts.concept_type_id', '=', 'concept_types.id')
                  ->orderBy('concept_types.nombre', 'asc')
                  ->orderBy('concepts.fecha', 'desc')
                  ->select('concepts.*');
            break;
        case 'tema_asc':
            $query->join('concept_themes', 'concepts.concept_theme_id', '=', 'concept_themes.id')
                  ->orderBy('concept_themes.nombre', 'asc')
                  ->orderBy('concepts.fecha', 'desc')
                  ->select('concepts.*');
            break;
        case 'tipo_documento_asc':
            $query->orderBy('tipo_documento', 'asc')->orderBy('fecha', 'desc');
            break;
        default: // fecha_desc
            $query->orderBy('fecha', 'desc');
    }

    // PAGINACIÓN FIJA DE 10 ELEMENTOS
    $concepts = $query->paginate(10)->withQueryString();

    // Datos adicionales para los filtros
    if (auth()->user()->is_admin) {
        $conceptTypes = ConceptType::orderBy('nombre')->get();
    } else {
        $conceptTypeIds = auth()->user()->conceptTypes()
            ->pluck('concept_types.id')
            ->toArray();
        $conceptTypes = ConceptType::whereIn('id', $conceptTypeIds)
                                 ->orderBy('nombre')
                                 ->get();
    }
    
    $conceptThemes = ConceptTheme::with('conceptType')->orderBy('nombre')->get();
    $años = Concept::distinct()->orderBy('año', 'desc')->pluck('año')->filter();
    $tiposDocumento = ['Decreto', 'Resolución'];

    // Estadísticas para los chips
    $baseStatsQuery = Concept::query();
    
    if (!auth()->user()->is_admin) {
        $conceptTypeIds = auth()->user()->conceptTypes()
            ->pluck('concept_types.id')
            ->toArray();
        $baseStatsQuery->whereIn('concept_type_id', $conceptTypeIds);
    }
    
    $stats = [
        'total' => $baseStatsQuery->count(),
        'por_tipo' => ConceptType::withCount(['concepts' => function($query) {
            if (!auth()->user()->is_admin) {
                $conceptTypeIds = auth()->user()->conceptTypes()
                    ->pluck('concept_types.id')
                    ->toArray();
                $query->whereIn('concept_type_id', $conceptTypeIds);
            }
        }])->get(),
        'por_año' => $baseStatsQuery->selectRaw('año, COUNT(*) as count')
                                   ->groupBy('año')
                                   ->orderBy('año', 'desc')
                                   ->pluck('count', 'año'),
        'por_tipo_documento' => $baseStatsQuery->selectRaw('tipo_documento, COUNT(*) as count')
                                              ->groupBy('tipo_documento')
                                              ->pluck('count', 'tipo_documento'),
    ];

    return view('admin.concepts.index', compact(
        'concepts', 
        'conceptTypes', 
        'conceptThemes',
        'años', 
        'tiposDocumento',
        'stats'
    ));
}

    // Formulario para crear concepto
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
            'tipo_documento' => 'required|in:Concepto',
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
    $concept = Concept::findOrFail($id);
    
    // Verificar si el usuario tiene permiso para ver este concepto
    $canView = auth()->user()->is_admin || 
              auth()->user()->hasGlobalConceptPermission('create') || 
              auth()->user()->hasGlobalConceptPermission('edit') ||
              auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'create') ||
              auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'edit');
    
    if (!$canView) {
        return redirect()->route('concepts.index')
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


     // Método para la vista pública con filtros mejorados
    public function listPublic(Request $request)
    {
        $query = Concept::with(['conceptType', 'conceptTheme', 'user']);
        
        // Filtro por tema (búsqueda en nombre del tema)
        if ($request->filled('tema')) {
            $tema = trim($request->tema);
            $query->whereHas('conceptTheme', function($q) use ($tema) {
                $q->where('nombre', 'LIKE', '%' . $tema . '%');
            });
        }

        // Filtro por ID específico del tema
        if ($request->filled('concept_theme_id')) {
            $query->where('concept_theme_id', $request->concept_theme_id);
        }
        
        // Filtro por año
        if ($request->filled('numero')) {
            $año = trim($request->numero);
            $query->where('año', 'LIKE', '%' . $año . '%');
        }

        // Filtro por año específico
        if ($request->filled('año')) {
            $query->where('año', $request->año);
        }
        
        // Filtro por tipo de concepto
        if ($request->filled('tipo_concepto') || $request->filled('concept_type_id')) {
            $tipoId = $request->filled('concept_type_id') ? $request->concept_type_id : $request->tipo_concepto;
            $query->where('concept_type_id', $tipoId);
        }

        // Filtro por tipo de documento (Decreto/Resolución)
        if ($request->filled('tipo_documento')) {
            $query->where('tipo_documento', $request->tipo_documento);
        }
        
        // Filtros de fecha mejorados
        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        // Filtro por fecha exacta (mantener compatibilidad)
        if ($request->filled('fecha') && !$request->filled('fecha_desde') && !$request->filled('fecha_hasta')) {
            $query->whereDate('fecha', $request->fecha);
        }

        // Filtro por mes (si se proporciona año)
        if ($request->filled('mes') && $request->filled('año')) {
            $query->whereMonth('fecha', $request->mes)
                  ->where('año', $request->año);
        }

        // Búsqueda por título
        if ($request->filled('titulo')) {
            $titulo = trim($request->titulo);
            $query->where('titulo', 'LIKE', '%' . $titulo . '%');
        }

        // Búsqueda general (busca en título y contenido)
        if ($request->filled('busqueda_general')) {
            $busqueda = trim($request->busqueda_general);
            $query->where(function($q) use ($busqueda) {
                $q->where('titulo', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('contenido', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('año', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('tipo_documento', 'LIKE', "%{$busqueda}%");
            });
        }

        // Filtro por usuario (para admins)
        if ($request->filled('user_id') && auth()->check() && auth()->user()->is_admin) {
            $query->where('user_id', $request->user_id);
        }

        // Ordenamiento mejorado
        $orden = $request->get('orden', 'fecha_desc');
        switch ($orden) {
            case 'titulo_asc':
                $query->orderBy('titulo', 'asc');
                break;
            case 'titulo_desc':
                $query->orderBy('titulo', 'desc');
                break;
            case 'año_asc':
                $query->orderBy('año', 'asc')->orderBy('fecha', 'asc');
                break;
            case 'año_desc':
                $query->orderBy('año', 'desc')->orderBy('fecha', 'desc');
                break;
            case 'fecha_asc':
                $query->orderBy('fecha', 'asc');
                break;
            case 'tipo_asc':
                $query->join('concept_types', 'concepts.concept_type_id', '=', 'concept_types.id')
                      ->orderBy('concept_types.nombre', 'asc')
                      ->orderBy('concepts.fecha', 'desc')
                      ->select('concepts.*');
                break;
            case 'tema_asc':
                $query->join('concept_themes', 'concepts.concept_theme_id', '=', 'concept_themes.id')
                      ->orderBy('concept_themes.nombre', 'asc')
                      ->orderBy('concepts.fecha', 'desc')
                      ->select('concepts.*');
                break;
            case 'tipo_documento_asc':
                $query->orderBy('tipo_documento', 'asc')->orderBy('fecha', 'desc');
                break;
            default: // fecha_desc
                $query->orderBy('fecha', 'desc');
        }

        // Paginación opcional
    $concepts = $query->paginate(10)->withQueryString();

    // Datos adicionales para los filtros
    $conceptTypes = ConceptType::orderBy('nombre')->get();
    $conceptThemes = ConceptTheme::with('conceptType')->orderBy('nombre')->get();
    $años = Concept::distinct()->orderBy('año', 'desc')->pluck('año')->filter();
    $tiposDocumento = ['Decreto', 'Resolución'];

    // Si hay un tipo seleccionado, filtrar temas por ese tipo
    $temasFiltered = collect();
    if ($request->filled('concept_type_id')) {
        $temasFiltered = ConceptTheme::where('concept_type_id', $request->concept_type_id)
                                    ->orderBy('nombre')
                                    ->get();
    }




        // Datos adicionales para los filtros
        $conceptTypes = ConceptType::orderBy('nombre')->get();
        $conceptThemes = ConceptTheme::with('conceptType')->orderBy('nombre')->get();
        $años = Concept::distinct()->orderBy('año', 'desc')->pluck('año')->filter();
        $tiposDocumento = ['Decreto', 'Resolución'];

        // Si hay un tipo seleccionado, filtrar temas por ese tipo
        $temasFiltered = collect();
        if ($request->filled('concept_type_id')) {
            $temasFiltered = ConceptTheme::where('concept_type_id', $request->concept_type_id)
                                        ->orderBy('nombre')
                                        ->get();
        }

        // Estadísticas para mostrar en la vista
        $stats = [
            'total' => $query->count(),
            'por_tipo' => ConceptType::withCount('concepts')->get(),
            'por_año' => Concept::selectRaw('año, COUNT(*) as count')
                               ->groupBy('año')
                               ->orderBy('año', 'desc')
                               ->pluck('count', 'año'),
            'por_tipo_documento' => Concept::selectRaw('tipo_documento, COUNT(*) as count')
                                          ->groupBy('tipo_documento')
                                          ->pluck('count', 'tipo_documento'),
            'ultimos_30_dias' => Concept::where('fecha', '>=', now()->subDays(30))->count(),
        ];

        return view('public.concepts', compact(
            'concepts', 
            'conceptTypes', 
            'conceptThemes',
            'temasFiltered',
            'años', 
            'tiposDocumento',
            'stats'
        ));
    }

     public function getThemesByType($typeId)
    {
        $themes = ConceptTheme::where('concept_type_id', $typeId)
                              ->orderBy('nombre')
                              ->get(['id', 'nombre']);
        return response()->json($themes);
    }

    // Método auxiliar para obtener estadísticas avanzadas
    public function getAdvancedStats()
    {
        return [
            'total_conceptos' => Concept::count(),
            'por_mes_actual' => Concept::whereMonth('fecha', now()->month)
                                     ->whereYear('fecha', now()->year)
                                     ->count(),
            'por_tipo_y_año' => ConceptType::with(['concepts' => function($query) {
                $query->selectRaw('concept_type_id, año, COUNT(*) as count')
                      ->groupBy('concept_type_id', 'año');
            }])->get(),
            'tendencia_mensual' => Concept::selectRaw('YEAR(fecha) as año, MONTH(fecha) as mes, COUNT(*) as count')
                                         ->groupBy('año', 'mes')
                                         ->orderBy('año', 'desc')
                                         ->orderBy('mes', 'desc')
                                         ->limit(12)
                                         ->get(),
        ];
    }


// Mostrar detalle de concepto (vista pública)

public function showPublic($id)
{
    $concept = Concept::with(['conceptType', 'conceptTheme'])
        ->findOrFail($id);
    
    return view('public.concepts_detail', compact('concept'));
}



}