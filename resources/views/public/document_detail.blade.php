<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos | {{ ucfirst($document->tipo) }} N° {{ $document->numero }}</title>
     <link rel="stylesheet" href="{{ asset('css/cabecera.css') }}">   
    <link rel="stylesheet" href="{{ asset('css/conceptsDetails.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
        {{-- Header --}}
    <nav class="navbar navbar-expand-lg barra-superior-govco" aria-label="Barra superior">
            <a href="https://www.gov.co/" target="_blank" aria-label="Portal del Estado Colombiano - GOV.CO"></a>
    </nav>
    <header class="borderWg">      
        <!-- Header principal con Bootstrap Navbar -->
        <div class="container ">
            <!-- Logo -->
            
            <div class="d-flex justify-content-center align-items-center">
            <div class="logo-container">
                <div class="logo-box">
                <img
                    src="https://www.bucaramanga.gov.co/wp-content/uploads/2025/05/Screenshot_7.png"
                    alt="Escudo Bucaramanga"
                    class="logo-img img-fluid"
                />
                </div>
            </div>
            </div>

            
            <!-- Menú Bootstrap -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="navbar-toggler mx-auto border-0 bg-transparent p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link " href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Paga tus impuestos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Noticias</a>
                            </li>
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle active " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Transparencia y acceso<br>a la información pública
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Información de la entidad</a></li>
                                    <li><a class="dropdown-item" href="#">Correo institucional</a></li>
                                    <li><a class="dropdown-item" href="#">Normativa</a></li>
                                    <li><a class="dropdown-item" href="#">Contratación</a></li>
                                    <li><a class="dropdown-item" href="#">Planeación, presupuesto e informes</a></li>
                                    <li><a class="dropdown-item" href="#">Participa</a></li>
                                    <li><a class="dropdown-item" href="#">Datos abiertos</a></li>
                                    <li><a class="dropdown-item" href="#">Información específica para Grupos de Interés</a></li>
                                    <li><a class="dropdown-item" href="#">Obligación de reporte de información específica por parte de la entidad</a></li>
                                    <li><a class="dropdown-item" href="#">Información tributaria en entidades territoriales locales</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Atención y servicios<br>a la ciudadanía
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Trámites</a></li>
                                    <li><a class="dropdown-item" href="#">Centro de analítica de datos</a></li>
                                    <li><a class="dropdown-item" href="#">Canal de denuncia para presuntos actos de corrupción</a></li>
                                    <li><a class="dropdown-item" href="#">Inspecciones de Policía</a></li>
                                    <li><a class="dropdown-item" href="#">Bienestar Animal</a></li>
                                    <li><a class="dropdown-item" href="#">Puntos Digitales</a></li>
                                    <li><a class="dropdown-item" href="#">Portal de Niños</a></li>
                                    <li><a class="dropdown-item" href="#">Inventario de Sentencias</a></li>
                                    <li><a class="dropdown-item" href="#">Servicio de empleo</a></li>
                                    <li><a class="dropdown-item" href="#">Preguntas frecuentes</a></li>
                                    <li><a class="dropdown-item" href="#">Canales de atención</a></li>
                                    <li><a class="dropdown-item" href="#">Crea una PQRSD</a></li>
                                    <li><a class="dropdown-item" href="#">Juntas administradoras locales 2024-2027</a></li>
                                </ul>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Participa</a>
                                </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <br>
    {{-- Fin Header --}}

