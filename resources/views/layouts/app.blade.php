<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Dashboard') }}</title>
  
  <!-- Fuentes -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  
  <!-- Vite: Tailwind CSS y JS -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <style>
    /* Transición para el sidebar */
    .sidebar {
      transition: transform 0.3s ease;
    }
    .sidebar-hidden {
      transform: translateX(-100%);
    }
  </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->

    <!-- Sidebar -->

    <!-- Sidebar -->
<aside id="sidebar" class="sidebar fixed z-40 inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-lg overflow-y-auto">
  <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Dashboard</h1>
    <button class="md:hidden focus:outline-none" onclick="toggleSidebar()">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>
  <nav class="mt-6">
    <ul class="space-y-2">
      <!-- Sección: Relatoría actos administrativos -->
      <li>
        <div class="px-4 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
          Relatoría actos administrativos
        </div>
        <ul class="pl-2">
          <li>
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600 dark:text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 2a1 1 0 00-.894.553L5.382 9H3a1 1 0 000 2h2.382l3.724 6.447A1 1 0 0010 18a1 1 0 00.894-.553l3.724-6.447H17a1 1 0 100-2h-2.382l-3.724-6.447A1 1 0 0010 2z"/>
              </svg>
              <span>Inicio</span>
            </a>
          </li>
          <li>
            <a href="{{ route('document.create') }}" class="flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              <span>Crear Documento</span>
            </a>
          </li>
          <li>
            <a href="{{ route('category.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
              </svg>
              <span>Categorías</span>
            </a>
          </li>
          @if(auth()->user()->is_admin)  
          <li>  
            <a href="{{ route('permissions.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded">  
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
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
        <div class="px-4 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
          Relatoría conceptos
        </div>
        <ul class="pl-2">
          <li>
            <a href="{{ route('concepts.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
              </svg>
              <span>Inicio Conceptos</span>
            </a>
          </li>
          <li>
            <a href="{{ route('concepts.create') }}" class="flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              <span>Crear Concepto</span>
            </a>
          </li>
          <li>
            <a href="{{ route('concepts.categories') }}" class="flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
              </svg>
              <span>Categorías Conceptos</span>
            </a>
          </li>
          @if(auth()->user()->is_admin)  
          <li>  
            <a href="{{ route('concepts.permissions') }}" class="flex items-center px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded">  
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>  
              </svg>  
              <span>Asignar Categorías Conceptos</span>  
            </a>  
          </li>  
          @endif
        </ul>
      </li>

      <!-- Cerrar sesión -->
      <li class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
          @csrf
          <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900 transition-colors rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
            </svg>
            <span>Cerrar sesión</span>
          </button>
        </form>
      </li>
    </ul>
  </nav>
</aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col ml-0 md:ml-64 transition-all duration-300">
      <!-- Navbar -->
      <header class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 shadow px-6 py-4 flex items-center justify-between">
        <button class="md:hidden focus:outline-none" onclick="toggleSidebar()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
          @yield('title', 'Panel de Control')
        </h2>
        <div class="flex items-center space-x-4">
          <!-- Botón para alternar tema claro/oscuro -->
          <button onclick="toggleDarkMode()" class="focus:outline-none">
            <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 dark:text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path id="theme-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M12 3v1m0 16v1m8.66-10h-1M4.34 12h-1m15.02 5.02l-.7-.7M6.38 6.38l-.7-.7m12.02 12.02l-.7-.7M6.38 17.62l-.7-.7M12 5a7 7 0 000 14 7 7 0 000-14z" />
            </svg>
          </button>
          <!-- Perfil de usuario (placeholder) -->
          <div class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-600"></div>
        </div>
      </header>

      <!-- Contenido de la página -->
      <main class="flex-1 p-6 overflow-y-auto">
        @yield('content')
      </main>
    </div>
  </div>

  <script>
    // Alterna la visibilidad del sidebar en dispositivos móviles
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('sidebar-hidden');
    }

    // Alterna el modo oscuro y guarda la preferencia en localStorage
    function toggleDarkMode() {
      document.documentElement.classList.toggle('dark');
      if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
      updateThemeIcon();
    }

    // Actualiza el icono según el modo actual
    function updateThemeIcon() {
      const themeIconPath = document.getElementById('theme-icon-path');
      if (document.documentElement.classList.contains('dark')) {
        // Icono de sol (modo oscuro activo, clic para cambiar a claro)
        themeIconPath.setAttribute('d', 'M12 3v1m0 16v1m8.66-10h-1M4.34 12h-1m15.02 5.02l-.7-.7M6.38 6.38l-.7-.7m12.02 12.02l-.7-.7M6.38 17.62l-.7-.7M12 5a7 7 0 000 14 7 7 0 000-14z');
      } else {
        // Icono de luna (modo claro activo, clic para cambiar a oscuro)
        themeIconPath.setAttribute('d', 'M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z');
      }
    }

    // Al cargar la página, establece el modo según la preferencia guardada en localStorage
    document.addEventListener('DOMContentLoaded', function() {
      if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
      updateThemeIcon();
    });
  </script>
</body>
</html>
