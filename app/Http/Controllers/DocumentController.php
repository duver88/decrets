<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Método para la vista pública
    public function listPublic(Request $request)
    {
        $query = Document::query();

    if ($request->filled('tipo')) {
        $query->where('tipo', $request->tipo);
    }
    if ($request->filled('numero')) {
        $query->where('numero', 'LIKE', '%' . $request->numero . '%');
    }
    if ($request->filled('nombre')) {
        $query->where('nombre', 'LIKE', '%' . $request->nombre . '%');
    }

    // Ordenar según el parámetro 'orden'
    if ($request->orden === 'numero') {
        $query->orderBy('numero', 'asc'); // Menor a mayor
    } elseif ($request->orden === 'nombre') {
        $query->orderBy('nombre', 'asc'); // A-Z
    } else {
        $query->orderBy('fecha', 'desc'); // Default: más recientes primero
    }

    $documents = $query->get();
    $categories = Category::all();

    return view('public.documents', compact('documents', 'categories'));
    }

    // Vista para ver más o descargar documento
    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('public.document_detail', compact('document'));
    }

    // Dashboard - listado de documentos para admin
    public function index()
    {
        $documents = Document::orderBy('fecha', 'desc')->get();
        return view('admin.dashboard', compact('documents'));
    }

    // Formulario para crear documento
    public function create()
    {
        $categories = Category::all();
        return view('admin.create_document', compact('categories'));
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
        $categories = Category::all();
        return view('admin.edit_document', compact('document', 'categories'));
    }

    // Actualizar documento
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'tipo' => 'required|in:decreto,resolución',
            'fecha' => 'required|date',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx',
            'descripcion' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->only(['nombre','numero', 'tipo', 'fecha', 'descripcion', 'category_id']);

        // Si se sube un nuevo archivo
        if ($request->hasFile('archivo')) {
            // Eliminar el archivo anterior si existe
            if (Storage::disk('public')->exists($document->archivo)) {
                Storage::disk('public')->delete($document->archivo);
            }
            $data['archivo'] = $request->file('archivo')->store('documents', 'public');
        }

        $document->update($data);

        return redirect()->route('dashboard')->with('success', 'Documento actualizado correctamente');
    }

    // Eliminar documento
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        if (Storage::disk('public')->exists($document->archivo)) {
            Storage::disk('public')->delete($document->archivo);
        }
        $document->delete();

        return redirect()->route('dashboard')->with('success', 'Documento eliminado correctamente');
    }
}

