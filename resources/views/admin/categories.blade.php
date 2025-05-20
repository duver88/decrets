@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="max-w-6xl mx-auto my-8 px-4 sm:px-6 lg:px-8">
    <!-- Cabecera con identidad institucional -->
    <div class="bg-[#43883d] rounded-t-lg p-4 flex justify-center">
        <div class="flex items-center justify-center">
            <div class="w-16 h-16 flex items-center justify-center">
                <img src="{{ asset('images/escudo_blanco.png') }}" alt="Escudo Alcaldía de Bucaramanga" class="w-12 h-12">
            </div>
        </div>
    </div>
    
    <!-- Contenido principal -->
    <div class="bg-white shadow-lg rounded-b-lg p-6">
        <h2 class="text-2xl font-ubuntu font-semibold text-gray-800 mb-6 text-center">Gestión de Categorías</h2>

        @if(session('success'))
            <div class="bg-[#B5CBA1] border border-[#43883d] text-[#285F19] px-4 py-3 rounded-lg mb-6 font-ubuntu flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para agregar categoría con diseño institucional -->
        <div class="bg-[#EAECB1]/20 border border-[#B5CBA1] rounded-lg p-6 mb-8">
            <h3 class="font-ubuntu font-medium text-gray-700 mb-4">Agregar Nueva Categoría</h3>
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block font-ubuntu font-medium text-gray-700 mb-2">Nombre de la categoría</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre de la categoría" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 font-ubuntu focus:outline-none focus:ring-2 focus:ring-[#43883d] focus:border-[#43883d]">
                    @error('nombre')
                        <p class="text-[#DD0A24] text-sm mt-1 font-ubuntu">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#43883d] hover:bg-[#3F8827] text-white font-ubuntu font-medium px-6 py-3 rounded-lg transition duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Agregar Categoría
                    </button>
                </div>
            </form>
        </div>

        <!-- Listado de categorías -->
        <h3 class="font-ubuntu font-medium text-gray-700 mb-4">Categorías Existentes</h3>
        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#43883d]/10">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-700 font-ubuntu font-medium tracking-wider">Categoría</th>
                        <th class="px-6 py-3 text-right text-gray-700 font-ubuntu font-medium tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-ubuntu text-gray-800">{{ $category->nombre }}</td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" 
                                onsubmit="return confirm('¿Estás seguro de eliminar esta categoría? Se eliminarán todos los documentos relacionados.')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="bg-[#DD0A24] hover:bg-[#C20E1A] text-white font-ubuntu px-4 py-2 rounded-lg text-sm transition duration-300 flex items-center ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center font-ubuntu text-gray-500">No hay categorías registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pie de página con información institucional -->
    <div class="mt-6 text-center">
        <p class="text-xs text-gray-500 font-ubuntu">Alcaldía de Bucaramanga © 2025</p>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap');
    
    .font-ubuntu {
        font-family: 'Ubuntu', sans-serif;
    }
    
    @media (max-width: 640px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }
</style>
@endsection