@extends('layouts.app')

@section('title', 'Agregar Documento')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Agregar Documento</h2>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
            <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nombre }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Título</label>
            <input type="text" name="nombre" id="nombre" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required value="{{ old('nombre') }}">
            @error('nombre')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="numero" class="block text-sm font-medium text-gray-700">Número Documento</label>
            <input type="text" name="numero" id="numero" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required value="{{ old('numero') }}">
            @error('numero')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required value="{{ old('fecha') }}">
            @error('fecha')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="archivo" class="block text-sm font-medium text-gray-700">Archivo</label>
            <input type="file" name="archivo" id="archivo" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" accept=".pdf,.doc,.docx" required>
            @error('archivo')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
            <select name="tipo" id="tipo" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="decreto" {{ old('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
                <option value="resolución" {{ old('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
            </select>
            @error('tipo')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Guardar</button>
        </div>
    </form>
</div>
@endsection
