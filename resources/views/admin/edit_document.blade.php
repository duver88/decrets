@extends('layouts.app')

@section('title', 'Editar Documento')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">✏️ Editar Documento</h2>

    <form action="{{ route('document.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Categoría -->
        <div>
            <label for="category_id" class="block font-medium text-gray-700">Categoría</label>
            <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $document->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Título -->
        <div>
            <label for="nombre" class="block font-medium text-gray-700">Año</label>
            <select name="nombre" id="nombre" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Selecciona el año</option>
                @foreach(range(2022, 2027) as $year)
                    <option value="{{ $year }}" {{ old('nombre', $document->nombre) == (string)$year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Número -->
        <div>
            <label for="numero" class="block font-medium text-gray-700">Número Documento</label>
            <input type="text" name="numero" id="numero" required class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('numero', $document->numero) }}">
            @error('numero')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fecha -->
        <div>
            <label for="fecha" class="block font-medium text-gray-700">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                   value="{{ old('fecha', $document->fecha) }}">
        </div>

        <!-- Archivo -->
        <div>
            <label for="archivo" class="block font-medium text-gray-700">Archivo (opcional)</label>
            <input type="file" name="archivo" id="archivo" class="w-full border-gray-300 rounded-lg shadow-sm p-2">
            @if($document->archivo)
                <p class="mt-2 text-sm text-gray-600">📂 Archivo actual: 
                    <a href="{{ asset('storage/'.$document->archivo) }}" target="_blank" class="text-blue-500 underline">Ver / Descargar</a>
                </p>
            @endif
        </div>

        <!-- Tipo -->
        <div>
            <label for="tipo" class="block font-medium text-gray-700">Tipo de Documento</label>
            <select name="tipo" id="tipo" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="decreto" {{ $document->tipo == 'decreto' ? 'selected' : '' }}>Decreto</option>
                <option value="resolución" {{ $document->tipo == 'resolución' ? 'selected' : '' }}>Resolución</option>
            </select>
        </div>

        <!-- Descripción -->
        <div>
            <label for="descripcion" class="block font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion', $document->descripcion) }}</textarea>
        </div>

        <!-- Botones -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('dashboard') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-500 transition">Cancelar</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">Actualizar</button>
        </div>
    </form>
</div>
@endsection
