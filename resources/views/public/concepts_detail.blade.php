<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conceptos Jurídicos | {{ $concept->titulo }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8 border border-gray-300">
        
        <!-- Fecha de modificación y creación -->
        <p class="text-sm text-gray-500 mb-2">
            Modificación: {{ $concept->updated_at }} - Creación: {{ $concept->created_at }}
        </p>

        <!-- Título principal -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">
            {{ $concept->titulo }}
        </h1>

        <!-- Tipo de documento, año y fecha -->
        <p class="text-lg font-semibold text-blue-700 mb-2">
            {{ $concept->tipo_documento }} - Año: {{ $concept->año }} - Fecha: {{ \Carbon\Carbon::parse($concept->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}
        </p>
        
        <!-- Tipo y tema -->
        <p class="text-md font-semibold text-gray-700 mb-4">
            Tipo: {{ $concept->conceptType->nombre }} | Tema: {{ $concept->conceptTheme->nombre }}
        </p>

        <!-- Contenido del concepto -->
        <div class="text-gray-700 leading-relaxed mb-6">
            <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Contenido</h2>
            {!! nl2br(e($concept->contenido)) !!}
        </div>

        <!-- Vista previa -->
        <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">Vista Previa</h2>
        
        @if(pathinfo($concept->archivo, PATHINFO_EXTENSION) == 'pdf')
            <iframe src="{{ asset('storage/' . $concept->archivo) }}" class="w-full h-[500px] border rounded-lg shadow"></iframe>
        @else
            <p class="text-gray-600 italic">Solo los archivos PDF pueden visualizarse en línea. Descargue el archivo para abrirlo.</p>
        @endif

        <!-- Botón para abrir el archivo -->
        <div class="mt-6">
            <a href="{{ asset('storage/' . $concept->archivo) }}" target="_blank" class="bg-blue-600 text-white py-2 px-6 rounded-lg text-lg hover:bg-blue-700 transition shadow">
                Abrir en otra pestaña
            </a>
        </div>
    </div>

</body>
</html>