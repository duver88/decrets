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
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }
        if ($request->filled('nombre')) {
            $query->where('nombre', 'LIKE', '%' . $request->nombre . '%');
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $documents = $query->orderBy('fecha', 'desc')->get();
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
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:decreto,resolución',
            'fecha' => 'required|date',
            'archivo' => 'required|file|mimes:pdf,doc,docx', // Ajusta los mime types según lo necesites
            'descripcion' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        // Subir archivo
        if ($request->hasFile('archivo')) {
            $archivoPath = $request->file('archivo')->store('documents', 'public');
        }

        Document::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'fecha' => $request->fecha,
            'archivo' => $archivoPath,
            'descripcion' => $request->descripcion,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Documento subido correctamente');
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
            'tipo' => 'required|in:decreto,resolución',
            'fecha' => 'required|date',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx',
            'descripcion' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->only(['nombre', 'tipo', 'fecha', 'descripcion', 'category_id']);

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

