@extends('layouts.app')

@section('title', 'Editar Documento')

@section('content')
<div class="max-w-4xl mx-auto my-8">
    <!-- Cabecera con el logo institucional -->
    <!-- Cabecera del formulario con el color verde institucional -->
    <div class="bg-[#43883d] px-6 py-4">
        <h2 class="text-2xl font-ubuntu font-bold text-white">Editar Documento</h2>
    </div>

    <div class="bg-white shadow-lg rounded-b-lg p-8">
       
        
        <form action="{{ route('document.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Categoría -->
            <div class="mb-4">
                <label for="category_id" class="block font-ubuntu font-medium text-gray-700 mb-2">Categoría</label>
                <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu">
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $document->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Año -->
                <div>
                    <label for="nombre" class="block font-ubuntu font-medium text-gray-700 mb-2">Año</label>
                    <select name="nombre" id="nombre" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu" required>
                        <option value="">Selecciona el año</option>
                        @foreach(range(2022, 2027) as $year)
                            <option value="{{ $year }}" {{ old('nombre', $document->nombre) == (string)$year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                    @error('nombre')
                        <p class="text-red-500 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Número -->
                <div>
                    <label for="numero" class="block font-ubuntu font-medium text-gray-700 mb-2">Número Documento</label>
                    <input type="text" name="numero" id="numero" required class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu"
                        value="{{ old('numero', $document->numero) }}">
                    @error('numero')
                        <p class="text-red-500 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Fecha -->
                <div>
                    <label for="fecha" class="block font-ubuntu font-medium text-gray-700 mb-2">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu"
                        value="{{ old('fecha', $document->fecha) }}">
                </div>

                <!-- Tipo -->
                <div>
                    <label for="tipo" class="block font-ubuntu font-medium text-gray-700 mb-2">Tipo de Documento</label>
                    <select name="tipo" id="tipo" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu">
                        <option value="decreto" {{ $document->tipo == 'decreto' ? 'selected' : '' }}>Decreto</option>
                        <option value="resolución" {{ $document->tipo == 'resolución' ? 'selected' : '' }}>Resolución</option>
                    </select>
                </div>
            </div>

            <!-- Archivo -->
            <div class="border border-[#B5CBA1] rounded-lg p-4 bg-[#EAECB1]/20">
                <label for="archivo" class="block font-ubuntu font-medium text-gray-700 mb-2">Archivo (opcional)</label>
                <div class="flex items-center">
                    <div class="bg-[#43883d] text-white rounded-lg px-4 py-2 cursor-pointer hover:bg-[#3F8827] transition mr-3">
                        <label for="archivo" class="cursor-pointer font-ubuntu">Seleccionar archivo</label>
                    </div>
                    <input type="file" name="archivo" id="archivo" class="hidden">
                    <span id="file-name" class="text-sm text-gray-600 font-ubuntu">Ningún archivo seleccionado</span>
                </div>
                @if($document->archivo)
                    <div class="mt-3 flex items-center">
                        <div class="text-[#43883d] mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 font-ubuntu">
                            Archivo actual: 
                            <a href="{{ asset('storage/'.$document->archivo) }}" target="_blank" class="text-[#43883d] underline">Ver / Descargar</a>
                        </p>
                    </div>
                @endif
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block font-ubuntu font-medium text-gray-700 mb-2">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#43883d] focus:border-[#43883d] font-ubuntu resize-none">{{ old('descripcion', $document->descripcion) }}</textarea>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('dashboard') }}" class="bg-gray-400 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-500 transition font-ubuntu">Cancelar</a>
                <button type="submit" class="bg-[#43883d] text-white px-6 py-3 rounded-lg shadow hover:bg-[#3F8827] transition font-ubuntu font-medium">Actualizar</button>
            </div>
        </form>
    </div>

    <!-- Pie de página con información institucional -->
    <div class="mt-6 text-center">
        <p class="text-xs text-gray-500 font-ubuntu">Alcaldía de Bucaramanga © 2025</p>
    </div>
</div>

<script>
    // Script para mostrar el nombre del archivo seleccionado
    document.getElementById('archivo').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Ningún archivo seleccionado';
        document.getElementById('file-name').textContent = fileName;
    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap');
    
    .font-ubuntu {
        font-family: 'Ubuntu', sans-serif;
    }
</style>
@endsection