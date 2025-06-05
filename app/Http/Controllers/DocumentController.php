<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Método para la vista pública
 // Método para la vista pública con filtros mejorados
 public function listPublic(Request $request)
    {
        $query = Document::with('category');

        // Filtro por tipo de documento
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Filtro por número (búsqueda parcial mejorada)
        if ($request->filled('numero')) {
            $numero = trim($request->numero);
            $query->where('numero', 'LIKE', '%' . $numero . '%');
        }

        // CORREGIDO: Filtro por nombre (incluye búsqueda en tipo también)
        if ($request->filled('nombre')) {
            $nombre = trim($request->nombre);
            $query->where(function($q) use ($nombre) {
                $q->where('nombre', 'LIKE', '%' . $nombre . '%')
                  ->orWhere('tipo', 'LIKE', '%' . $nombre . '%');
            });
        }

        // Filtro por categoría
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
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

        // CAMBIADO: Filtro por año ahora filtra por nombre del documento
        if ($request->filled('año')) {
            $año = trim($request->año);
            $query->where('nombre', 'LIKE', '%' . $año . '%');
        }

        // CORREGIDO: Filtro por mes (usar fecha de publicación)
        if ($request->filled('mes') && $request->filled('año')) {
            $mes = (int) $request->mes;
            $año = trim($request->año);
            
            // Validar que mes esté entre 1 y 12
            if ($mes >= 1 && $mes <= 12 && !empty($año)) {
                $query->whereMonth('fecha', $mes)
                      ->where('nombre', 'LIKE', '%' . $año . '%');
            }
        }

        // AGREGADO: Búsqueda general (busca en nombre, número, descripción y tipo)
        if ($request->filled('busqueda_general')) {
            $busqueda = trim($request->busqueda_general);
            $query->where(function($q) use ($busqueda) {
                $q->where('nombre', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('numero', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('descripcion', 'LIKE', '%' . $busqueda . '%')
                  ->orWhere('tipo', 'LIKE', "%{$busqueda}%");
            });
        }

        // Ordenamiento mejorado
        $orden = $request->get('orden', 'fecha_desc');
        switch ($orden) {
            case 'numero_asc':
                $query->orderBy('numero', 'asc');
                break;
            case 'numero_desc':
                $query->orderBy('numero', 'desc');
                break;
            case 'nombre_asc':
                $query->orderBy('nombre', 'asc');
                break;
            case 'nombre_desc':
                $query->orderBy('nombre', 'desc');
                break;
            case 'fecha_asc':
                $query->orderBy('fecha', 'asc');
                break;
            case 'tipo_asc':
                $query->orderBy('tipo', 'asc')->orderBy('fecha', 'desc');
                break;
            case 'categoria_asc':
                $query->join('categories', 'documents.category_id', '=', 'categories.id')
                      ->orderBy('categories.nombre', 'asc')
                      ->orderBy('documents.fecha', 'desc')
                      ->select('documents.*');
                break;
            default: // fecha_desc
                $query->orderBy('fecha', 'desc');
        }

        // CAMBIADO: Siempre usar paginación de 10 elementos
        $documents = $query->paginate(10)->withQueryString();

        // Datos adicionales para los filtros
        $categories = Category::orderBy('nombre')->get();
        $tipos = Document::distinct()->pluck('tipo')->filter()->sort()->values();
        
        // CAMBIADO: Obtener años únicos del nombre del documento
        $años = Document::selectRaw('SUBSTRING(nombre, LOCATE("2", nombre), 4) as año')
                       ->distinct()
                       ->whereRaw('nombre REGEXP "[0-9]{4}"')
                       ->orderBy('año', 'desc')
                       ->pluck('año')
                       ->filter()
                       ->unique()
                       ->values();

        // CORREGIDO: Estadísticas para que coincidan con la vista
        $stats = [
            'total' => Document::count(),
            'por_tipo' => Document::selectRaw('tipo, COUNT(*) as count')
                                 ->groupBy('tipo')
                                 ->pluck('count', 'tipo'),
            // CAMBIADO: Usar withCount para coincidir con el formato esperado en la vista
            'por_categoria' => Category::withCount('documents')->get(),
            'por_año' => Document::selectRaw('SUBSTRING(nombre, LOCATE("2", nombre), 4) as año, COUNT(*) as count')
                               ->whereRaw('nombre REGEXP "[0-9]{4}"')
                               ->groupBy('año')
                               ->orderBy('año', 'desc')
                               ->pluck('count', 'año'),
            'ultimos_30_dias' => Document::where('fecha', '>=', now()->subDays(30))->count(),
        ];

        return view('public.documents', compact(
            'documents', 
            'categories', 
            'tipos', 
            'años', 
            'stats'
        ));
    }

    public function getStats()
    {
        return [
            'total_documentos' => Document::count(),
            'por_mes_actual' => Document::whereMonth('fecha', now()->month)
                                      ->whereYear('fecha', now()->year)
                                      ->count(),
            'ultimos_30_dias' => Document::where('fecha', '>=', now()->subDays(30))->count(),
            'por_categoria' => Category::withCount('documents')->get(),
        ];
    }

    // Vista para ver más o descargar documento
    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('public.document_detail', compact('document'));
    }

    // Dashboard - listado de documentos para admin
public function index(Request $request)
{
    $query = Document::with('category');

    /* --- FILTROS (mismos que listPublic()) --- */
    
    // Filtro por tipo de documento
    if ($request->filled('tipo')) {
        $query->where('tipo', $request->tipo);
    }

    // Filtro por número (búsqueda parcial mejorada)
    if ($request->filled('numero')) {
        $numero = trim($request->numero);
        $query->where('numero', 'LIKE', '%' . $numero . '%');
    }

    // Filtro por nombre (incluye búsqueda en tipo también)
    if ($request->filled('nombre')) {
        $nombre = trim($request->nombre);
        $query->where(function($q) use ($nombre) {
            $q->where('nombre', 'LIKE', '%' . $nombre . '%')
              ->orWhere('tipo', 'LIKE', '%' . $nombre . '%');
        });
    }

    // Filtro por categoría
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
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

    // Filtro por año (filtra por nombre del documento)
    if ($request->filled('año')) {
        $año = trim($request->año);
        $query->where('nombre', 'LIKE', '%' . $año . '%');
    }

    // Filtro por mes (usar fecha de publicación)
    if ($request->filled('mes') && $request->filled('año')) {
        $mes = (int) $request->mes;
        $año = trim($request->año);
        
        // Validar que mes esté entre 1 y 12
        if ($mes >= 1 && $mes <= 12 && !empty($año)) {
            $query->whereMonth('fecha', $mes)
                  ->where('nombre', 'LIKE', '%' . $año . '%');
        }
    }

    // Búsqueda general (busca en nombre, número, descripción y tipo)
    if ($request->filled('busqueda_general')) {
        $busqueda = trim($request->busqueda_general);
        $query->where(function($q) use ($busqueda) {
            $q->where('nombre', 'LIKE', '%' . $busqueda . '%')
              ->orWhere('numero', 'LIKE', '%' . $busqueda . '%')
              ->orWhere('descripcion', 'LIKE', '%' . $busqueda . '%')
              ->orWhere('tipo', 'LIKE', "%{$busqueda}%");
        });
    }

    /* --- ORDENAMIENTO --- */
    $orden = $request->get('orden', 'fecha_desc');
    switch ($orden) {
        case 'numero_asc':
            $query->orderBy('numero', 'asc');
            break;
        case 'numero_desc':
            $query->orderBy('numero', 'desc');
            break;
        case 'nombre_asc':
            $query->orderBy('nombre', 'asc');
            break;
        case 'nombre_desc':
            $query->orderBy('nombre', 'desc');
            break;
        case 'fecha_asc':
            $query->orderBy('fecha', 'asc');
            break;
        case 'tipo_asc':
            $query->orderBy('tipo', 'asc')->orderBy('fecha', 'desc');
            break;
        case 'categoria_asc':
            $query->join('categories', 'documents.category_id', '=', 'categories.id')
                  ->orderBy('categories.nombre', 'asc')
                  ->orderBy('documents.fecha', 'desc')
                  ->select('documents.*');
            break;
        default: // fecha_desc
            $query->orderBy('fecha', 'desc');
    }

    /* --- PERMISOS (solo si no es admin) --- */
    if (!auth()->user()->is_admin) {
        $allowed = auth()->user()->categoryPermissions()->pluck('category_id');
        $query->whereIn('category_id', $allowed);
    }

    // Paginación con número configurable de elementos
    $perPage = $request->get('per_page', 10); // Por defecto 10
    $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10; // Validar valores permitidos
    $documents = $query->paginate($perPage)->withQueryString();

    // Datos adicionales para los filtros
    $categories = Category::orderBy('nombre')->get();
    $tipos = Document::distinct()->pluck('tipo')->filter()->sort()->values();
    
    // Obtener años únicos del nombre del documento
    $años = Document::selectRaw('SUBSTRING(nombre, LOCATE("2", nombre), 4) as año')
                   ->distinct()
                   ->whereRaw('nombre REGEXP "[0-9]{4}"')
                   ->orderBy('año', 'desc')
                   ->pluck('año')
                   ->filter()
                   ->unique()
                   ->values();

    // Estadísticas para que coincidan con la vista
    $stats = [
        'total' => Document::count(),
        'por_tipo' => Document::selectRaw('tipo, COUNT(*) as count')
                             ->groupBy('tipo')
                             ->pluck('count', 'tipo'),
        'por_categoria' => Category::withCount('documents')->get(),
        'por_año' => Document::selectRaw('SUBSTRING(nombre, LOCATE("2", nombre), 4) as año, COUNT(*) as count')
                           ->whereRaw('nombre REGEXP "[0-9]{4}"')
                           ->groupBy('año')
                           ->orderBy('año', 'desc')
                           ->pluck('count', 'año'),
        'ultimos_30_dias' => Document::where('fecha', '>=', now()->subDays(30))->count(),
    ];

    return view('admin.dashboard', compact(
        'documents', 
        'categories', 
        'tipos', 
        'años', 
        'stats'
    ));
}


    // Formulario para crear documento
    public function create()
    {
       if (auth()->user()->is_admin) {  
        // Admin sees all categories  
        $categories = Category::all();  
        return view('admin.create_document', compact('categories'));  
    } else {  
        // Regular users only see categories they have create permission for  
        $categoryIds = auth()->user()->categoryPermissions()  
                              ->where('can_create', true)  
                              ->pluck('category_id')  
                              ->toArray();  
        $categories = Category::whereIn('id', $categoryIds)->get();  
          
        if ($categories->isEmpty()) {  
            return redirect()->route('user.dashboard')  
                           ->with('error', 'No tienes permiso para crear documentos');  
        }  
          
        return view('users.create_document', compact('categories'));  
    }  
    }

    // Guardar documento
    public function store(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'nombre' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'tipo' => 'required|string',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'category_id' => 'required|exists:categories,id'
        ]);
    
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreOriginal = $archivo->getClientOriginalName(); // Obtener nombre original
            $nombreLimpio = time() . '_' . str_replace(' ', '_', $nombreOriginal); // Evitar espacios y hacer único
    
            $ruta = $archivo->storeAs('documents', $nombreLimpio, 'public'); // Guardar con el mismo nombre
    
            $documento = new Document();
            $documento->nombre = $request->nombre;
            $documento->numero = $request->numero;
            $documento->tipo = $request->tipo;
            $documento->fecha = $request->fecha;
            $documento->category_id = $request->category_id;
            $documento->descripcion = $request->descripcion;
            $documento->archivo = $ruta; // Guardar la ruta en la base de datos
            $documento->save();
            
            return redirect()->back()->with('success', 'Documento subido correctamente.');
        }
    
        return redirect()->back()->with('error', 'Error al subir el documento.');
    }

    // Formulario para editar documento
    public function edit($id)
    {
        $document = Document::findOrFail($id);  
      
    if (auth()->user()->is_admin) {  
        // Admin can edit any document  
        $categories = Category::all();  
        return view('admin.edit_document', compact('document', 'categories'));  
    } else {  
        // Check if user has edit permission for this document's category  
        if (!auth()->user()->hasPermissionFor($document->category_id, 'edit')) {  
            return redirect()->route('user.dashboard')  
                           ->with('error', 'No tienes permiso para editar documentos en esta categoría');  
        }  
          
        // Only show categories the user has create permission for in the dropdown  
        $categoryIds = auth()->user()->categoryPermissions()  
                              ->where('can_edit', true)  
                              ->pluck('category_id')  
                              ->toArray();  
        $categories = Category::whereIn('id', $categoryIds)->get();  
          
        return view('users.edit_document', compact('document', 'categories'));  
    }  
    }

    // Actualizar documento
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);  
      
    // Validate request data  
    $request->validate([  
        'nombre' => 'required|string|max:255',  
        'numero' => 'required|string|max:50',  
        'tipo' => 'required|in:decreto,resolución',  
        'fecha' => 'required|date',  
        'archivo' => 'nullable|file|mimes:pdf,doc,docx',  
        'descripcion' => 'nullable|string',  
        'category_id' => 'required|exists:categories,id'  
    ]);  
      
    if (!auth()->user()->is_admin) {  
        // Check if user has edit permission for this document's category  
        if (!auth()->user()->hasPermissionFor($document->category_id, 'edit')) {  
            return redirect()->route('user.dashboard')  
                           ->with('error', 'No tienes permiso para editar documentos en esta categoría');  
        }  
          
        // Check if user has permission for the new category if it's being changed  
        if ($document->category_id != $request->category_id &&   
            !auth()->user()->hasPermissionFor($request->category_id, 'edit')) {  
            return redirect()->route('user.dashboard')  
                           ->with('error', 'No tienes permiso para mover documentos a esta categoría');  
        }  
    }  
      
    // Continue with document update logic  
    $data = $request->only(['nombre', 'numero', 'tipo', 'fecha', 'descripcion', 'category_id']);  
      
    // Handle file upload if present  
    if ($request->hasFile('archivo')) {  
        // Delete old file  
        if (Storage::disk('public')->exists($document->archivo)) {  
            Storage::disk('public')->delete($document->archivo);  
        }  
        $data['archivo'] = $request->file('archivo')->store('documents', 'public');  
    }  
      
    $document->update($data);  
      
    if (auth()->user()->is_admin) {  
        return redirect()->route('dashboard')->with('success', 'Documento actualizado correctamente');  
    } else {  
        return redirect()->route('user.dashboard')->with('success', 'Documento actualizado correctamente');  
    }  
    }

    // Eliminar documento
    public function destroy($id)
    {
         $document = Document::findOrFail($id);  
      
    if (!auth()->user()->is_admin) {  
        // Check if user has delete permission for this document's category  
        if (!auth()->user()->hasPermissionFor($document->category_id, 'delete')) {  
            return redirect()->route('user.dashboard')  
                           ->with('error', 'No tienes permiso para eliminar documentos en esta categoría');  
        }  
    }  
      
    // Delete the file  
    if (Storage::disk('public')->exists($document->archivo)) {  
        Storage::disk('public')->delete($document->archivo);  
    }  
      
    // Delete the document  
    $document->delete();  
      
    if (auth()->user()->is_admin) {  
        return redirect()->route('dashboard')->with('success', 'Documento eliminado correctamente');  
    } else {  
        return redirect()->route('user.dashboard')->with('success', 'Documento eliminado correctamente');  
    }  
    }


    public function userDashboard()  
{  
    // Obtener documentos filtrados por permisos del usuario  
    $user = auth()->user();  
    $documents = Document::whereHas('category', function($query) use ($user) {  
        $query->whereIn('id', $user->categoryPermissions()->pluck('category_id'));  
    })->orderBy('fecha', 'desc')->get();  
      
    return view('users.dashboard', compact('documents'));  
}
}

