<!-- resources/views/public/document_detail.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Documento</title>
</head>
<body>
    <h1>{{ $document->nombre }}</h1>
    <p>Fecha: {{ $document->fecha }}</p>
    <p>Tipo: {{ $document->tipo }}</p>
    <p>Categoría: {{ $document->category->nombre }}</p>
    <p>{{ $document->descripcion }}</p>
    <a href="{{ asset('storage/' . $document->archivo) }}" download>Descargar documento</a>
</body>
</html>
