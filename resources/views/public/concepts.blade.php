<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conceptos Jurídicos</title>
    <link rel="stylesheet" href="{{ asset('css/cabecera.css') }}">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Agregamos Font Awesome 5 para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body { 
            font-family: 'Ubuntu', sans-serif; 
            margin: 0;
            padding: 0;
        }

        /* Estilos para los tabs de sistema */
        .sistema-tab {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .sistema-tab:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }

        
    </style>
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
    {{-- Fin Header --}}

    {{-- SECCIÓN PRINCIPAL: Relatoría de Conceptos --}}
    <div class="container my-5" style="background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color: #43883d; font-family: 'Ubuntu', sans-serif;">
                Relatoría de Conceptos
                <small class="d-block fs-5 mt-2 text-muted">Alcaldía de Bucaramanga</small>
            </h1>
        </div>

        <!-- Botones de navegación en formato de tarjetas -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
            <!-- Botón 1: Conoce el sistema de búsqueda -->
            <div class="col">
                <div class="card h-100 border-0 cursor-pointer" onclick="window.location.href='{{ route('home') }}'" style="background-color: #43883d; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease;">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-info-circle" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="card-title mb-2" style="font-weight: 600;">Conoce el Sistema de Búsqueda</h5>
                        <p class="card-text" style="font-size: 0.9rem; opacity: 0.8;">Información general sobre el funcionamiento del sistema</p>
                    </div>
                </div>
            </div>

            <!-- Botón 2: Relatoría de conceptos -->
            <div class="col">
                <div class="card h-100 border-0 cursor-pointer" style="background-color: #3F8827; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease; border: 2px solid #93C01F;">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-book-open" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="card-title mb-2" style="font-weight: 600;">Relatoría de Conceptos</h5>
                        <p class="card-text" style="font-size: 0.9rem; opacity: 0.8;">Consulta los conceptos emitidos por la entidad</p>
                    </div>
                </div>
            </div>

            <!-- Botón 3: Relatoría de Actos Administrativos -->
            <div class="col">
                <div class="card h-100 border-0 cursor-pointer" onclick="window.location.href='{{ route('home') }}'" style="background-color: #43883d; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease;">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-gavel" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="card-title mb-2" style="font-weight: 600;">Relatoría de Actos Administrativos</h5>
                        <p class="card-text" style="font-size: 0.9rem; opacity: 0.8;">Consulta decretos, resoluciones y otros actos administrativos</p>
                    </div>
                </div>
            </div>

            <!-- Botón 4: Relatoría de Circulares -->
            <div class="col">
                <div class="card h-100 border-0 cursor-pointer" onclick="window.location.href='{{ route('home') }}'" style="background-color: #43883d; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease;">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-file-alt" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="card-title mb-2" style="font-weight: 600;">Relatoría de Circulares</h5>
                        <p class="card-text" style="font-size: 0.9rem; opacity: 0.8;">Consulta las circulares emitidas por la entidad</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario para filtrar conceptos -->

        <!-- FORMULARIO -->
