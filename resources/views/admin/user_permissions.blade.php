@extends('layouts.app')

@section('title', 'Asignar Categorías a Usuarios')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-[#43883d] px-6 py-4">
        <h2 class="text-2xl font-ubuntu font-bold text-white">Roles </h2>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-b-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h2 class="text-2xl font-ubuntu font-semibold mb-6 text-center">Asignar Categorías a Usuarios</h2>
            
            @if(session('success'))
                <div class="bg-[#B5CBA1] dark:bg-[#3F8827]/30 border-l-4 border-[#43883d] text-[#285F19] dark:text-[#B5CBA1] p-4 mb-4 font-ubuntu flex items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 dark:bg-red-900/30 border-l-4 border-[#DD0A24] text-[#DD0A24] dark:text-red-400 p-4 mb-4 font-ubuntu flex items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <!-- Formulario para asignar permisos -->
            <div class="mb-8 bg-[#EAECB1]/20 dark:bg-[#43883d]/10 border border-[#B5CBA1] dark:border-[#3F8827] p-6 rounded-lg">
                <h3 class="font-ubuntu font-medium text-gray-700 dark:text-gray-200 mb-4">Nuevo Permiso</h3>
                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="user_id" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Usuario</label>
                            <select name="user_id" id="user_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-[#43883d] focus:ring-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32] dark:bg-gray-700 dark:text-white font-ubuntu" required>
                                <option value="">-- Seleccionar Usuario --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="category_id" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Categoría</label>
                            <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-[#43883d] focus:ring-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32] dark:bg-gray-700 dark:text-white font-ubuntu" required>
                                <option value="">-- Seleccionar Categoría --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <span class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-3">Permisos</span>
                        <div class="flex flex-wrap gap-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="can_create" class="rounded border-gray-300 dark:border-gray-600 text-[#43883d] dark:text-[#51AD32] shadow-sm focus:border-[#43883d] focus:ring-[#43883d] dark:focus:ring-[#51AD32]">
                                <span class="ml-2 text-gray-700 dark:text-gray-300 font-ubuntu">Crear</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="can_edit" class="rounded border-gray-300 dark:border-gray-600 text-[#43883d] dark:text-[#51AD32] shadow-sm focus:border-[#43883d] focus:ring-[#43883d] dark:focus:ring-[#51AD32]">
                                <span class="ml-2 text-gray-700 dark:text-gray-300 font-ubuntu">Editar</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="can_delete" class="rounded border-gray-300 dark:border-gray-600 text-[#43883d] dark:text-[#51AD32] shadow-sm focus:border-[#43883d] focus:ring-[#43883d] dark:focus:ring-[#51AD32]">
                                <span class="ml-2 text-gray-700 dark:text-gray-300 font-ubuntu">Eliminar</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center py-3 px-6 border border-transparent shadow-sm font-ubuntu font-medium rounded-lg text-white bg-[#43883d] hover:bg-[#3F8827] dark:bg-[#51AD32] dark:hover:bg-[#3F8827] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#43883d] dark:focus:ring-[#51AD32] transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Asignar Permisos
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Tabla de permisos existentes -->
            <h3 class="text-xl font-ubuntu font-medium text-gray-700 dark:text-gray-200 mb-4">Permisos Asignados</h3>
            
            @if($permissions->isEmpty())
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 font-ubuntu">No hay permisos asignados actualmente.</p>
                </div>
            @else
                <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-[#43883d]/10 dark:bg-[#43883d]/20">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-ubuntu font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Usuario</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-ubuntu font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-ubuntu font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Permisos</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-ubuntu font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($permissions as $permission)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100 font-ubuntu">{{ $permission->user->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 font-ubuntu">{{ $permission->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100 font-ubuntu">{{ $permission->category->nombre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-wrap gap-2">
                                            @if($permission->can_create)
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-ubuntu font-semibold rounded-full bg-[#B5CBA1] text-[#285F19] dark:bg-[#3F8827] dark:text-white">
                                                    Crear
                                                </span>
                                            @endif
                                            @if($permission->can_edit)
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-ubuntu font-semibold rounded-full bg-[#D8E5B0] text-[#285F19] dark:bg-[#51AD32] dark:text-white">
                                                    Editar
                                                </span>
                                            @endif
                                            @if($permission->can_delete)
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-ubuntu font-semibold rounded-full bg-[#F0A9AA] text-[#C20E1A] dark:bg-[#C20E1A] dark:text-white">
                                                    Eliminar
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center text-[#DD0A24] hover:text-[#C20E1A] dark:text-red-400 dark:hover:text-red-300 font-ubuntu" onclick="return confirm('¿Estás seguro de eliminar este permiso?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
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
    
    <!-- Pie de página con información institucional -->
    <div class="mt-6 text-center">
        <p class="text-xs text-gray-500 dark:text-gray-400 font-ubuntu">Alcaldía de Bucaramanga © 2025</p>
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
        
        .gap-6 {
            gap: 1rem;
        }
    }
</style>
@endsection