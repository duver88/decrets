<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard - Documentos')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Listado de Documentos</h1>
    <a href="{{ route('document.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Agregar Documento
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Categoría</th>
                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Fecha Del Documento</th>
                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Número</th>
                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Fecha</th>
                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Tipo</th>
                <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($documents as $document)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border-b">{{ $document->category->nombre ?? 'Sin categoría' }}</td>
                <td class="px-4 py-2 border-b">{{ $document->nombre }}</td>
                <td class="px-4 py-2 border-b">{{ $document->numero ?? 'N/A' }}</td>
                <td class="px-4 py-2 border-b">{{ $document->fecha }}</td>
                <td class="px-4 py-2 border-b">{{ $document->tipo }}</td>
                <td class="px-4 py-2 border-b space-x-2">
                    <a href="{{ route('document.edit', $document->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                        Editar
                    </a>
                    <form action="{{ route('document.destroy', $document->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">No hay documentos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
