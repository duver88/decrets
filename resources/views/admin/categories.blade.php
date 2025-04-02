<!-- resources/views/admin/categories.blade.php -->
@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Gestión de Categorías</h2>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Formulario para agregar categoría -->
        <form action="{{ route('category.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nueva Categoría</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la categoría">
                @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Agregar Categoría</button>
        </form>

        <!-- Listado de categorías -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->nombre }}</td>
                    <td>
                        <!-- Eliminar categoría -->
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" 
                              onsubmit="return confirm('¿Deseas eliminar esta categoría? Se eliminarán documentos relacionados.')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center">No hay categorías registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
