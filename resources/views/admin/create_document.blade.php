<!-- resources/views/admin/create_document.blade.php -->
@extends('layouts.app')

@section('title', 'Agregar Documento')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Agregar Documento</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Categoría -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Título (nombre) -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Título</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required
                       value="{{ old('nombre') }}">
                @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required
                       value="{{ old('fecha') }}">
                @error('fecha')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Archivo principal -->
            <div class="mb-3">
                <label for="archivo" class="form-label">Archivo</label>
                <input type="file" name="archivo" id="archivo" class="form-control" accept=".pdf,.doc,.docx" required>
                @error('archivo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Tipo (decreto o resolución) -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Documento</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="decreto" {{ old('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
                    <option value="resolución" {{ old('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
                </select>
                @error('tipo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection