<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Dashboard') }}</title>
  
  <!-- Fuentes Ubuntu (Principal) y Oswald (Secundaria) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&family=Oswald:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <!-- Vite: Tailwind CSS y JS -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <style>
    /* Estilos globales según manual de identidad */
    html, body {
      height: 100%;
      font-family: 'Ubuntu', sans-serif;
    }
    
    /* Colores institucionales */
    :root {
      --color-primary: #43883d;       /* Verde principal - Pantone 348C */
      --color-primary-dark: #285F19;  /* Verde oscuro */
      --color-primary-light: #93C01F; /* Verde claro */
      --color-secondary: #f8dc0b;     /* Amarillo - Pantone 108C */
      --color-light-bg: #EAECB1;      /* Fondo claro */
      --color-medium-bg: #D8E5B0;     /* Fondo medio */
    }
    
    /* Estilos para el sidebar */
    #sidebar {
      transition: transform 0.3s ease;
      width: 256px; /* 16rem exactos */
      position: fixed;
      left: 0;
      top: 0;
      height: 100vh;
      z-index: 50;
    }
    
    /* Estilos para temas claro/oscuro */
    .dark .theme-icon-dark { display: block; }
    .dark .theme-icon-light { display: none; }
    .theme-icon-dark { display: none; }
    .theme-icon-light { display: block; }
    
    /* Comportamiento del sidebar */
    .sidebar-closed {
      transform: translateX(-256px);
    }
    
    /* Modo de escritorio */
    @media (min-width: 1280px) {
      #sidebar {
        transform: none !important; /* Siempre visible en escritorio */
      }
      
      .main-content {
        margin-left: 256px; /* Exactamente el ancho del sidebar */
      }
    }
    
    /* Ocultar scroll cuando sidebar está abierto */
    body.sidebar-open {
      overflow: hidden;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
  <!-- Overlay para cuando el sidebar está abierto en modo móvil -->
  <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden xl:hidden" onclick="toggleSidebar()"></div>
  
  <!-- Sidebar - absolutamente posicionado fuera del flujo normal -->
  <aside id="sidebar" class="bg-white dark:bg-gray-800 shadow-lg overflow-auto sidebar-closed xl:sidebar-open">
    <!-- Cabecera del sidebar con logo -->
    <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700 bg-[#43883d]">
      <div class="flex items-center justify-center w-full">
        <div class="text-center">
          <!-- Imagen oficial del logo -->
          <img 
            src="https://www.bucaramanga.gov.co/wp-content/uploads/2025/05/Screenshot_7.png" 
            alt="Logo Alcaldía de Bucaramanga"
            class="w-16 h-auto mx-auto"
          />
          <h3 class="mt-1 text-sm md:text-base font-bold text-white uppercase tracking-wide leading-tight">
            Alcaldía de<br>Bucaramanga
          </h3>
        </div>
      </div>

      <button class="xl:hidden absolute right-4 top-4 focus:outline-none text-white" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    
    <!-- Navegación del sidebar -->
    <nav class="py-6">
      <ul class="space-y-2">
        <!-- Sección: Relatoría actos administrativos -->
        <li>
          <div class="px-4 py-2 text-sm font-medium text-[#43883d] dark:text-[#93C01F] uppercase tracking-wider">
            Relatoría actos administrativos
          </div>
          <ul class="pl-2">
            <li>
              <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                <span>Inicio</span>
              </a>
            </li>
            <li>
              <a href="{{ route('document.create') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Crear Documento</span>
              </a>
            </li>
            <li>  
            <a href="{{ route('documents.categories') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">  
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>  
              </svg>  
              <span>Tipos y Temas</span>  
            </a>  
          </li>
            <li>
              <a href="{{ route('category.index') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <span>Categorías</span>
              </a>
            </li>
            @if(auth()->user()->is_admin)  
            <li>  
              <a href="{{ route('permissions.index') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">  
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>  
                </svg>  
                <span>Asignar Categorías</span>  
              </a>  
            </li>  
            @endif
          </ul>
        </li>
        
        <!-- Sección: Relatoría conceptos -->
        <li class="mt-4">
          <div class="px-4 py-2 text-sm font-medium text-[#43883d] dark:text-[#93C01F] uppercase tracking-wider">
            Relatoría conceptos
          </div>
          <ul class="pl-2">
            <li>
              <a href="{{ route('concepts.index') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Inicio Conceptos</span>
              </a>
            </li>
            <li>
              <a href="{{ route('concepts.create') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Crear Concepto</span>
              </a>
            </li>
            <li>
              <a href="{{ route('concepts.categories') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <span>Categorías Conceptos</span>
              </a>
            </li>
            @if(auth()->user()->is_admin)  
            <li>  
              <a href="{{ route('concepts.permissions') }}" class="flex items-center px-4 py-3 hover:bg-[#EAECB1] dark:hover:bg-[#285F19] transition-colors rounded">  
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>  
                </svg>  
                <span>Asignar Categorías Conceptos</span>  
              </a>  
            </li>  
            @endif
          </ul>
        </li>

        <!-- Cerrar sesión -->
        <li class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4 pb-6">
          <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              <span>Cerrar sesión</span>
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Contenido principal - inicia exactamente alineado con el borde del sidebar -->
  <div class="main-content min-h-screen w-full xl:w-[calc(100%-256px)] xl:ml-[256px]">
    <!-- Navbar -->
    <header class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 shadow-sm px-4 sm:px-6 py-3 flex items-center justify-between">
      <div class="flex items-center">
        <button class="xl:hidden focus:outline-none mr-4 rounded p-1 hover:bg-gray-100 dark:hover:bg-gray-700" onclick="toggleSidebar()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#43883d] dark:text-[#93C01F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
        <h2 class="text-lg sm:text-xl font-ubuntu font-semibold text-[#43883d] dark:text-[#93C01F] truncate">
          @yield('title', 'Panel de Control')
        </h2>
      </div>
      <div class="flex items-center space-x-4">
        <!-- Botón para alternar tema claro/oscuro -->
        <button onclick="toggleDarkMode()" class="focus:outline-none rounded-full p-2 bg-gray-100 dark:bg-gray-700">
          <!-- Sol (modo claro) -->
          <svg class="theme-icon-light h-5 w-5 text-[#f8dc0b]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <!-- Luna (modo oscuro) -->
          <svg class="theme-icon-dark h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>
        
        <!-- Perfil de usuario con colores del manual -->
        <div class="flex items-center">
          <div class="w-8 h-8 rounded-full bg-[#43883d] text-white flex items-center justify-center font-bold">
            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
          </div>
          <span class="ml-2 hidden sm:block text-sm text-gray-700 dark:text-gray-300">
            {{ auth()->user()->name ?? 'Usuario' }}
          </span>
        </div>
      </div>
    </header>

    <!-- Contenido principal -->
    <main class="w-full p-4 sm:p-6 overflow-y-auto bg-[#EAECB1]/10 dark:bg-gray-900">
      @yield('content')
    </main>
    
    <!-- Footer institucional -->
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-3 px-4 sm:px-6 text-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
      <p class="font-ubuntu">
        © {{ date('Y') }} Alcaldía de Bucaramanga - Todos los derechos reservados
      </p>
    </footer>
  </div>

  <script>
    // Alterna la visibilidad del sidebar
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebar-overlay');
      const body = document.body;
      
      // Toggle sidebar visibility
      sidebar.classList.toggle('sidebar-closed');
      
      // Toggle overlay and body scroll lock
      if (sidebar.classList.contains('sidebar-closed')) {
        overlay.classList.add('hidden');
        body.classList.remove('sidebar-open');
      } else {
        overlay.classList.remove('hidden');
        body.classList.add('sidebar-open');
      }
    }

    // Alterna el modo oscuro y guarda la preferencia en localStorage
    function toggleDarkMode() {
      document.documentElement.classList.toggle('dark');
      if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    }

    // Inicialización
    document.addEventListener('DOMContentLoaded', function() {
      // Tema oscuro
      if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
      
      // Iniciar con sidebar cerrado en dispositivos no-desktop
      const sidebar = document.getElementById('sidebar');
      if (window.innerWidth < 1280) { // xl breakpoint
        sidebar.classList.add('sidebar-closed');
      } else {
        sidebar.classList.remove('sidebar-closed');
      }
      
      // Escuchar cambios de tamaño de ventana
      window.addEventListener('resize', function() {
        if (window.innerWidth >= 1280) { // xl breakpoint
          sidebar.classList.remove('sidebar-closed');
        } else if (!sidebar.classList.contains('sidebar-closed')) {
          sidebar.classList.add('sidebar-closed');
        }
      });
    });
  </script>
</body>
</html>