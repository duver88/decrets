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


    <style>
        body { font-family: 'Ubuntu', sans-serif; 
        margin: 0;
        padding: 0;
    }

    </style>
</head>
<body>
    {{-- Header --}}
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

    {{-- sección de documentos --}}
        <div class="container my-5" role="region" aria-labelledby="documentos-title">
        <h1 id="documentos-title" class="text-center mb-4">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            Sistema de Busqueda de Normas Propios de la Entidad
        </h1>

        <form method="GET" action="{{ route('home') }}" class="border p-4 rounded shadow-sm mb-5" aria-label="Formulario para filtrar documentos">
            <h2 class="h4 mb-3">
            <i class="fa fa-filter" aria-hidden="true"></i>
            Filtrar Documentos
            </h2>

            <div class="row g-3">
            <div class="col-md-3">
                <label for="nombre" class="form-label visually-hidden">Buscar por nombre</label>
                <div class="input-group">
                <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ request('nombre') }}" aria-describedby="nombreHelp">
                </div>
            </div>
            
            <div class="col-md-3">
                <label for="numero" class="form-label visually-hidden">Buscar por número</label>
                <div class="input-group">
                <span class="input-group-text"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                <input type="text" id="numero" name="numero" class="form-control" placeholder="Buscar por número" value="{{ request('numero') }}">
                </div>
            </div>

            <div class="col-md-3">
                <label for="fecha" class="form-label visually-hidden">Buscar por fecha</label>
                <div class="input-group">
                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="date" id="fecha" name="fecha" class="form-control" value="{{ request('fecha') }}">
                </div>
            </div>

            <div class="col-md-3">
                <label for="tipo" class="form-label visually-hidden">Tipo de documento</label>
                <div class="input-group">
                <span class="input-group-text"><i class="fa fa-folder" aria-hidden="true"></i></span>
                <select id="tipo" name="tipo" class="form-select" aria-label="Seleccionar tipo de documento">
                    <option value="" {{ request('tipo') == '' ? 'selected' : '' }}>Tipo de Documento</option>
                    <option value="decreto" {{ request('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
                    <option value="resolución" {{ request('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
                </select>
                </div>
            </div>
            </div>

            <div class="mt-4 d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
            </button>
            <a href="{{ route('home') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                <i class="fa fa-times" aria-hidden="true"></i> Limpiar filtros
            </a>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @foreach($documents as $document)
                @php
                $extension = strtolower(pathinfo($document->archivo, PATHINFO_EXTENSION));
                $iconClass = 'fa-file-o text-secondary';
                $iconColorClass = '';

                if ($extension == 'pdf') {
                    $iconClass = 'fa-file-pdf-o';
                    $iconColorClass = 'text-danger'; 
                } elseif (in_array($extension, ['doc', 'docx'])) {
                    $iconClass = 'fa-file-word-o';
                    $iconColorClass = 'text-primary';
                } elseif (in_array($extension, ['xls', 'xlsx'])) {
                    $iconClass = 'fa-file-excel-o';
                    $iconColorClass = 'text-success';
                }
                @endphp

                <article class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <div class="d-flex align-items-center p-3 gap-3">
                    <div class="flex-shrink-0 text-center" style="width: 70px;">
                        <i class="fa {{ $iconClass }} {{ $iconColorClass }} fa-4x" aria-hidden="true" title="Archivo tipo {{ strtoupper($extension) }}"></i>
                        <span class="visually-hidden">{{ strtoupper($extension) }} archivo</span>
                    </div>

                    <div class="flex-grow-1">
                        <h3 class="h6 mb-2">
                        <a href="{{ asset('storage/' . $document->archivo) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-primary fw-semibold">
                            {{ ucfirst($document->tipo) }} {{ $document->numero }} - {{ $document->nombre }}
                        </a>
                        </h3>
                        <p class="text-muted mb-2">{{ Str::limit($document->descripcion, 110) }}</p>
                        <small class="text-muted d-block mb-3">
                        <i class="fa fa-clock-o" aria-hidden="true"></i> Publicación: {{ $document->created_at->diffForHumans() }}<br>
                        <i class="fa fa-calendar" aria-hidden="true"></i> Expedición: {{ \Carbon\Carbon::parse($document->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}
                        </small>
                        <a href="{{ route('document.show', $document->id) }}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2" aria-label="Ver más o descargar {{ $document->nombre }}">
                        <i class="fa fa-download" aria-hidden="true"></i> Ver más / Descargar
                        </a>
                    </div>
                    </div>
                </div>
                </article>
            @endforeach
            </div>

        </div>

    {{-- Fin sección de documentos --}}


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

</body>
</html>
