<!-- Vista dashboard con cards en lugar de tabla -->
@extends('layouts.app')

@section('title', 'Dashboard - Documentos')

@section('content')
<!-- Tarjetas de resumen -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Documentos -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-[#43883d]">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-[#EAECB1] text-[#43883d]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-ubuntu font-semibold text-gray-700 dark:text-gray-200">Total Documentos</h2>
                <p class="mt-2 text-3xl font-ubuntu font-bold text-[#43883d] dark:text-[#93C01F]">{{ count($documents) }}</p>
            </div>
        </div>
    </div>
    
    <!-- Decretos -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-[#f8dc0b]">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-[#FCF2B1] text-amber-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-ubuntu font-semibold text-gray-700 dark:text-gray-200">Decretos</h2>
                <p class="mt-2 text-3xl font-ubuntu font-bold text-amber-600 dark:text-amber-500">{{ $documents->filter(fn($doc) => strtolower($doc->tipo) === 'decreto')->count() }}</p>
            </div>
        </div>
    </div>
    
    <!-- Resoluciones -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-red-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-[#F0A9AA] text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-ubuntu font-semibold text-gray-700 dark:text-gray-200">Resoluciones</h2>
                <p class="mt-2 text-3xl font-ubuntu font-bold text-red-600 dark:text-red-500">{{ $documents->filter(fn($doc) => strtolower($doc->tipo) === 'resolución')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Encabezado y botón agregar -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
    <h1 class="text-2xl font-ubuntu font-bold text-[#43883d] dark:text-[#93C01F] mb-4 md:mb-0">Listado de Documentos</h1>
    <a href="{{ route('document.create') }}" class="inline-flex items-center px-4 py-2 bg-[#43883d] hover:bg-[#3F8827] text-white rounded-md shadow-sm transition duration-150 ease-in-out">
        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Agregar Documento
    </a>
</div>

<!-- Mensaje de éxito -->
@if(session('success'))
    <div class="bg-[#D8E5B0] border-l-4 border-[#3F8827] text-[#285F19] p-4 mb-6 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-[#3F8827]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<!-- Grid de cards para documentos -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($documents as $document)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-shadow hover:shadow-lg">
            <!-- Cabecera de la card con color según tipo de documento -->
            <div class="p-4 {{ ucfirst($document->tipo) == 'Decreto' ? 'bg-[#FCF2B1]/40' : 'bg-[#43883d]/40' }}">
                <div class="flex justify-between items-start">
                    <!-- Categoría y Tipo -->
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#D8E5B0] text-[#285F19]">
                            {{ $document->category->nombre ?? 'Sin categoría' }}
                        </span>
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $document->tipo == 'Decreto' ? 'bg-[#FCF2B1] text-amber-800' : 'bg-[#F0A9AA] text-red-800' }}">
                            {{ ucfirst($document->tipo) }}
                        </span>
                    </div>
                    
                    <!-- Ícono según tipo de documento -->
                    <div class="{{ ucfirst($document->tipo) == 'Decreto' ? 'text-amber-600' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Contenido principal de la card -->
            <div class="p-5">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    {{ ucfirst($document->tipo) }}: No {{$document->numero}} de {{$document->nombre}}

                </h3>
                
                <!-- Metadatos del documento -->
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400 mb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Fecha: {{ \Carbon\Carbon::parse($document->fecha)->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Creado: {{ $document->created_at->diffForHumans() }}</span>
                    </div>
                    
                </div>
                
                <!-- Acciones para el documento -->
                <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ asset('storage/' . $document->archivo) }}" target="_blank" 
                        class="text-[#43883d] hover:text-[#3F8827] dark:text-[#93C01F] dark:hover:text-[#93C01F]/80 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>Ver</span>
                    </a>
                    
                    <div class="space-x-2">
                        <a href="{{ route('document.edit', $document->id) }}" 
                            class="inline-flex items-center px-3 py-1.5 bg-[#f8dc0b] hover:bg-[#FCF2B1] text-[#285F19] rounded-md text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Editar
                        </a>
                        
                        <form action="{{ route('document.destroy', $document->id) }}" method="POST" class="inline-block" 
                            onsubmit="return confirm('¿Seguro que deseas eliminar este documento?')">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-10 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-5">No hay documentos registrados.</p>
                <a href="{{ route('document.create') }}" class="inline-flex items-center px-4 py-2 bg-[#43883d] hover:bg-[#3F8827] text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear primer documento
                </a>
            </div>
        </div>
    @endforelse
</div>
@endsection