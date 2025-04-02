<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard - Documentos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Listado de Documentos</h1>
    <a href="{{ route('document.create') }}" class="btn btn-primary">
        Agregar Documento
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Categoría</th>
            <th>Institución</th>
            <th>Título</th>
            <th>Número</th>
            <th>Fecha</th>
            <th>Tipo de Documento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($documents as $document)
        <tr>
            <td>{{ $document->category->nombre ?? 'Sin categoría' }}</td>
            <td>{{ $document->institucion ?? 'N/A' }}</td>
            <td>{{ $document->nombre }}</td>
            <td>{{ $document->numero ?? 'N/A' }}</td>
            <td>{{ $document->fecha }}</td>
            <td>{{ $document->tipo }}</td>
            <td>
                <!-- Botón Editar -->
                <a href="{{ route('document.edit', $document->id) }}" class="btn btn-sm btn-warning">
                    Editar
                </a>

                <!-- Form para Eliminar -->
                <form action="{{ route('document.destroy', $document->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">No hay documentos registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
