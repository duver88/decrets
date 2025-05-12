@extends('layouts.app')  
  
@section('title', 'Dashboard de Usuario')  
  
@section('content')  
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">  
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">  
        <div class="p-6 text-gray-900 dark:text-gray-100">  
            <div class="flex justify-between items-center mb-6">  
                <h2 class="text-2xl font-semibold">📄 Mis Documentos</h2>  
                  
                @if(auth()->user()->categoryPermissions()->where('can_create', true)->exists())  
                <a href="{{ route('user.document.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">  
                    <i class="fa fa-plus-circle mr-2"></i> Crear Documento  
                </a>  
                @endif  
            </div>  
              
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
              
            @if($documents->isEmpty())  
                <div class="text-center py-8">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />  
                    </svg>  
                    <p class="text-gray-500 dark:text-gray-400">No tienes documentos asignados a tus categorías.</p>  
                    @if(auth()->user()->categoryPermissions()->where('can_create', true)->exists())  
                        <a href="{{ route('user.document.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">  
                            Crear tu primer documento  
                        </a>  
                    @endif  
                </div>  
            @else  
                <div class="overflow-x-auto">  
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">  
                        <thead class="bg-gray-50 dark:bg-gray-800">  
                            <tr>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoría</th>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Título</th>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Número</th>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipo</th>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>  
                            </tr>  
                        </thead>  
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">  
                            @foreach($documents as $document)  
                                <tr>  
                                    <td class="px-6 py-4 whitespace-nowrap">  
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $document->category->nombre }}</div>  
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap">  
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $document->nombre }}</div>  
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap">  
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $document->numero }}</div>  
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap">  
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $document->fecha }}</div>  
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap">  
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ ucfirst($document->tipo) }}</div>  
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">  
                                        <div class="flex space-x-2">  
                                            <a href="{{ route('document.show', $document->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" target="_blank">  
                                                Ver  
                                            </a>  
                                              
                                            @if(auth()->user()->hasPermissionFor($document->category_id, 'edit'))  
                                                <a href="{{ route('user.document.edit', $document->id) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">  
                                                    Editar  
                                                </a>  
                                            @endif  
                                              
                                            @if(auth()->user()->hasPermissionFor($document->category_id, 'delete'))  
                                                <form action="{{ route('user.document.destroy', $document->id) }}" method="POST" class="inline">  
                                                    @csrf  
                                                    @method('DELETE')  
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('¿Estás seguro de eliminar este documento?')">  
                                                        Eliminar  
                                                    </button>  
                                                </form>  
                                            @endif  
                                        </div>  
                                    </td>  
                                </tr>  
                            @endforeach  
                        </tbody>  
                    </table>  
                </div>  
            @endif  
        </div>  
    </div>  
</div>  
@endsection