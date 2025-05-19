<!-- Vista create_document.blade.php -->
@extends('layouts.app')

@section('title', 'Agregar Concepto')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Agregar Concepto</h2>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Formulario para seleccionar tipo de concepto -->
    <form action="{{ route('concepts.create') }}" method="GET" class="mb-6">
        <!-- Tipo de Concepto -->
        <div class="mb-4">
            <label for="concept_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Concepto</label>
            <select name="concept_type_id" id="concept_type_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()" required>
                <option value="">-- Selecciona un tipo de concepto --</option>
                @foreach($conceptTypes as $type)
                    <option value="{{ $type->id }}" {{ $selectedTypeId == $type->id ? 'selected' : '' }}>{{ $type->nombre }}</option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Formulario principal para crear concepto -->
    @if($selectedTypeId)
    <form action="{{ route('concepts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Tipo de concepto (hidden) -->
        <input type="hidden" name="concept_type_id" value="{{ $selectedTypeId }}">
        
        <!-- Tema -->
        <div class="mb-4">
            <label for="concept_theme_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tema</label>
            <select name="concept_theme_id" id="concept_theme_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">-- Selecciona un tema --</option>
                @if(isset($themesForTypes[$selectedTypeId]))
                    @foreach($themesForTypes[$selectedTypeId] as $theme)
                        <option value="{{ $theme->id }}" {{ old('concept_theme_id') == $theme->id ? 'selected' : '' }}>
                            {{ $theme->nombre }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('concept_theme_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Año -->
        <div class="mb-4">
            <label for="año" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Año</label>
            <select name="año" id="año" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Selecciona el año</option>
                @foreach(range(2022, 2027) as $year)
                    <option value="{{ $year }}" {{ old('año') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
            @error('año')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Número Documento -->
        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Número Documento</label>
            <input type="text" name="titulo" id="titulo" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('titulo') }}" required>
            @error('titulo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fecha Del Documento -->
        <div class="mb-4">
            <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Del Documento</label>
            <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('fecha') }}" required>
            @error('fecha')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Archivo -->
        <div class="mb-4">
            <label for="archivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Archivo</label>
            <input type="file" name="archivo" id="archivo" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
            <p class="text-sm text-gray-500 mt-1">Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX (máx. 2MB)</p>
            @error('archivo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="contenido" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
            <textarea name="contenido" id="contenido" rows="5" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('contenido') }}</textarea>
            @error('contenido')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-end mt-6">
            <a href="{{ route('concepts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md transition-colors mr-2">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors">
                Guardar
            </button>
        </div>
    </form>
    @else
        <div class="text-gray-600 dark:text-gray-400 italic">
            Por favor, selecciona un tipo de concepto para continuar.
        </div>
    @endif
</div>
@endsection