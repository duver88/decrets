<!-- resources/views/admin/edit_document.blade.php -->
@extends('layouts.app')

@section('title', 'Editar Documento')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Editar Documento</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('document.update', $document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Categoría -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ $document->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Título (nombre) -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Título</label>
                <input type="text" name="nombre" id="nombre" class="form-control" 
                       value="{{ old('nombre', $document->nombre) }}">
            </div>

            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" 
                       value="{{ old('fecha', $document->fecha) }}">
            </div>

            <!-- Archivo -->
            <div class="mb-3">
                <label for="archivo" class="form-label">Archivo (opcional)</label>
                <input type="file" name="archivo" id="archivo" class="form-control">
                @if($document->archivo)
                    <p class="mt-2">Archivo actual: <a href="{{ asset('storage/'.$document->archivo) }}" target="_blank">Ver / Descargar</a></p>
                @endif
            </div>

            <!-- Tipo (decreto o resolución) -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Documento</label>
                <select name="tipo" id="tipo" class="form-select">
                    <option value="decreto" {{ $document->tipo == 'decreto' ? 'selected' : '' }}>Decreto</option>
                    <option value="resolución" {{ $document->tipo == 'resolución' ? 'selected' : '' }}>Resolución</option>
                </select>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{ old('descripcion', $document->descripcion) }}</textarea>
            </div>

            <div class="text-end">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
