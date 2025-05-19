@extends('layouts.app')

@section('title', 'Detalles del Concepto')

@section('content')
<div class="bg-white dark:bg-gray-900 rounded-lg shadow-xl overflow-hidden max-w-4xl mx-auto mt-10">
    <!-- Encabezado -->
    <div class="p-8 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight">
                {{ $concept->conceptType->nombre ?? 'Sin tipo' }}: <span class="text-blue-600 dark:text-blue-400">{{ $concept->titulo }}</span>
            </h1>
            <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm sm:text-base">
                Tema: <span class="font-semibold">{{ $concept->conceptTheme->nombre ?? 'Sin tema' }}</span> |
                Año: <span class="font-semibold">{{ $concept->año }}</span>
            </p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ asset('storage/' . $concept->archivo) }}" target="_blank"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold transition duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-600 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Descargar
            </a>
            <a href="{{ route('concepts.index') }}"
                class="inline-flex items-center px-5 py-2 rounded-md bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium transition duration-300 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                Volver
            </a>
        </div>
    </div>

    <!-- Metadatos -->
    <div class="px-8 py-6 bg-gray-50 dark:bg-gray-800 grid grid-cols-1 sm:grid-cols-3 gap-8 text-gray-600 dark:text-gray-300 text-sm sm:text-base font-medium">
        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>Fecha: {{ \Carbon\Carbon::parse($concept->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}</span>
        </div>

        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Creado: {{ $concept->created_at->translatedFormat('d \d\e F \d\e\l Y, H:i') }}</span>
        </div>

        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Autor: {{ $concept->user->name ?? 'Usuario desconocido' }}</span>
        </div>

        @php
            $extension = strtolower(pathinfo($concept->archivo, PATHINFO_EXTENSION));
        @endphp
        <div class="flex items-center space-x-3 sm:col-span-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Formato: <span class="uppercase font-semibold">{{ $extension }}</span></span>
        </div>
    </div>

    <!-- Contenido -->
    <div class="px-8 py-8 bg-white dark:bg-gray-900">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6 border-b border-gray-300 dark:border-gray-700 pb-3">
            Descripción
        </h2>
        <div class="prose dark:prose-invert max-w-none leading-relaxed text-gray-700 dark:text-gray-300">
            {!! nl2br(e($concept->contenido)) !!}
        </div>
    </div>

    <!-- Acciones -->
    @if(auth()->user()->is_admin || auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'edit') || auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'delete'))
    <div class="px-8 py-6 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
        @if(auth()->user()->is_admin || auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'edit'))
        <a href="{{ route('concepts.edit', $concept->id) }}"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-yellow-500 hover:bg-yellow-600 text-white font-semibold transition duration-300 focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-500 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Editar
        </a>
        @endif

        @if(auth()->user()->is_admin || auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'delete'))
        <form action="{{ route('concepts.destroy', $concept->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este concepto? Esta acción no se puede deshacer.')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold transition duration-300 focus:outline-none focus:ring-4 focus:ring-red-400 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Eliminar
            </button>
        </form>
        @endif
    </div>
    @endif
</div>
@endsection
