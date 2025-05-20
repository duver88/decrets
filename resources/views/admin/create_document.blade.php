@extends('layouts.app')

@section('title', 'Agregar Documento')

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    <!-- Cabecera del formulario con el color verde institucional -->
    <div class="bg-[#43883d] px-6 py-4">
        <h2 class="text-2xl font-ubuntu font-bold text-white">Agregar Documento</h2>
    </div>
    
    <!-- Notificación de éxito -->
    @if(session('success'))
        <div class="bg-[#D8E5B0] border-l-4 border-[#3F8827] text-[#285F19] p-4 mx-6 mt-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-[#3F8827]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="font-ubuntu text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Formulario con estilos mejorados -->
    <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Categoría -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                <select name="category_id" id="category_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu">
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Año -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Año</label>
                <select name="nombre" id="nombre" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu" required>
                    <option value="">Selecciona el año</option>
                    @foreach(range(2022, 2027) as $year)
                        <option value="{{ $year }}" {{ old('nombre') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Número Documento -->
            <div>
                <label for="numero" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Número Documento</label>
                <input type="text" name="numero" id="numero" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu" required value="{{ old('numero') }}">
                @error('numero')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha Del Documento -->
            <div>
                <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Del Documento</label>
                <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu" required value="{{ old('fecha') }}">
                @error('fecha')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Archivo -->
            <div>
                <label for="archivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Archivo</label>
                <div class="mt-1 flex items-center">
                    <label class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span class="font-ubuntu">Seleccionar archivo</span>
                        <input type="file" name="archivo" id="archivo" class="sr-only" accept=".pdf,.doc,.docx" required>
                    </label>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Formatos permitidos: PDF, DOC, DOCX</p>
                <p id="file-name" class="text-sm text-gray-600 dark:text-gray-400 mt-2"></p>
                @error('archivo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipo de Documento -->
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Documento</label>
                <div class="mt-2 space-y-2">
                    <div class="flex items-center">
                        <input type="radio" id="tipo_decreto" name="tipo" value="Decreto" class="h-4 w-4 text-[#43883d] focus:ring-[#43883d] border-gray-300 dark:border-gray-600" {{ old('tipo', 'Decreto') == 'Decreto' ? 'checked' : '' }}>
                        <label for="tipo_decreto" class="ml-2 block text-sm text-gray-700 dark:text-gray-300 font-ubuntu">
                            Decreto
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="tipo_resolucion" name="tipo" value="Resolución" class="h-4 w-4 text-[#43883d] focus:ring-[#43883d] border-gray-300 dark:border-gray-600" {{ old('tipo') == 'Resolución' ? 'checked' : '' }}>
                        <label for="tipo_resolucion" class="ml-2 block text-sm text-gray-700 dark:text-gray-300 font-ubuntu">
                            Resolución
                        </label>
                    </div>
                </div>
                @error('tipo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Descripción -->
        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones de acción -->
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 rounded-md transition-colors font-ubuntu">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-[#43883d] hover:bg-[#3F8827] text-white rounded-md transition-colors shadow-sm font-ubuntu flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Guardar Documento
            </button>
        </div>
    </form>
</div>

<!-- Script para mostrar el nombre del archivo seleccionado -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('archivo');
        const fileNameDisplay = document.getElementById('file-name');
        
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = 'Archivo seleccionado: ' + fileInput.files[0].name;
            } else {
                fileNameDisplay.textContent = '';
            }
        });
    });
</script>
@endsection