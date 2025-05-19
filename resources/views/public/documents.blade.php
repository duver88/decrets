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

    {{-- sección de documentos --}}
<div class="container my-5" role="region" aria-labelledby="documentos-title">
        <div class="text-center mb-5">
            <h1 id="documentos-title" class="fw-bold" style="color: #43883d; font-family: 'Ubuntu', sans-serif;">
                Sistema de Búsqueda de Normas
                <small class="d-block fs-5 mt-2 text-muted">Alcaldía de Bucaramanga</small>
            </h1>
        </div>

        <form method="GET" action="{{ route('home') }}" class="bg-white border-0 p-4 rounded shadow-sm mb-5" style="border-top: 4px solid #43883d !important;" aria-label="Formulario para filtrar documentos">
            <h2 class="h5 mb-4" style="color: #43883d; font-family: 'Ubuntu', sans-serif;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 5px;">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Filtrar Documentos
            </h2>

            <div class="row g-3">
                <div class="col-md-3">
                    <label for="nombre" class="form-label visually-hidden">Buscar por nombre</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </span>
                        <input type="text" id="nombre" name="nombre" class="form-control border-start-0" placeholder="Buscar por nombre" value="{{ request('nombre') }}" aria-describedby="nombreHelp">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <label for="numero" class="form-label visually-hidden">Buscar por número</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1zm2 3v4h8V4H4z"/>
                                <path d="M0 7a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V7zm2 2v5h12V9H2z"/>
                            </svg>
                        </span>
                        <input type="text" id="numero" name="numero" class="form-control border-start-0" placeholder="Buscar por número" value="{{ request('numero') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="fecha" class="form-label visually-hidden">Buscar por fecha</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                        </span>
                        <input type="date" id="fecha" name="fecha" class="form-control border-start-0" value="{{ request('fecha') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="tipo" class="form-label visually-hidden">Tipo de documento</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                            </svg>
                        </span>
                        <select id="tipo" name="tipo" class="form-select border-start-0" aria-label="Seleccionar tipo de documento">
                            <option value="" {{ request('tipo') == '' ? 'selected' : '' }}>Tipo de Documento</option>
                            <option value="decreto" {{ request('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
                            <option value="resolución" {{ request('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                <button type="submit" class="btn d-flex align-items-center gap-2" style="background-color: #43883d; color: white; transition: all 0.3s ease;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    Filtrar
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2" style="transition: all 0.3s ease;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                    </svg>
                    Limpiar filtros
                </a>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @foreach($documents as $document)
                @php
                $extension = strtolower(pathinfo($document->archivo, PATHINFO_EXTENSION));
                $iconClass = '';
                $svgIcon = '';
        
                if ($extension == 'pdf') {
                    $iconClass = 'text-danger';
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                    </svg>';
                } elseif (in_array($extension, ['doc', 'docx'])) {
                    $iconClass = 'text-primary';
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                        <path d="M4.08 11.92 6 9.5 4.08 7.08l.92-.92L7.5 8.5l2.5-2.34.92.92L8.5 9.5l2.42 2.42-.92.92L7.5 10.5 5 12.84l-.92-.92z"/>
                    </svg>';
                } elseif (in_array($extension, ['xls', 'xlsx'])) {
                    $iconClass = 'text-success';
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
                    </svg>';
                } else {
                    $iconClass = 'text-secondary';
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 0 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                    </svg>';
                }
                @endphp
        
                <article class="col">
                    <div class="card h-100 border-0 shadow rounded overflow-hidden transition-all hover:shadow-lg" 
                         style="transition: all 0.3s ease; background-color: #f9f9f9;">
                        <div class="d-flex align-items-center p-3 gap-3">
                            <div class="flex-shrink-0 text-center" style="width: 70px;">
                                <div class="{{ $iconClass }}">
                                    {!! $svgIcon !!}
                                </div>
                                <span class="visually-hidden">{{ strtoupper($extension) }} archivo</span>
                            </div>
        
                            <div class="flex-grow-1">
                                <h3 class="h6 mb-2">
                                    <a href="{{ asset('storage/' . $document->archivo) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold" style="color: #43883d;">
                                        {{ ucfirst($document->tipo) }}: No {{ $document->numero }} de {{ $document->nombre }}
                                        
                                    </a>
                                </h3>
                                <p class="text-muted small mb-2">{{ Str::limit($document->descripcion, 110) }}</p>
                                <div class="d-flex align-items-center gap-3 mb-3 text-muted small">
                                    <div class="d-flex align-items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                        </svg>
                                        {{ $document->created_at->diffForHumans() }}
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($document->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}
                                    </div>
                                </div>
                                <a href="{{ route('document.show', $document->id) }}" class="btn btn-sm d-inline-flex align-items-center gap-2" style="background-color: #43883d; color: white;" aria-label="Ver más o descargar {{ $document->nombre }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg>
                                    Ver más / Descargar
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
