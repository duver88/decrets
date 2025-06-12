<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
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

        /* ESTILOS PARA CHIPS DE FILTRADO */
        .chip {
            display: inline-block;
            background-color: #E6F0E5;
            color: #285F19;
            padding: 5px 14px;
            margin: 3px;
            border-radius: 20px;
            font-family: 'Ubuntu', sans-serif;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        .chip.active {
            background-color: #43883d;
            color: white;
        }

        .order-option {
            margin-right: 10px;
            font-weight: 500;
            color: #6c757d;
            cursor: pointer;
        }

        .order-option.active {
            color: #285F19;
            font-weight: 700;
        }

        .toggle-advanced {
            color: #285F19;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
        }

        /* ESTILOS MEJORADOS PARA PAGINACIÓN */
        .pagination-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            margin-top: 40px;
            border-radius: 15px;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .pagination-info {
            background-color: white;
            padding: 15px 20px;
            border-radius: 10px;
            border: 1px solid #e3e6ea;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .pagination-info .badge {
            background-color: #43883d !important;
            color: white;
            font-size: 0.9rem;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .pagination {
            justify-content: center;
            margin: 0;
            gap: 5px;
        }

        .pagination .page-item {
            margin: 0 2px;
        }

        .pagination .page-link {
            color: #43883d;
            border: 2px solid #e9ecef;
            border-radius: 10px !important;
            padding: 12px 16px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            min-width: 45px;
            text-align: center;
        }

        .pagination .page-link:hover {
            background-color: #43883d;
            border-color: #43883d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 136, 61, 0.3);
        }

        .pagination .page-item.active .page-link {
            background-color: #43883d;
            border-color: #43883d;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(67, 136, 61, 0.4);
        }

        .pagination .page-item.disabled .page-link {
            color: #9ca3af;
            background-color: #f3f4f6;
            border-color: #e5e7eb;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Solo CSS mínimo para complementar Bootstrap */
.card {
    transition: all 0.3s ease !important;
}

.stretched-link:hover {
    transition: color 0.3s ease;
}

/* Responsive adicional para móviles pequeños */
@media (max-width: 576px) {
    .badge {
        font-size: 0.75rem !important;
        padding: 0.25rem 0.5rem !important;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .gap-3 {
        gap: 0.75rem !important;
    }
    
    .gap-2 {
        gap: 0.5rem !important;
    }
}

        /* Responsive para móviles */
        @media (max-width: 576px) {
            .pagination-container {
                padding: 15px;
                margin-top: 20px;
            }
            
            .pagination .page-link {
                padding: 8px 12px;
                font-size: 0.85rem;
                min-width: 35px;
            }
            
            .pagination-info {
                text-align: center;
                padding: 12px 15px;
            }
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

    {{-- SECCIÓN PRINCIPAL: Relatoría de Actos Administrativos --}}
    <div class="container my-5" style="background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color: #43883d; font-family: 'Ubuntu', sans-serif;">
                Relatoría de Actos Administrativos
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
                <div class="card h-100 border-0 cursor-pointer" onclick="window.location.href='{{ route('concepts.public') }}'" style="background-color: #43883d; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease;">
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
                <div class="card h-100 border-0 cursor-pointer" style="background-color: #3F8827; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease; border: 2px solid #93C01F;">
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

        <!-- FORMULARIO MEJORADO CON FILTROS AVANZADOS -->
        @php
            $selectedTipo = request('tipo');
            $selectedOrder = request('orden', 'fecha_desc');
            $currentCategory = request('category_id');
        @endphp

        <!-- CHIPS DE TIPOS DE DOCUMENTO -->
        <div class="mb-3">
            @if(isset($tipos) && $tipos->count() > 0)
                @foreach($tipos as $tipo)
                    <form method="GET" action="{{ route('home') }}" class="d-inline">
                        @foreach(request()->except(['tipo', 'page']) as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $v)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <input type="hidden" name="tipo" value="{{ $tipo }}">
                        <button type="submit" class="chip {{ $selectedTipo == $tipo ? 'active' : '' }}">
                            {{ ucfirst($tipo) }} ({{ $stats['por_tipo'][$tipo] ?? 0 }})
                        </button>
                    </form>
                @endforeach
            @endif
            <form method="GET" action="{{ route('home') }}" class="d-inline">
                @foreach(request()->except(['tipo', 'page']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
                <button type="submit" class="chip {{ !$selectedTipo ? 'active' : '' }}">Todos los tipos</button>
            </form>
        </div>

        <!-- CHIPS DE CATEGORÍAS -->
        <div class="mb-4">
            @if(isset($categories) && $categories->count() > 0)
                @foreach($categories as $categoria)
                    @php
                        $countCategoria = $stats['por_categoria']->firstWhere('id', $categoria->id)?->documents_count ?? 0;
                    @endphp
                    <form method="GET" action="{{ route('home') }}" class="d-inline">
                        @foreach(request()->except(['category_id', 'page']) as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $v)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <input type="hidden" name="category_id" value="{{ $categoria->id }}">
                        <button type="submit" class="chip {{ $currentCategory == $categoria->id ? 'active' : '' }}">
                            {{ $categoria->nombre }} ({{ $countCategoria }})
                        </button>
                    </form>
                @endforeach
            @endif
        </div>

        <!-- BUSCADOR GENERAL -->
        <form method="GET" action="{{ route('home') }}">
            <!-- Preservar otros filtros cuando se usa búsqueda general -->
            @foreach(request()->except(['busqueda_general', 'page']) as $key => $value)
                @if(is_array($value))
                    @foreach($value as $v)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            
            <div class="input-group mb-3">
                <span class="input-group-text bg-light text-secondary"><i class="fas fa-search"></i></span>
                <input type="search" name="busqueda_general" class="form-control"
                       placeholder="Buscar por nombre, número, descripción o tipo..." value="{{ request('busqueda_general') }}">
                <button class="btn btn-success" type="submit">Buscar</button>
            </div>

            <!-- ORDEN Y TOGGLE AVANZADO -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-sort text-muted"></i>
                    <label class="fw-bold text-muted mb-0">Ordenar:</label>
                    @foreach([
                        'fecha_desc' => 'Recientes',
                        'fecha_asc' => 'Antiguos',
                        'nombre_asc' => 'A-Z',
                    ] as $key => $label)
                        <label class="order-option {{ $selectedOrder == $key ? 'active' : '' }}">
                            <input type="radio" name="orden" value="{{ $key }}" onchange="this.form.submit()" hidden
                                   {{ $selectedOrder == $key ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
                <div>
                    <a class="toggle-advanced text-decoration-none" data-bs-toggle="collapse" href="#filtrosAvanzados" role="button">
                        <i class="fas fa-sliders-h me-1"></i> Filtros avanzados
                    </a>
                </div>
            </div>

            <!-- FILTROS AVANZADOS -->
            <div class="collapse mb-4" id="filtrosAvanzados">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="category_id" class="form-label"><i class="fas fa-folder-open me-1"></i> Categoría</label>
                        <select class="form-select" name="category_id" id="category_id">
                            <option value="">Todas las categorías</option>
                            @if(isset($categories))
                                @foreach($categories as $categoria)
                                    <option value="{{ $categoria->id }}" @selected(request('category_id') == $categoria->id)>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="form-label"><i class="fas fa-file-alt me-1"></i> Tipo de Documento</label>
                        <select class="form-select" name="tipo" id="tipo">
                            <option value="">Todos los tipos</option>
                            @if(isset($tipos))
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo }}" @selected(request('tipo') == $tipo)>
                                        {{ ucfirst($tipo) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre" class="form-label"><i class="fas fa-file-signature me-1"></i> Nombre o Tipo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" 
                               placeholder="Buscar por nombre del documento o tipo (decreto, resolución)" value="{{ request('nombre') }}">
                        <small class="text-muted">Busca en nombre del documento y tipo</small>
                    </div>
                    <div class="col-md-6">
                        <label for="numero" class="form-label"><i class="fas fa-hashtag me-1"></i> Número</label>
                        <input type="text" name="numero" id="numero" class="form-control" 
                               placeholder="Buscar por número del documento" value="{{ request('numero') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="año" class="form-label"><i class="fas fa-calendar me-1"></i> Año</label>
                        <select class="form-select" name="año" id="año">
                            <option value="">Todos los años</option>
                            @if(isset($años))
                                @foreach($años as $a)
                                    <option value="{{ $a }}" @selected(request('año') == $a)>{{ $a }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="mes" class="form-label"><i class="fas fa-calendar-week me-1"></i> Mes</label>
                        <select class="form-select" name="mes" id="mes">
                            <option value="">Todos los meses</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" @selected(request('mes') == $i)>
                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                        <small class="text-muted">Requiere seleccionar un año</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-calendar-day me-1"></i> Fecha desde</label>
                        <input type="date" name="fecha_desde" class="form-control" value="{{ request('fecha_desde') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-calendar-day me-1"></i> Fecha hasta</label>
                        <input type="date" name="fecha_hasta" class="form-control" value="{{ request('fecha_hasta') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-calendar-check me-1"></i> Fecha exacta</label>
                        <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">
                        <small class="text-muted">Solo si no usa rango de fechas</small>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="w-100">
                            <button class="btn btn-outline-secondary me-2" type="button" onclick="window.location.href='{{ route('home') }}'">
                                <i class="fas fa-times me-1"></i> Limpiar filtros
                            </button>
                            <button class="btn btn-success" type="submit">
                                <i class="fas fa-filter me-1"></i> Aplicar filtros
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if (
            request()->filled('busqueda_general') ||
            request()->filled('category_id') ||
            request()->filled('tipo') ||
            request()->filled('nombre') ||
            request()->filled('numero') ||
            request()->filled('año') ||
            request()->filled('mes') ||
            request()->filled('fecha') ||
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
                        <a href="{{ route('home', array_merge($baseParams, ['busqueda_general' => null])) }}"
                           class="badge text-white"
                           style="background-color: #43883D;">
                            🔍 {{ request('busqueda_general') }} &times;
                        </a>
                    @endif

                    @if(request()->filled('category_id'))
                        <a href="{{ route('home', array_merge($baseParams, ['category_id' => null])) }}"
                           class="badge text-white"
                           style="background-color: #4E7525;">
                            Categoría: {{ $categories->firstWhere('id', request('category_id'))?->nombre }} &times;
                        </a>
                    @endif

                    @if(request()->filled('tipo'))
                        <a href="{{ route('home', array_merge($baseParams, ['tipo' => null])) }}"
                           class="badge text-white"
                           style="background-color: #6A9739;">
                            Tipo: {{ ucfirst(request('tipo')) }} &times;
                        </a>
                    @endif

                    @if(request()->filled('nombre'))
                        <a href="{{ route('home', array_merge($baseParams, ['nombre' => null])) }}"
                           class="badge text-white"
                           style="background-color: #7A7A52;">
                            Nombre: {{ request('nombre') }} &times;
                        </a>
                    @endif

                    @if(request()->filled('numero'))
                        <a href="{{ route('home', array_merge($baseParams, ['numero' => null])) }}"
                           class="badge text-white"
                           style="background-color: #8B8B52;">
                            Número: {{ request('numero') }} &times;
                        </a>
                    @endif

                    @if(request()->filled('año'))
                        <a href="{{ route('home', array_merge($baseParams, ['año' => null])) }}"
                           class="badge text-white"
                           style="background-color: #B2B700;">
                            Año: {{ request('año') }} &times;
                        </a>
                    @endif

                    @if(request()->filled('mes'))
                        <a href="{{ route('home', array_merge($baseParams, ['mes' => null])) }}"
                           class="badge text-white"
                           style="background-color: #CCCC00;">
                            Mes: {{ \Carbon\Carbon::create()->month(request('mes'))->translatedFormat('F') }} &times;
                        </a>
                    @endif

                    @if(request()->filled('fecha'))
                        <a href="{{ route('home', array_merge($baseParams, ['fecha' => null])) }}"
                           class="badge text-white"
                           style="background-color: #878D47;">
                            Fecha: {{ request('fecha') }} &times;
                        </a>
                    @endif

                    @if(request()->filled('fecha_desde'))
                        <a href="{{ route('home', array_merge($baseParams, ['fecha_desde' => null])) }}"
                           class="badge text-white"
                           style="background-color: #878D47;">
                            Desde: {{ request('fecha_desde') }} &times;
                        </a>
                    @endif

                    @if(request()->filled('fecha_hasta'))
                        <a href="{{ route('home', array_merge($baseParams, ['fecha_hasta' => null])) }}"
                           class="badge text-white"
                           style="background-color: #878D47;">
                            Hasta: {{ request('fecha_hasta') }} &times;
                        </a>
                    @endif

                    @if(request()->filled('orden'))
                        <a href="{{ route('home', array_merge($baseParams, ['orden' => null])) }}"
                           class="badge text-dark bg-light border border-secondary">
                            Orden: {{
                                match(request('orden')) {
                                    'fecha_desc' => 'Más reciente',
                                    'fecha_asc' => 'Más antiguo',
                                    'nombre_asc' => 'Nombre A-Z',
                                    'numero_asc' => 'Por número',
                                    'tipo_asc' => 'Por tipo',
                                    'categoria_asc' => 'Por categoría',
                                    default => request('orden')
                                }
                            }} &times;
                        </a>
                    @endif
                </div>
            </div>
        @endif

        <!-- Listado de documentos -->
<!-- Listado de documentos con Bootstrap puro -->
<div class="row g-3">
    @if($documents->count() > 0)
        @foreach($documents as $document)
            @php
            $extension = strtolower(pathinfo($document->archivo, PATHINFO_EXTENSION));
            $iconClass = '';
            $bgClass = '';
            $textClass = '';
            $icon = '';
    
            if ($extension == 'pdf') {
                $iconClass = 'text-danger';
                $bgClass = 'bg-danger bg-opacity-10';
                $textClass = 'text-danger';
                $icon = '<i class="fas fa-file-pdf"></i>';
            } elseif (in_array($extension, ['doc', 'docx'])) {
                $iconClass = 'text-primary';
                $bgClass = 'bg-primary bg-opacity-10';
                $textClass = 'text-primary';
                $icon = '<i class="fas fa-file-word"></i>';
            } elseif (in_array($extension, ['xls', 'xlsx'])) {
                $iconClass = 'text-success';
                $bgClass = 'bg-success bg-opacity-10';
                $textClass = 'text-success';
                $icon = '<i class="fas fa-file-excel"></i>';
            } else {
                $iconClass = 'text-secondary';
                $bgClass = 'bg-secondary bg-opacity-10';
                $textClass = 'text-secondary';
                $icon = '<i class="fas fa-file-alt"></i>';
            }
            @endphp
    
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border border-2 border-light shadow-sm" style="border-radius: 12px; transition: all 0.3s ease;" 
                     onmouseover="this.style.transform='translateY(-3px)'; this.classList.add('shadow');" 
                     onmouseout="this.style.transform='translateY(0)'; this.classList.remove('shadow');">
                    
                    <div class="card-body p-4">
                        
                        <!-- Badges superiores -->
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge text-white fw-semibold px-3 py-2 rounded-pill" style="background-color: #2d6a2f; font-size: 0.85rem;">
                                {{ ucfirst($document->tipo) }}
                            </span>
                            <span class="badge bg-secondary text-white fw-semibold px-3 py-2 rounded-pill" style="font-size: 0.85rem;">
                                {{ \Carbon\Carbon::parse($document->fecha)->format('Y') }}
                            </span>
                            
                            @if($document->category)
                                <span class="badge bg-primary text-white fw-semibold px-3 py-2 rounded-pill" style="font-size: 0.85rem;">
                                    {{ Str::limit($document->category->nombre, 15) }}
                                </span>
                            @endif
                        </div>

                        <!-- Contenido principal con ícono y título -->
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="flex-shrink-0 {{ $bgClass }} rounded d-flex align-items-center justify-content-center" 
                                 style="width: 48px; height: 48px;">
                                <span class="{{ $iconClass }}" style="font-size: 1.5rem;">
                                    {!! $icon !!}
                                </span>
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <h5 class="card-title mb-2 fw-bold text-dark lh-sm" style="font-size: 1.1rem;">
                                    <a href="{{ route('document.show', $document->id) }}" 
                                       class="text-decoration-none text-dark stretched-link"
                                       onmouseover="this.classList.add('text-success');" 
                                       onmouseout="this.classList.remove('text-success');">
                                        {{ ucfirst($document->tipo) }}: No {{ $document->numero }} de {{ $document->nombre }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted mb-0 small">
                                    {{ Str::limit($document->descripcion, 50) }}
                                </p>
                            </div>
                        </div>

                        <!-- Información de fecha -->
                        <div class="d-flex flex-wrap gap-3 mb-3 small text-muted">
                            <div class="d-flex align-items-center gap-1">
                                <i class="fas fa-calendar text-primary"></i>
                                <span>{{ \Carbon\Carbon::parse($document->fecha)->format('d \d\e F \d\e\l Y') }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <i class="fas fa-clock text-primary"></i>
                                <span>{{ $document->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <!-- Botón Ver / Descargar -->
                        <div class="d-grid">
                            <a href="{{ asset('storage/' . $document->archivo) }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="btn text-white fw-bold py-2 rounded-2"
                               style="background-color: #2d6a2f; transition: background-color 0.3s ease;"
                               onmouseover="this.style.backgroundColor='#1f4e21';" 
                               onmouseout="this.style.backgroundColor='#2d6a2f';">
                                Ver / Descargar
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @else
        <!-- Estado vacío -->
        <div class="col-12">
            <div class="card border border-2 border-light shadow-sm bg-light" style="border-radius: 12px;">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-gavel text-muted opacity-25" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-success fw-bold mb-3">No hay documentos disponibles</h4>
                    <p class="text-muted mb-4">
                        @if(request()->hasAny(['busqueda_general', 'category_id', 'tipo', 'nombre', 'numero', 'año', 'mes', 'fecha', 'fecha_desde', 'fecha_hasta']))
                            No se encontraron documentos que coincidan con los filtros aplicados.
                        @else
                            Utilice los filtros de búsqueda para encontrar documentos específicos.
                        @endif
                    </p>
                    @if(request()->hasAny(['busqueda_general', 'category_id', 'tipo', 'nombre', 'numero', 'año', 'mes', 'fecha', 'fecha_desde', 'fecha_hasta']))
                        <a href="{{ route('home') }}" class="btn btn-outline-success">
                            <i class="fas fa-refresh me-2"></i>
                            Limpiar Filtros
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>



        <!-- SECCIÓN DE PAGINACIÓN MEJORADA -->
        @if($documents->hasPages())
            <div class="pagination-container">
                <!-- Enlaces de paginación -->
                <div class="d-flex justify-content-center">
                    {{ $documents->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
        
    </div>

    {{-- FIN SECCIÓN PRINCIPAL --}}

    {{-- FOOTER --}}
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
        document.addEventListener('DOMContentLoaded', function() {
            // Mejorar la experiencia con el filtro de mes
            const añoSelect = document.getElementById('año');
            const mesSelect = document.getElementById('mes');
            
            // Función para validar la selección de mes
            function validarMes() {
                if (mesSelect.value && !añoSelect.value) {
                    alert('Para filtrar por mes, primero debe seleccionar un año.');
                    mesSelect.value = '';
                }
            }
            
            // Agregar event listener al select de mes
            if (mesSelect) {
                mesSelect.addEventListener('change', validarMes);
            }
            
            // Agregar indicador visual cuando se selecciona año
            if (añoSelect) {
                añoSelect.addEventListener('change', function() {
                    if (this.value) {
                        mesSelect.style.border = '2px solid #43883d';
                        mesSelect.removeAttribute('disabled');
                    } else {
                        mesSelect.style.border = '';
                        mesSelect.value = '';
                    }
                });
            }
            
            // Preservar estado de filtros en chips
            const chips = document.querySelectorAll('.chip');
            chips.forEach(chip => {
                chip.addEventListener('click', function(e) {
                    // Pequeña animación visual
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 100);
                });
            });
        });
    </script>
</body>
</html>