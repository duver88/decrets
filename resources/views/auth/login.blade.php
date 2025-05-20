<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Alcaldía de Bucaramanga') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-green: #43883d;
            --hover-green: #3F8827;
            --light-green: #51AD32;
            --light-bg: #EAECB1;
        }
        
        body {
            font-family: 'Ubuntu', sans-serif;
        }
        
        .bg-pattern {
            background-color: #f8f9fa;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2343883d' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="antialiased bg-pattern">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-xl rounded-lg">
            <!-- Logo principal -->
            <div class="flex justify-center mb-6">
                <div class="bg-[#43883d] p-4 rounded-lg inline-flex items-center justify-center">
                    <img src="https://www.bucaramanga.gov.co/wp-content/uploads/2025/05/Screenshot_7.png" 
                         alt="Alcaldía de Bucaramanga" 
                         class="h-16 md:h-20">
                </div>
            </div>
            
            <h2 class="text-2xl font-medium text-center text-gray-800 dark:text-gray-200 mb-8">
                Iniciar Sesión
            </h2>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 bg-[#D8E5B0] border-l-4 border-[#43883d] text-[#285F19] dark:bg-[#3F8827]/30 dark:text-[#B5CBA1] p-4 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Correo electrónico
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:border-[#43883d] focus:ring focus:ring-[#43883d]/20 dark:focus:ring-[#51AD32]/20 dark:focus:border-[#51AD32] transition duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                           placeholder="correo@ejemplo.com">
                    
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Contraseña
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-[#43883d] hover:text-[#3F8827] dark:text-[#51AD32] dark:hover:text-[#B5CBA1] transition duration-200">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>
                    
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:border-[#43883d] focus:ring focus:ring-[#43883d]/20 dark:focus:ring-[#51AD32]/20 dark:focus:border-[#51AD32] transition duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                           placeholder="••••••••">
                    
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input id="remember_me" 
                           type="checkbox" 
                           name="remember"
                           class="w-4 h-4 text-[#43883d] bg-white border-gray-300 rounded focus:ring-[#43883d] dark:focus:ring-[#51AD32] dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    <label for="remember_me" class="ms-2 text-sm text-gray-600 dark:text-gray-300">
                        Recordar mi sesión
                    </label>
                </div>

                <div>
                    <button type="submit" class="w-full py-3 px-4 bg-[#43883d] hover:bg-[#3F8827] dark:bg-[#51AD32] dark:hover:bg-[#3F8827] text-white font-medium rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#43883d] focus:ring-opacity-50 transition-all duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 mb-6 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">Alcaldía de Bucaramanga © {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>