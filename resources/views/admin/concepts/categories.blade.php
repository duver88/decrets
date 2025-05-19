@extends('layouts.app')

@section('title', 'Categorías de Conceptos')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Formulario para crear tipo de concepto -->
    <div class="md:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Nuevo Tipo de Concepto</h2>
        
        <form action="{{ route('concepts.storeType') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors">
                Guardar Tipo
            </button>
        </form>
    </div>

    <!-- Formulario para crear tema -->
    <div class="md:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Nuevo Tema</h2>
        
        <form action="{{ route('concepts.storeTheme') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="concept_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Concepto</label>
                <select name="concept_type_id" id="concept_type_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Seleccione un tipo</option>
                    @foreach($conceptTypes as $type)
                        <option value="{{ $type->id }}" {{ old('concept_type_id') == $type->id ? 'selected' : '' }}>{{ $type->nombre }}</option>
                    @endforeach
                </select>
                @error('concept_type_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre del Tema</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md transition-colors">
                Guardar Tema
            </button>
        </form>
    </div>

    <!-- Lista de tipos y temas -->
    <div class="md:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Tipos y Temas Existentes</h2>
        
        @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse($conceptTypes as $type)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $type->nombre }}</h3>
                        
                        <form action="{{ route('concepts.destroyType', $type->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Estás seguro? Esto eliminará todos los temas asociados.')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    @if($type->descripcion)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $type->descripcion }}</p>
                    @endif
                    
                    @if($type->themes->count() > 0)
                        <div class="mt-3">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Temas:</h4>
                            <ul class="space-y-1">
                                @foreach($type->themes as $theme)
                                    <li class="flex justify-between items-center text-sm">
                                        <span class="text-gray-700 dark:text-gray-300">{{ $theme->nombre }}</span>
                                        
                                        <form action="{{ route('concepts.destroyTheme', $theme->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Estás seguro de eliminar este tema?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 italic mt-2">No hay temas definidos</p>
                    @endif
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400 text-center py-4">No hay tipos de conceptos definidos</p>
            @endforelse
        </div>
    </div>
</div>
@endsection