<form id="filtersForm" class="bg-white p-4 border rounded-3 shadow-sm mb-5">
    <!-- BÚSQUEDA -->
    <div class="mb-4">
        <label for="busqueda_general" class="form-label fw-bold text-success">
            <i class="fas fa-search me-2"></i>Búsqueda General
        </label>
        <div class="input-group">
            <span class="input-group-text bg-success text-white"><i class="fas fa-search"></i></span>
            <input type="search" name="busqueda_general" id="busqueda_general"
                   class="form-control" placeholder="Título, contenido, año, número..."
                   value="{{ request('busqueda_general') }}">
        </div>
        <small class="form-text text-muted"><i class="fas fa-info-circle me-1"></i>Usa palabras clave del documento</small>
    </div>

    <!-- GRUPOS DESPLEGABLES -->
    <div class="accordion" id="filtrosAccordion">

        <!-- Filtrar por contenido -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingContenido">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContenido">
                    <i class="fas fa-tags me-2 text-success"></i>Filtrar por categoría
                </button>
            </h2>
            <div id="collapseContenido" class="accordion-collapse collapse" data-bs-parent="#filtrosAccordion">
                <div class="accordion-body row g-3">
                    <div class="col-md-6">
                        <label for="concept_type_id" class="form-label">Tipo de Concepto</label>
                        <select name="concept_type_id" id="concept_type_id" class="form-select">
                            <option value="">Todos</option>
                            @foreach($conceptTypes as $t)
                                <option value="{{ $t->id }}" @selected(request('concept_type_id') == $t->id)>{{ $t->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="concept_theme_id" class="form-label">Tema Específico</label>
                        <select name="concept_theme_id" id="concept_theme_id" class="form-select">
                            <option value="">Todos</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtrar por documento -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingDocumento">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocumento">
                    <i class="fas fa-file-alt me-2 text-success"></i>Filtrar por documento
                </button>
            </h2>
            <div id="collapseDocumento" class="accordion-collapse collapse" data-bs-parent="#filtrosAccordion">
                <div class="accordion-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tipo de Documento</label>
                        <select name="tipo_documento" class="form-select">
                            <option value="">Todos</option>
                            <option value="Decreto" @selected(request('tipo_documento') == 'Decreto')>Decreto</option>
                            <option value="Resolución" @selected(request('tipo_documento') == 'Resolución')>Resolución</option>
                            <option value="Circular" @selected(request('tipo_documento') == 'Circular')>Circular</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Año</label>
                        <select name="año" class="form-select">
                            <option value="">Todos</option>
                            @foreach($años as $a)
                                <option value="{{ $a }}" @selected(request('año') == $a)>{{ $a }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>

        <!-- Filtrar por fechas -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFechas">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFechas">
                    <i class="fas fa-calendar-alt me-2 text-success"></i>Filtrar por fechas
                </button>
            </h2>
            <div id="collapseFechas" class="accordion-collapse collapse" data-bs-parent="#filtrosAccordion">
                <div class="accordion-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Fecha Desde</label>
                        <input type="date" name="fecha_desde" class="form-control" value="{{ request('fecha_desde') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha Hasta</label>
                        <input type="date" name="fecha_hasta" class="form-control" value="{{ request('fecha_hasta') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Preferencias de visualización -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOrden">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrden">
                    <i class="fas fa-eye me-2 text-success"></i>Preferencias de visualización
                </button>
            </h2>
            <div id="collapseOrden" class="accordion-collapse collapse" data-bs-parent="#filtrosAccordion">
                <div class="accordion-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Ordenar por</label>
                        <select name="orden" class="form-select">
                            <option value="fecha_desc" @selected(request('orden') == 'fecha_desc')>Fecha más reciente</option>
                            <option value="fecha_asc" @selected(request('orden') == 'fecha_asc')>Fecha más antigua</option>
                            <option value="titulo_asc" @selected(request('orden') == 'titulo_asc')>Título A-Z</option>
                            <option value="titulo_desc" @selected(request('orden') == 'titulo_desc')>Título Z-A</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Resultados por página</label>
                        <select name="per_page" class="form-select">
                            @foreach([10, 25, 50, 100] as $pp)
                                <option value="{{ $pp }}" @selected(request('per_page') == $pp)>{{ $pp }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTONES -->
    <div class="d-flex justify-content-center gap-3 mt-5 pt-4 border-top">
        <button type="submit" class="btn text-white px-5 py-2 rounded-pill" style="background-color: #43883d;">
            <i class="fas fa-search me-2"></i>Buscar
        </button>
        <a href="{{ route('concepts.public') }}" class="btn btn-outline-secondary px-5 py-2 rounded-pill">
            <i class="fas fa-eraser me-2"></i>Limpiar
        </a>
    </div>
</form>


@if (
    request()->filled('busqueda_general') ||
    request()->filled('concept_type_id') ||
    request()->filled('concept_theme_id') ||
    request()->filled('tipo_documento') ||
    request()->filled('año') ||
    request()->filled('mes') ||
    request()->filled('fecha_desde') ||
    request()->filled('fecha_hasta') ||
    request()->filled('orden')
)
    <div class="mt-4 pt-3 border-top">
        <h6 class="fw-bold text-success mb-2">Filtros aplicados:</h6>
        <div class="d-flex flex-wrap gap-2">
            @php
                $baseParams = request()->except([
                    '_token', 'page'
                ]);
            @endphp

            @if(request()->filled('busqueda_general'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['busqueda_general' => null])) }}"
                   class="badge text-white"
                   style="background-color: #43883D;">
                    🔍 {{ request('busqueda_general') }} &times;
                </a>
            @endif

            @if(request()->filled('concept_type_id'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['concept_type_id' => null, 'concept_theme_id' => null])) }}"
                   class="badge text-white"
                   style="background-color: #4E7525;">
                    Tipo: {{ $conceptTypes->firstWhere('id', request('concept_type_id'))?->nombre }} &times;
                </a>
            @endif

            @if(request()->filled('concept_theme_id'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['concept_theme_id' => null])) }}"
                   class="badge text-white"
                   style="background-color: #6A9739;">
                    Tema: {{ $temasFiltered->firstWhere('id', request('concept_theme_id'))?->nombre }} &times;
                </a>
            @endif

            @if(request()->filled('tipo_documento'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['tipo_documento' => null])) }}"
                   class="badge text-white"
                   style="background-color: #7A7A52;">
                    Documento: {{ request('tipo_documento') }} &times;
                </a>
            @endif

            @if(request()->filled('año'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['año' => null])) }}"
                   class="badge text-white"
                   style="background-color: #B2B700;">
                    Año: {{ request('año') }} &times;
                </a>
            @endif

            @if(request()->filled('mes'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['mes' => null])) }}"
                   class="badge text-white"
                   style="background-color: #CCCC00;">
                    Mes: {{ \Carbon\Carbon::create()->month(request('mes'))->translatedFormat('F') }} &times;
                </a>
            @endif

            @if(request()->filled('fecha_desde'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['fecha_desde' => null])) }}"
                   class="badge text-white"
                   style="background-color: #878D47;">
                    Desde: {{ request('fecha_desde') }} &times;
                </a>
            @endif

            @if(request()->filled('fecha_hasta'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['fecha_hasta' => null])) }}"
                   class="badge text-white"
                   style="background-color: #878D47;">
                    Hasta: {{ request('fecha_hasta') }} &times;
                </a>
            @endif

            @if(request()->filled('orden'))
                <a href="{{ route('concepts.public', array_merge($baseParams, ['orden' => null])) }}"
                   class="badge text-dark bg-light border border-secondary">
                    Orden: {{
                        match(request('orden')) {
                            'fecha_desc' => 'Más reciente',
                            'fecha_asc' => 'Más antiguo',
                            'titulo_asc' => 'Título A-Z',
                            'titulo_desc' => 'Título Z-A',
                            default => request('orden')
                        }
                    }} &times;
                </a>
            @endif
        </div>
    </div>
