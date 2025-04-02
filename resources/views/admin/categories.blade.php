<!-- resources/views/admin/categories.blade.php -->
@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestión de Categorías</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para agregar categoría -->
    <form action="{{ route('category.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nueva Categoría</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre de la categoría" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Agregar Categoría
        </button>
    </form>

    <!-- Listado de categorías -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Categoría</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                <tr>
                    <td class="px-4 py-2 text-gray-800">{{ $category->nombre }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" 
                              onsubmit="return confirm('¿Deseas eliminar esta categoría? Se eliminarán documentos relacionados.')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-4 py-2 text-center text-gray-600">No hay categorías registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
