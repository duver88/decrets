<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body { font-family: 'Ubuntu', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6"> <i class="fa fa-file-text-o"></i> Documentos</h1>
        
        <form method="GET" action="{{ route('home') }}" class="bg-white shadow-md rounded-lg p-6 space-y-6 border border-gray-300">
            <h2 class="text-2xl font-semibold text-gray-700 border-b pb-3"> <i class="fa fa-filter"></i> Filtrar Documentos</h2>
        
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <i class="fa fa-search absolute left-3 top-3 text-gray-500"></i>
                    <input type="text" name="nombre" placeholder="Buscar por nombre" value="{{ request('nombre') }}"
                        class="border border-gray-300 p-3 pl-10 rounded-md w-full focus:ring-2 focus:ring-blue-600 focus:outline-none bg-gray-50">
                </div>
                <div class="relative">
                    <i class="fa fa-hashtag absolute left-3 top-3 text-gray-500"></i>
                    <input type="text" name="numero" placeholder="Buscar por número" value="{{ request('numero') }}"
                        class="border border-gray-300 p-3 pl-10 rounded-md w-full focus:ring-2 focus:ring-blue-600 focus:outline-none bg-gray-50">
                </div>
                <div class="relative">
                    <i class="fa fa-calendar absolute left-3 top-3 text-gray-500"></i>
                    <input type="date" name="fecha" value="{{ request('fecha') }}"
                        class="border border-gray-300 p-3 pl-10 rounded-md w-full focus:ring-2 focus:ring-blue-600 focus:outline-none bg-gray-50">
                </div>
                <div class="relative">
                    <i class="fa fa-folder absolute left-3 top-3 text-gray-500"></i>
                    <select name="tipo"
                        class="border border-gray-300 p-3 pl-10 rounded-md w-full focus:ring-2 focus:ring-blue-600 focus:outline-none bg-gray-50">
                        <option value="">Tipo de Documento</option>
                        <option value="decreto" {{ request('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
                        <option value="resolución" {{ request('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
                    </select>
                </div>
            </div>
        
            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 transition flex items-center">
                    <i class="fa fa-filter mr-2"></i> Filtrar
                </button>
                <a href="{{ route('home') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-gray-600 transition flex items-center">
                    <i class="fa fa-times mr-2"></i> Limpiar filtros
                </a>
            </div>
        </form>
        
        <div class="space-y-4 mt-6">
            @foreach($documents as $document)
                @php
                    $extension = pathinfo($document->archivo, PATHINFO_EXTENSION);
                    $icono = '<i class="fa fa-file-o text-gray-500"></i>';
                    if ($extension == 'pdf') $icono = '<i class="fa fa-file-pdf-o text-red-500"></i>';
                    elseif (in_array($extension, ['doc', 'docx'])) $icono = '<i class="fa fa-file-word-o text-blue-500"></i>';
                    elseif (in_array($extension, ['xls', 'xlsx'])) $icono = '<i class="fa fa-file-excel-o text-green-500"></i>';
                @endphp
                
                <div class="bg-white p-5 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition flex items-center">
                    <!-- Ícono ligeramente más pequeño -->
                    <div class="text-6xl flex-shrink-0 w-24 text-center">
                        {!! $icono !!}
                    </div>
                    
                    <!-- Contenido -->
                    <div class="ml-5 flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <a href="{{ asset('storage/' . $document->archivo) }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ ucfirst($document->tipo) }} {{ $document->numero }} - {{ $document->nombre }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($document->descripcion, 120) }}</p>
                        <div class="text-gray-600 text-sm mt-2">
                            <i class="fa fa-clock-o"></i> Publicación: {{ $document->created_at->diffForHumans() }} |
                            <i class="fa fa-calendar"></i> Expedición: {{ \Carbon\Carbon::parse($document->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('document.show', $document->id) }}" class="bg-blue-500 text-white py-1.5 px-3 rounded hover:bg-blue-600 transition flex items-center gap-2 text-sm">
                                <i class="fa fa-download"></i> Ver más / Descargar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
