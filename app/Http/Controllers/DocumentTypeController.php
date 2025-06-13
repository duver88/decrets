<?php  
  
namespace App\Http\Controllers;  
  
use App\Models\DocumentType;  
use App\Models\DocumentTheme;  
use Illuminate\Http\Request;  
  
class DocumentTypeController extends Controller  
{  
    public function index()  
    {  
        $documentTypes = DocumentType::with('themes')->orderBy('nombre')->get();  
        $documentThemes = DocumentTheme::with('documentType')->orderBy('nombre')->get();  
          
        return view('documents.categories', compact('documentTypes', 'documentThemes'));  
    }  
  
    public function store(Request $request)  
    {  
        $request->validate([  
            'nombre' => 'required|string|max:255|unique:document_types,nombre',  
            'descripcion' => 'nullable|string'  
        ]);  
  
        DocumentType::create([  
            'nombre' => $request->nombre,  
            'descripcion' => $request->descripcion  
        ]);  
  
        return redirect()->route('documents.categories')  
            ->with('success', 'Tipo de documento creado exitosamente');  
    }  
  
    public function destroy($id)  
    {  
        $documentType = DocumentType::findOrFail($id);  
          
        // Verificar si tiene documentos asociados  
        if ($documentType->documents()->count() > 0) {  
            return redirect()->route('documents.categories')  
                ->with('error', 'No se puede eliminar el tipo porque tiene documentos asociados');  
        }  
  
        // Eliminar temas asociados  
        $documentType->themes()->delete();  
        $documentType->delete();  
  
        return redirect()->route('documents.categories')  
            ->with('success', 'Tipo de documento eliminado exitosamente');  
    }  
}