@endif


<br>
<!-- Loader -->


        <!-- Listado de conceptos -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @if($concepts->count() > 0)
                @foreach($concepts as $concept)
                    @php
                    $extension = strtolower(pathinfo($concept->archivo, PATHINFO_EXTENSION));
                    $iconClass = '';
                    $icon = '';
            
                    if ($extension == 'pdf') {
                        $iconClass = 'text-danger';
                        $icon = '<i class="fas fa-file-pdf fa-2x"></i>';
                    } elseif (in_array($extension, ['doc', 'docx'])) {
                        $iconClass = 'text-primary';
                        $icon = '<i class="fas fa-file-word fa-2x"></i>';
                    } elseif (in_array($extension, ['xls', 'xlsx'])) {
                        $iconClass = 'text-success';
                        $icon = '<i class="fas fa-file-excel fa-2x"></i>';
                    } else {
                        $iconClass = 'text-secondary';
                        $icon = '<i class="fas fa-file-alt fa-2x"></i>';
                    }
                    @endphp
            
                    <article class="col">
                        <div class="card h-100 shadow rounded overflow-hidden transition-all hover:shadow-lg" 
                             style="transition: all 0.3s ease; background-color: #f9f9f9;">
                            <div class="d-flex align-items-center p-3 gap-3">
                                <div class="flex-shrink-0 text-center" style="width: 70px;">
                                    <div class="{{ $iconClass }}">
                                        {!! $icon !!}
                                    </div>
                                    <span class="visually-hidden">{{ strtoupper($extension) }} archivo</span>
                                </div>
            
                                <div class="flex-grow-1">
                                    <h3 class="h6 mb-2">
                                        <a href="{{ asset('storage/' . $concept->archivo) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold" style="color: #43883d;">
                                           {{ $concept->tipo_documento }}: No {{ $concept->titulo }} del {{ $concept->año }}
                                        </a>
                                    </h3>
                                    <p class="text-muted small mb-2">{{ Str::limit($concept->contenido, 110) }}</p>
                                    <div class="d-flex align-items-center gap-3 mb-3 text-muted small">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                            </svg>
                                            {{ $concept->created_at->diffForHumans() }}
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($concept->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}
                                        </div>
                                    </div>
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <a href="{{ route('concepts.show.public', $concept->id) }}" class="btn btn-sm d-inline-flex align-items-center gap-2" style="background-color: #43883d; color: white;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                </svg>
                                                Ver / Descargar
                                            </a>
                                           
                                        </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3>No hay conceptos disponibles</h3>
                    <p class="text-muted mt-3">Utilice los filtros para buscar conceptos o intente más tarde.</p>
                </div>
            @endif
        </div>
    </div>
    {{-- FIN SECCIÓN PRINCIPAL --}}

 {{-- fOOTER   --}}
  <span id="final"></span>
  <div class="govco-footer mt-5">
    <div class="row govco-portales-contenedor m-0">
      <div class="col-4 govco-footer-logo-portal">
        <div class="govco-logo-container-portal">
          <span class="govco-logo"></span>
          <span class="govco-separator"></span>
          <span class="govco-co"></span>
        </div>
      </div>
      <div class="col-4 govco-info-datos-portal">
        <div class="govco-separator-rows"></div>
        <div class="govco-texto-datos-portal">
          <p class="govco-text-header-portal-1">
            Nombre completo del portal
          </p>
          <p>Dirección: xxxxxx xxx xxx Departamento y municipio. <br>
            Código Postal: xxxx <br>
            Horario de atención: Lunes a viernes xx:xx a.m. - xx:xx p.m.</p>
        </div>
        <div class="govco-network extramt-network">
          <div class="govco-iconContainer">
            <span class="icon-portal govco-twitter-square"></span>
            <span class="govco-link-portal">@Entidad</span>
          </div>
          <div class="govco-iconContainer">
            <span class="icon-portal govco-instagram-square"></span>
            <span class="govco-link-portal">@Entidad</span>
          </div>
          <div class="govco-iconContainer">
            <span class="icon-portal govco-facebook-square"></span>
            <span class="govco-link-portal">@Entidad</span>
          </div>
        </div>
      </div>

      <div class="col-4 govco-info-telefonos">
        <div class="govco-separator-rows"></div>
        <div class="govco-texto-telefonos">
          <p class="govco-text-header-portal-1">
            <span class="govco-phone-alt"></span>
            Contacto
          </p>
          <p>Teléfono conmutador: <br>
            +57(xx) xxx xx xx <br>
            Línea gratuita: 01-800-xxxxxxxx <br>
            Línea anticorrupción: 01-800-xxxxxxxx <br>
            Correo institucional: <br>
            entidad@entidad.gov.co</p>
        </div>

        <div class="govco-links-portal-container">
          <div class="col-12 m-0 mt-2">
            <a class="govco-link-portal" href="#">Políticas</a>
            <a class="govco-link-portal" href="#">Mapa del sitio</a>
          </div>
          <div class="col-12 m-0 mt-2">
            <a class="govco-link-portal" href="#">Términos y condiciones</a> <br>
          </div>
          <div class="col-12 m-0 mt-2">
            <a class="govco-link-portal" href="#">Accesibilidad</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const typeSel  = document.getElementById('concept_type_id');
  const themeSel = document.getElementById('concept_theme_id');

  async function loadThemes(typeId){
     themeSel.innerHTML = '<option value="">Cargando temas...</option>';
     try {
       const r = await fetch(`/api/concept-themes-by-type/${typeId}`);
       const list = await r.json();
       themeSel.innerHTML = '<option value="">Todos los temas</option>';
       list.forEach(t => {
          const opt = new Option(t.nombre, t.id, false, t.id == '{{ request('concept_theme_id') }}');
          themeSel.add(opt);
       });
     } catch (error) {
       themeSel.innerHTML = '<option value="">Error al cargar temas</option>';
     }
  }

  if(typeSel.value) loadThemes(typeSel.value);
  typeSel.addEventListener('change', e => {
     if(e.target.value){ 
       loadThemes(e.target.value); 
     } else { 
       themeSel.innerHTML = '<option value="">Todos los temas</option>'; 
     }
  });
});

</script>
</body>
</html>

