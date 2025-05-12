@extends('layouts.app')  
  
@section('title', 'Editar Documento')  
  
@section('content')  
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">  
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">  
        <div class="p-6 text-gray-900 dark:text-gray-100">  
            <h2 class="text-2xl font-semibold mb-6">✏️ Editar Documento</h2>  
              
            @if(session('success'))  
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">  
                    <p>{{ session('success') }}</p>  
                </div>  
            @endif  
              
            @if(session('error'))  
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">  
                    <p>{{ session('error') }}</p>  
                </div>  
            @endif  
              
            <form action="{{ route('user.document.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">  
                @csrf  
                @method('PUT')  
                  
                <div>  
                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>  
                    <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>  
                        <option value="">-- Selecciona una categoría --</option>  
                        @foreach($categories as $category)  
                            <option value="{{ $category->id }}" {{ old('category_id', $document->category_id) == $category->id ? 'selected' : '' }}>  
                                {{ $category->nombre }}  
                            </option>  
                        @endforeach  
                    </select>  
                    @error('category_id')  
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                    @enderror  
                </div>  
                  
                <div>  
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>  
                    <input type="text" name="nombre" id="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('nombre', $document->nombre) }}" required>  
                    @error('nombre')  
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                    @enderror  
                </div>  
                  
                <div>  
                    <label for="numero" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número Documento</label>  
                    <input type="text" name="numero" id="numero" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('numero', $document->numero) }}" required>  
                    @error('numero')  
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                    @enderror  
                </div>  
                  
                <div>  
                    <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha</label>  
                    <input type="date" name="fecha" id="fecha" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('fecha', $document->fecha) }}" required>  
                    @error('fecha')  
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                    @enderror  
                </div>  
                  
                <div>  
                    <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Documento</label>  
                    <select name="tipo" id="tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>  
                        <option value="decreto" {{ old('tipo', $document->tipo) == 'decreto' ? 'selected' : '' }}>Decreto</option>  
                        <option value="resolución" {{ old('tipo', $document->tipo) == 'resolución' ? 'selected' : '' }}>Resolución</option>  
                    </select>  
                    @error('tipo')  
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                    @enderror  
                </div>  
                  
                <div>  
                    <label for="archivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Archivo (Dejar en blanco para mantener el actual)</label>  
                    <input type="file" name="archivo" id="archivo" class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-300" accept=".pdf,.doc,.docx,.xls,.xlsx">  
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Archivo actual: {{ basename($document->archivo) }}</p>  
                    @error('archivo')  
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                    @enderror  
                </div>  
                  
                <div>  
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>  
                    <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('descripcion', $document->descripcion) }}</textarea>  
                    @error('descripcion')  
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>  
                    @enderror  
                </div>  
                  
                <div class="flex justify-end space-x-2 pt-4">  
                    <a href="{{ route('user.dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">  
                        Cancelar  
                    </a>  
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">  
                        Actualizar Documento  
                    </button>  
                </div>  
            </form>  
        </div>  
    </div>  
</div>  
@endsection