@extends('layouts.app')

@section('title', 'Asignar Permisos')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Asignar Permisos para Conceptos</h2>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('concepts.updatePermissions') }}" method="POST">
        @csrf
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Usuario</th>
                        @foreach($conceptTypes as $type)
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                {{ $type->nombre }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $user->name }}
                            </td>
                            
                            @foreach($conceptTypes as $type)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="permissions[{{ $user->id }}][{{ $type->id }}][create]" value="1" 
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                                   {{ $user->conceptTypes->contains(function($item) use ($type) {
                                                       return $item->id === $type->id && $item->pivot->can_create;
                                                   }) ? 'checked' : '' }}>
                                            <span class="ml-2">Crear</span>
                                        </label>
                                        
                                        <label class="flex items-center">
                                            <input type="checkbox" name="permissions[{{ $user->id }}][{{ $type->id }}][edit]" value="1" 
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                                   {{ $user->conceptTypes->contains(function($item) use ($type) {
                                                       return $item->id === $type->id && $item->pivot->can_edit;
                                                   }) ? 'checked' : '' }}>
                                            <span class="ml-2">Editar</span>
                                        </label>
                                        
                                        <label class="flex items-center">
                                            <input type="checkbox" name="permissions[{{ $user->id }}][{{ $type->id }}][delete]" value="1" 
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                                   {{ $user->conceptTypes->contains(function($item) use ($type) {
                                                       return $item->id === $type->id && $item->pivot->can_delete;
                                                   }) ? 'checked' : '' }}>
                                            <span class="ml-2">Eliminar</span>
                                        </label>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 1 + $conceptTypes->count() }}" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No hay usuarios regulares en el sistema
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors">
                Guardar Permisos
            </button>
        </div>
    </form>
</div>
@endsection