<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6">📄 Documentos</h1>
        
        <form method="GET" action="{{ route('home') }}" class="bg-white shadow-md rounded-lg p-6 space-y-6 border border-gray-300">
            <!-- Título -->
            <h2 class="text-2xl font-semibold text-gray-700 border-b pb-3">Filtrar Documentos</h2>
        
            <!-- Filtros -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <i class="w3-large w3-text-gray fa fa-search absolute left-3 top-3"></i>
                    <input type="text" name="nombre" placeholder="Buscar por nombre"
                        value="{{ request('nombre') }}"
                        class="border border-gray-300 p-3 pl-10 rounded-md w-full focus:ring-2 focus:ring-blue-600 focus:outline-none bg-gray-50">
                </div>
        
                <div class="relative">
                    <i class="w3-large w3-text-gray fa fa-hashtag absolute left-3 top-3"></i>
                    <input type="text" name="numero" placeholder="Buscar por número"
                        value="{{ request('numero') }}"
                        class="border border-gray-300 p-3 pl-10 rounded-md w-full focus:ring-2 focus:ring-blue-600 focus:outline-none bg-gray-50">
                </div>
        
                <div class="relative">
                    <i class="w3-large w3-text-gray fa fa-calendar absolute left-3 top-3"></i>
                    <input type="date" name="fecha" value="{{ request('fecha') }}"
                        class="border border-gray-300 p-3 pl-10 rounded-md w-full focus:ring-2 focus:ring-blue-600 focus:outline-none bg-gray-50">
                </div>
        
                <div class="relative">
                    <i class="w3-large w3-text-gray fa fa-folder absolute left-3 top-3"></i>
                    <select name="tipo"
                        class="border border-gray-300 p-3 pl-10 rounded-md w-full focus:ring-2 focus:ring-blue-600 focus:outline-none bg-gray-50">
                        <option value="">Tipo de Documento</option>
                        <option value="decreto" {{ request('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
                        <option value="resolución" {{ request('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
                    </select>
                </div>
            </div>
        
            <!-- Botones -->
            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 transition flex items-center">
                    <i class="fa fa-filter w3-large mr-2"></i> Filtrar
                </button>
                <a href="{{ route('home') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-gray-600 transition flex items-center">
                    <i class="fa fa-times w3-large mr-2"></i> Limpiar filtros
                </a>
                <a href="{{ route('home', array_merge(request()->query(), ['orden' => 'numero'])) }}"
                    class="bg-green-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-green-700 transition flex items-center">
                    <i class="fa fa-sort-numeric-asc w3-large mr-2"></i> Ordenar por número
                </a>
                <a href="{{ route('home', array_merge(request()->query(), ['orden' => 'nombre'])) }}"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-indigo-700 transition flex items-center">
                    <i class="fa fa-sort-alpha-asc w3-large mr-2"></i> Ordenar A-Z
                </a>
            </div>
        </form>
        
        
        
        

        <div class="space-y-4">
            @foreach($documents as $document)
                @php
                    $extension = pathinfo($document->archivo, PATHINFO_EXTENSION);
                    $icono = '<i class="fa fa-file w3-text-gray"></i>'; // Ícono genérico por defecto

                    switch ($extension) {
                        case 'pdf':
                            $icono = '<i class="fa fa-file-pdf-o w3-text-red"></i>'; // Ícono de PDF
                            break;
                        case 'doc':
                        case 'docx':
                            $icono = '<i class="fa fa-file-word-o w3-text-blue"></i>'; // Ícono de Word
                            break;
                        case 'xls':
                        case 'xlsx':
                            $icono = '<i class="fa fa-file-excel-o w3-text-green"></i>'; // Ícono de Excel
                            break;
                    }
                @endphp

                <div class="bg-white p-5 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 flex items-center">
                        {!! $icono !!} 
                        <a href="{{ asset('storage/' . $document->archivo) }}" target="_blank" class="ml-2 text-blue-600 hover:underline">
                            {{ ucfirst($document->tipo) }} {{ $document->numero }}  {{ $document->nombre }}
                        </a>
                    </h3>
                    <div class="flex items-center text-gray-600 text-sm mb-2">
                        🕒 <span class="ml-1">Subido hace {{ $document->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-3">
                        📅 <span class="ml-1">{{ \Carbon\Carbon::parse($document->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}</span>
                    </div>
                    <p class="text-gray-700">{{ Str::limit($document->descripcion, 120) }}</p>
                    <div class="mt-3 text-right">
                        <a href="{{ route('document.show', $document->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                            📄 Ver más / Descargar
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        
    </div>
</body>
</html>
