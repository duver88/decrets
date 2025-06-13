<?php  
  
namespace App\Http\Controllers;  
  
use App\Models\DocumentTheme;  
use App\Models\DocumentType;  
use Illuminate\Http\Request;  
  
class DocumentThemeController extends Controller  
{  
    public function store(Request $request)  
    {  
        $request->validate([  
            'nombre' => 'required|string|max:255',  
            'document_type_id' => 'required|exists:document_types,id'  
        ]);  
  
        // Verificar que no exista el mismo tema para el mismo tipo  
        $exists = DocumentTheme::where('nombre', $request->nombre)  
                              ->where('document_type_id', $request->document_type_id)  
                              ->exists();  
  
        if ($exists) {  
            return redirect()->route('documents.categories')  
                ->with('error', 'Ya existe un tema con ese nombre para este tipo de documento');  
        }  
  
        DocumentTheme::create([  
            'nombre' => $request->nombre,  
            'document_type_id' => $request->document_type_id  
        ]);  
  
        return redirect()->route('documents.categories')  
            ->with('success', 'Tema de documento creado exitosamente');  
    }  
  
    public function destroy($id)  
    {  
        $documentTheme = DocumentTheme::findOrFail($id);  
          
        // Verificar si tiene documentos asociados  
        if ($documentTheme->documents()->count() > 0) {  
            return redirect()->route('documents.categories')  
                ->with('error', 'No se puede eliminar el tema porque tiene documentos asociados');  
        }  
  
        $documentTheme->delete();  
  
        return redirect()->route('documents.categories')  
            ->with('success', 'Tema de documento eliminado exitosamente');  
    }  
}