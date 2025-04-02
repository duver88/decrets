<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Listar categorías en el dashboard
    public function index()
    {
        $categories = Category::orderBy('nombre')->get();
        return view('admin.categories', compact('categories'));
    }

    // Guardar nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Category::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->back()->with('success', 'Categoría creada correctamente');
    }

    // Eliminar categoría
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Categoría eliminada correctamente');
    }
}
