@extends('layouts.app')  
  
@section('title', 'Asignar Categorías a Usuarios')  
  
@section('content')  
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">  
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">  
        <div class="p-6 text-gray-900 dark:text-gray-100">  
            <h2 class="text-2xl font-semibold mb-6">✅ Asignar Categorías a Usuarios</h2>  
              
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
              
            <!-- Formulario para asignar permisos -->  
            <form action="{{ route('permissions.store') }}" method="POST" class="mb-8 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">  
                @csrf  
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">  
                    <div>  
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Usuario</label>  
                        <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>  
                            <option value="">-- Seleccionar Usuario --</option>  
                            @foreach($users as $user)  
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>  
                            @endforeach  
                        </select>  
                    </div>  
                      
                    <div>  
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>  
                        <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>  
                            <option value="">-- Seleccionar Categoría --</option>  
                            @foreach($categories as $category)  
                                <option value="{{ $category->id }}">{{ $category->nombre }}</option>  
                            @endforeach  
                        </select>  
                    </div>  
                </div>  
                  
                <div class="mb-4">  
                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Permisos</span>  
                    <div class="flex space-x-4">  
                        <label class="inline-flex items-center">  
                            <input type="checkbox" name="can_create" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">  
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Crear</span>  
                        </label>  
                        <label class="inline-flex items-center">  
                            <input type="checkbox" name="can_edit" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">  
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Editar</span>  
                        </label>  
                        <label class="inline-flex items-center">  
                            <input type="checkbox" name="can_delete" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">  
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Eliminar</span>  
                        </label>  
                    </div>  
                </div>  
                  
                <div>  
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">  
                        Asignar Permisos  
                    </button>  
                </div>  
            </form>  
              
            <!-- Tabla de permisos existentes -->  
            <h3 class="text-xl font-semibold mb-4">Permisos Asignados</h3>  
              
            @if($permissions->isEmpty())  
                <p class="text-gray-500 dark:text-gray-400">No hay permisos asignados actualmente.</p>  
            @else  
                <div class="overflow-x-auto">  
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">  
                        <thead class="bg-gray-50 dark:bg-gray-800">  
                            <tr>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Usuario</th>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoría</th>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Permisos</th>  
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>  
                            </tr>  
                        </thead>  
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">  
                            @foreach($permissions as $permission)  
                                <tr>  
                                    <td class="px-6 py-4 whitespace-nowrap">  
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $permission->user->name }}</div>  
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $permission->user->email }}</div>  
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap">  
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $permission->category->nombre }}</div>  
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap">  
                                        <div class="flex space-x-2">  
                                            @if($permission->can_create)  
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">  
                                                    Crear  
                                                </span>  
                                            @endif  
                                            @if($permission->can_edit)  
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">  
                                                    Editar  
                                                </span>  
                                            @endif  
                                            @if($permission->can_delete)  
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">  
                                                    Eliminar  
                                                </span>  
                                            @endif  
                                        </div>  
                                    </td>  
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">  
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="inline">  
                                            @csrf  
                                            @method('DELETE')  
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('¿Estás seguro de eliminar este permiso?')">  
                                                Eliminar  
                                            </button>  
                                        </form>  
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