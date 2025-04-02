<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-4">Documentos</h1>
        
        <form method="GET" action="{{ route('home') }}" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <input type="text" name="nombre" placeholder="Buscar por nombre" value="{{ request('nombre') }}" 
                class="border p-2 rounded w-full">
            <input type="date" name="fecha" value="{{ request('fecha') }}" class="border p-2 rounded w-full">
            <select name="tipo" class="border p-2 rounded w-full">
                <option value="">Tipo</option>
                <option value="decreto" {{ request('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
                <option value="resolución" {{ request('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
            </select>
            <select name="category_id" class="border p-2 rounded w-full">
                <option value="">Categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nombre }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="col-span-2 md:col-span-4 bg-blue-500 text-white py-2 rounded">Filtrar</button>
        </form>

        <div class="space-y-4">
            @foreach($documents as $document)
                <div class="bg-gray-50 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $document->nombre }}</h3>
                    <p class="text-gray-600 text-sm">Fecha: {{ $document->fecha }}</p>
                    <p class="text-gray-700">{{ Str::limit($document->descripcion, 100) }}</p>
                    <a href="{{ route('document.show', $document->id) }}" 
                       class="text-blue-500 hover:underline font-medium">Ver más / Descargar</a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
