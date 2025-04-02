<!-- resources/views/public/documents.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Documentos</title>
    <!-- Incluye CSS (Bootstrap o Tailwind, según prefieras) -->
</head>
<body>
    <h1>Documentos</h1>
    
    <form method="GET" action="{{ route('home') }}">
        <input type="text" name="nombre" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
        <input type="date" name="fecha" value="{{ request('fecha') }}">
        <select name="tipo">
            <option value="">Tipo</option>
            <option value="decreto" {{ request('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
            <option value="resolución" {{ request('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
        </select>
        <select name="category_id">
            <option value="">Categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->nombre }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <div>
        @foreach($documents as $document)
            <div>
                <h3>{{ $document->nombre }}</h3>
                <p>Fecha: {{ $document->fecha }}</p>
                <p>{{ Str::limit($document->descripcion, 100) }}</p>
                <a href="{{ route('document.show', $document->id) }}">Ver más / Descargar</a>
            </div>
        @endforeach
    </div>
</body>
</html>
