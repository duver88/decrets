@extends('layouts.app')

@section('title', 'Relatoría Conceptos')

@section('content')
    <!-- Botones de acceso rápido -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <a href="{{ route('document.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md p-4 flex items-center transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="font-medium">Crear Documento</span>
        </a>
        <a href="{{ route('category.index') }}" class="bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-md p-4 flex items-center transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <span class="font-medium">Categorías</span>
        </a>
        @if(auth()->user()->is_admin)
        <a href="{{ route('permissions.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow-md p-4 flex items-center transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span class="font-medium">Asignar Permisos</span>
        </a>
        @endif
    </div>

    <!-- Contenido de la lista de documentos original -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Conceptos</h2>
            <a href="{{ route('concepts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors">
                Nuevo Concepto
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Aquí iría tu código existente para listar documentos -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Título</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Aquí va tu bucle foreach de documentos -->
                    <!-- Si estás usando la vista para conceptos, deberías ajustar esto según sea necesario -->
                </tbody>
            </table>
        </div>
        
        <!-- Paginación si existe -->
    </div>
@endsection