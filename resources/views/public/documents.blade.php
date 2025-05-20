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

    {{-- SECCIÓN MEJORADA: Sistema de Búsqueda de Normas --}}
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
                <div class="card h-100 border-0 cursor-pointer sistema-tab" data-tab="conoce-sistema" style="background-color: #43883d; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease;">
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
                <div class="card h-100 border-0 cursor-pointer sistema-tab active" data-tab="relatoria-actos" style="background-color: #3F8827; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease; border: 2px solid #93C01F;">
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
                <div class="card h-100 border-0 cursor-pointer sistema-tab" data-tab="relatoria-circulares" style="background-color: #43883d; color: white; border-radius: 10px; overflow: hidden; transition: all 0.3s ease;">
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

        <!-- Contenido de Pestaña 1: Conoce el sistema -->
        <div id="conoce-sistema-content" class="tab-content bg-white p-4 rounded shadow-sm" style="display: none;">
            <div class="text-center py-5">
                <div style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3>Información Próximamente</h3>
                <p class="text-muted mt-3">Estamos trabajando para brindarle más información sobre el Sistema de Búsqueda de Normas. <br>Por favor, vuelva a consultar más tarde.</p>
            </div>
        </div>

        <!-- Contenido de Pestaña 3: Relatoría de actos administrativos -->
        <div id="relatoria-actos-content" class="tab-content bg-white" style="display: block;">
            <!-- Formulario para filtrar documentos -->
            <form method="GET" action="{{ route('home') }}" class="bg-white text-[#93C01F] p-4 rounded mb-4">
                <h2 class="h5 mb-4 d-flex align-items-center">
                    <i class="fas fa-filter me-2" style="color: #93C01F;"></i>
                    Filtrar Documentos
                </h2>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="nombre" name="nombre" class="form-control border-start-0" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="numero" class="form-label">Número</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0">
                                <i class="fas fa-hashtag"></i>
                            </span>
                            <input type="text" id="numero" name="numero" class="form-control border-start-0" placeholder="Buscar por número" value="{{ request('numero') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <input type="date" id="fecha" name="fecha" class="form-control border-start-0" value="{{ request('fecha') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white text-muted border-end-0">
                                <i class="fas fa-file-alt"></i>
                            </span>
                            <select id="tipo" name="tipo" class="form-select border-start-0">
                                <option value="" {{ request('tipo') == '' ? 'selected' : '' }}>Todos los tipos</option>
                                <option value="decreto" {{ request('tipo') == 'decreto' ? 'selected' : '' }}>Decreto</option>
                                <option value="resolución" {{ request('tipo') == 'resolución' ? 'selected' : '' }}>Resolución</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-3">
                    <button type="submit" class="btn d-flex align-items-center gap-2" style="background-color: #43883d; color: white;">
                        <i class="fas fa-search"></i>
                        Buscar
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-outline-light d-flex align-items-center gap-2">
                        <i class="fas fa-undo"></i>
                        Limpiar filtros
                    </a>
                </div>
            </form>

            <!-- Listado de documentos -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                @foreach($documents as $document)
                    @php
                    $extension = strtolower(pathinfo($document->archivo, PATHINFO_EXTENSION));
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

        <!-- Contenido de Pestaña 4: Relatoría de circulares -->
        <div id="relatoria-circulares-content" class="tab-content bg-white p-4 rounded shadow-sm" style="display: none;">
            <div class="text-center py-5">
                <div style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>Información Próximamente</h3>
                <p class="text-muted mt-3">Estamos trabajando para brindarle acceso a las circulares de la entidad. <br>Por favor, vuelva a consultar más tarde.</p>
            </div>
        </div>
    </div>
    {{-- FIN SECCIÓN MEJORADA --}}

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
document.addEventListener('DOMContentLoaded', function() {
  const tabs = document.querySelectorAll('.sistema-tab');
  const tabContents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', e => {
      e.preventDefault(); // evitar navegación por link o href

      const tabId = tab.getAttribute('data-tab');

      tabs.forEach(t => {
        t.classList.remove('active');
        t.style.backgroundColor = '#43883d';
        t.style.border = 'none';
      });

      tabContents.forEach(c => {
        c.style.display = 'none';
      });

      tab.classList.add('active');
      tab.style.backgroundColor = '#3F8827';
      tab.style.border = '2px solid #93C01F';

      document.getElementById(`${tabId}-content`).style.display = 'block';
    });
  });
});

</script>
</body>
</html>