<div class="concept-container">
    <!-- Botón de regreso -->
    <a href="{{ route('home') }}" class="back-btn">
        <i class="fas fa-arrow-left me-2"></i>
        Volver a Documentos
    </a>

    <!-- Header del documento -->
    <div class="header-title">
        <h1>{{ ucfirst($document->tipo) }} N° {{ $document->numero }}</h1>
        <p class="header-subtitle mb-0">{{ $document->nombre }} - {{ $document->category->nombre }}</p>
    </div>

    <div class="row">
        <!-- Columna izquierda - Vista previa del documento (8 columnas) -->
        <div class="col-lg-8 mb-4">
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-eye me-2"></i>
                    Vista Previa del Documento
                </div>
                <div class="preview-container">
                    @if(pathinfo($document->archivo, PATHINFO_EXTENSION) == 'pdf')
                        <iframe src="{{ asset('storage/' . $document->archivo) }}" 
                                class="preview-iframe">
                        </iframe>
                    @else
                        <div class="no-preview">
                            <div class="no-preview-icon">
                                <i class="fas fa-file-download"></i>
                            </div>
                            <h5 style="color: #43883d; font-weight: 600;">Archivo no visualizable en línea</h5>
                            <p class="mb-0">Solo los archivos PDF pueden visualizarse directamente. Descargue el archivo para abrirlo en su aplicación correspondiente.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Descripción del documento -->
            @if($document->descripcion)
            <div class="content-card">
                <h5 class="text-success fw-bold mb-3">
                    <i class="fas fa-align-left me-2"></i>
                    Descripción del Documento
                </h5>
                <div class="content-text">
                    {!! nl2br(e($document->descripcion)) !!}
                </div>
            </div>
            @endif

            <!-- Tarjeta de Acciones movida aquí -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-cog me-2"></i>
                    Acciones Disponibles
                </div>
                <div class="info-card-body">
                    <a href="{{ asset('storage/' . $document->archivo) }}" 
                       target="_blank" 
                       class="btn-action">
                        <i class="fas fa-external-link-alt me-2"></i>
                        Abrir en Nueva Pestaña
                    </a>
                    
                    <a href="{{ asset('storage/' . $document->archivo) }}" 
                       download 
                       class="btn-outline-action">
                        <i class="fas fa-download me-2"></i>
                        Descargar Archivo
                    </a>
                </div>
            </div>
        </div>

        <!-- Columna derecha - Información en tarjetas (4 columnas) -->
        <div class="col-lg-4">
            <!-- Tarjeta de Información General -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-info-circle me-2"></i>
                    Información General
                </div>
                <div class="info-card-body">
                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-file-contract me-2"></i>
                            Tipo de Documento
                        </div>
                        <div class="metadata-value">{{ ucfirst($document->tipo) }}</div>
                    </div>

                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-hashtag me-2"></i>
                            Número
                        </div>
                        <div class="metadata-value">{{ $document->numero }}</div>
                    </div>

                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-signature me-2"></i>
                            Nombre del Documento
                        </div>
                        <div class="metadata-value">{{ $document->nombre }}</div>
                    </div>

                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Fecha de Expedición
                        </div>
                        <div class="metadata-value">{{ \Carbon\Carbon::parse($document->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Clasificación -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-tags me-2"></i>
                    Clasificación
                </div>
                <div class="info-card-body">
                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-folder me-2"></i>
                            Categoría
                        </div>
                        <div class="metadata-value">{{ $document->category->nombre }}</div>
                    </div>

                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-file-alt me-2"></i>
                            Tipo de Archivo
                        </div>
                        <div class="metadata-value">{{ strtoupper(pathinfo($document->archivo, PATHINFO_EXTENSION)) }}</div>
                    </div>

                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-calendar-year me-2"></i>
                            Año de Expedición
                        </div>
                        <div class="metadata-value">{{ \Carbon\Carbon::parse($document->fecha)->format('Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Fechas -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-clock me-2"></i>
                    Información Temporal
                </div>
                <div class="info-card-body">
                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-plus-circle me-2"></i>
                            Fecha de Creación
                        </div>
                        <div class="metadata-value">{{ $document->created_at->translatedFormat('d \d\e F \d\e\l Y') }}</div>
                    </div>

                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-edit me-2"></i>
                            Última Modificación
                        </div>
                        <div class="metadata-value">{{ $document->updated_at->translatedFormat('d \d\e F \d\e\l Y') }}</div>
                    </div>

                    <div class="metadata-item">
                        <div class="metadata-label">
                            <i class="fas fa-eye me-2"></i>
                            Tiempo Transcurrido
                        </div>
                        <div class="metadata-value">{{ $document->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Badge de Seguridad (nueva) -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-shield-check me-2"></i>
                    Verificación
                </div>
                <div class="info-card-body">
                    <div class="text-center">
                        <div class="security-badge-large mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h6 class="text-success fw-bold mb-2">Documento Oficial</h6>
                        <p class="text-muted small mb-0">
                            Documento oficial expedido por la Alcaldía de Bucaramanga
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS adicional para el badge de seguridad -->
<style>
.security-badge-large {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #43883d, #2d6a2f);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 4px 12px rgba(67, 136, 61, 0.3);
}

.security-badge-large i {
    color: white;
    font-size: 1.5rem;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>