<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg p-4 hidden md:block">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Dashboard</h2>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">Inicio</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('document.create') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">Crear Documento</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('category.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">Categorías</a>
                    </li>
                    <li class="mt-4 border-t border-gray-300 dark:border-gray-600 pt-2">
                        <a href="{{ route('logout') }}" class="block px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">Cerrar sesión</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white dark:bg-gray-800 shadow flex justify-between items-center px-6 py-4">
                <button class="md:hidden text-gray-700 dark:text-white" onclick="toggleSidebar()">
                    ☰
                </button>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">@yield('title', 'Panel de Control')</h2>
                <button onclick="toggleDarkMode()" class="bg-gray-300 dark:bg-gray-600 p-2 rounded-lg">
                    🌙 / ☀️
                </button>
            </header>

            <!-- Page Content -->
            <main class="p-6 bg-gray-50 dark:bg-gray-900 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
        }
    </script>
</body>
</html>
