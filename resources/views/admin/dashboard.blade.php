<!-- Vista dashboard con filtros avanzados -->
@extends('layouts.app')

@section('title', 'Dashboard - Documentos')

@section('content')

<!-- Tarjetas de resumen -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Documentos -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-[#43883d]">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-[#EAECB1] text-[#43883d]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-ubuntu font-semibold text-gray-700 dark:text-gray-200">Total Documentos</h2>
                <p class="mt-2 text-3xl font-ubuntu font-bold text-[#43883d] dark:text-[#93C01F]">{{ $documents->total() }}</p>
            </div>
        </div>
    </div>
    
    <!-- Decretos -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-[#f8dc0b]">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-[#FCF2B1] text-amber-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-ubuntu font-semibold text-gray-700 dark:text-gray-200">Decretos</h2>
                <p class="mt-2 text-3xl font-ubuntu font-bold text-amber-600 dark:text-amber-500">{{ $stats['por_tipo']['decreto'] ?? 0 }}</p>
            </div>
        </div>
    </div>
    
    <!-- Resoluciones -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-t-4 border-red-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-[#F0A9AA] text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-ubuntu font-semibold text-gray-700 dark:text-gray-200">Resoluciones</h2>
                <p class="mt-2 text-3xl font-ubuntu font-bold text-red-600 dark:text-red-500">{{ $stats['por_tipo']['resolución'] ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>

<!-- FORMULARIO DE FILTROS -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
    @php
        $selectedTipo = request('tipo');
        $selectedOrder = request('orden', 'fecha_desc');
        $currentCategory = request('category_id');
    @endphp

    <!-- CHIPS DE TIPOS DE DOCUMENTO -->
    <div class="mb-4">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Filtrar por tipo:</h3>
        <div class="flex flex-wrap gap-2">
            @if(isset($tipos) && $tipos->count() > 0)
                @foreach($tipos as $tipo)
                    <form method="GET" action="{{ route('dashboard') }}" class="inline">
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
                        <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium transition-colors
                            {{ $selectedTipo == $tipo ? 'bg-[#43883d] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#43883d] hover:text-white' }}">
                            {{ ucfirst($tipo) }} ({{ $stats['por_tipo'][$tipo] ?? 0 }})
                        </button>
                    </form>
                @endforeach
            @endif
            <form method="GET" action="{{ route('dashboard') }}" class="inline">
                @foreach(request()->except(['tipo', 'page']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
                <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium transition-colors
                    {{ !$selectedTipo ? 'bg-[#43883d] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#43883d] hover:text-white' }}">
                    Todos los tipos
                </button>
            </form>
        </div>
    </div>

    <!-- CHIPS DE CATEGORÍAS -->
    <div class="mb-4">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Filtrar por categoría:</h3>
        <div class="flex flex-wrap gap-2">
            @if(isset($categories) && $categories->count() > 0)
                @foreach($categories as $categoria)
                    @php
                        $countCategoria = $stats['por_categoria']->firstWhere('id', $categoria->id)?->documents_count ?? 0;
                    @endphp
                    <form method="GET" action="{{ route('dashboard') }}" class="inline">
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
                        <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium transition-colors
                            {{ $currentCategory == $categoria->id ? 'bg-[#43883d] text-white' : 'bg-gray-100 text-gray-700 hover:bg-[#43883d] hover:text-white' }}">
                            {{ $categoria->nombre }} ({{ $countCategoria }})
                        </button>
                    </form>
                @endforeach
            @endif
        </div>
    </div>

    <!-- BUSCADOR GENERAL -->
    <form method="GET" action="{{ route('dashboard') }}">
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
        
        <div class="flex gap-4 mb-4">
            <div class="flex-1">
                <input type="search" name="busqueda_general" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]"
                       placeholder="Buscar por nombre, número, descripción o tipo..." 
                       value="{{ request('busqueda_general') }}">
            </div>
            <button class="px-6 py-2 bg-[#43883d] text-white rounded-md hover:bg-[#3F8827] transition-colors" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Buscar
            </button>
        </div>

        <!-- ORDEN Y TOGGLE AVANZADO -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
            <div class="flex flex-wrap items-center gap-4 mb-2 md:mb-0">
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Ordenar por:</span>
                @foreach([
                    'fecha_desc' => 'Más recientes',
                    'fecha_asc' => 'Más antiguos',
                    'nombre_asc' => 'Nombre A-Z',
                    'numero_asc' => 'Por número',
                    'tipo_asc' => 'Por tipo',
                    'categoria_asc' => 'Por categoría'
                ] as $key => $label)
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="orden" value="{{ $key }}" onchange="this.form.submit()" 
                               class="mr-2 text-[#43883d] focus:ring-[#43883d]"
                               {{ $selectedOrder == $key ? 'checked' : '' }}>
                        <span class="text-sm {{ $selectedOrder == $key ? 'text-[#43883d] font-semibold' : 'text-gray-600' }}">
                            {{ $label }}
                        </span>
                    </label>
                @endforeach
            </div>
            <div>
                <button type="button" onclick="toggleAdvancedFilters()" 
                        class="text-[#43883d] hover:text-[#3F8827] text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                    </svg>
                    Filtros avanzados
                </button>
            </div>
        </div>

        <!-- FILTROS AVANZADOS -->
        <div id="filtrosAvanzados" class="hidden border-t pt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                    <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]">
                        <option value="">Todas las categorías</option>
                        @if(isset($categories))
                            @foreach($categories as $categoria)
                                <option value="{{ $categoria->id }}" {{ request('category_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Documento</label>
                    <select name="tipo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]">
                        <option value="">Todos los tipos</option>
                        @if(isset($tipos))
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo }}" {{ request('tipo') == $tipo ? 'selected' : '' }}>
                                    {{ ucfirst($tipo) }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre o Tipo</label>
                    <input type="text" name="nombre" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]"
                           placeholder="Buscar por nombre del documento" 
                           value="{{ request('nombre') }}">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Número</label>
                    <input type="text" name="numero" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]"
                           placeholder="Buscar por número del documento" 
                           value="{{ request('numero') }}">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Año</label>
                    <select name="año" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]">
                        <option value="">Todos los años</option>
                        @if(isset($años))
                            @foreach($años as $a)
                                <option value="{{ $a }}" {{ request('año') == $a ? 'selected' : '' }}>{{ $a }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mes</label>
                    <select name="mes" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]">
                        <option value="">Todos los meses</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('mes') == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha desde</label>
                    <input type="date" name="fecha_desde" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]"
                           value="{{ request('fecha_desde') }}">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha hasta</label>
                    <input type="date" name="fecha_hasta" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]"
                           value="{{ request('fecha_hasta') }}">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha exacta</label>
                    <input type="date" name="fecha" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#43883d] focus:border-[#43883d]"
                           value="{{ request('fecha') }}">
                </div>
            </div>
            
            <div class="flex justify-between mt-4">
                <button type="button" onclick="window.location.href='{{ route('dashboard') }}'" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                    Limpiar filtros
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-[#43883d] text-white rounded-md hover:bg-[#3F8827] transition-colors">
                    Aplicar filtros
                </button>
            </div>
        </div>
    </form>

    <!-- Filtros aplicados -->
    @if (request()->hasAny(['busqueda_general', 'category_id', 'tipo', 'nombre', 'numero', 'año', 'mes', 'fecha', 'fecha_desde', 'fecha_hasta', 'orden']))
        <div class="mt-4 pt-4 border-t">
            <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Filtros aplicados:</h6>
            <div class="flex flex-wrap gap-2">
                @php
                    $baseParams = request()->except(['_token', 'page']);
                @endphp

                @if(request()->filled('busqueda_general'))
                    <a href="{{ route('dashboard', array_merge($baseParams, ['busqueda_general' => null])) }}"
                       class="inline-flex items-center px-2 py-1 bg-[#43883d] text-white text-xs rounded-full">
                        🔍 {{ request('busqueda_general') }} ×
                    </a>
                @endif

                @if(request()->filled('category_id'))
                    <a href="{{ route('dashboard', array_merge($baseParams, ['category_id' => null])) }}"
                       class="inline-flex items-center px-2 py-1 bg-[#43883d] text-white text-xs rounded-full">
                        Categoría: {{ $categories->firstWhere('id', request('category_id'))?->nombre }} ×
                    </a>
                @endif

                @if(request()->filled('tipo'))
                    <a href="{{ route('dashboard', array_merge($baseParams, ['tipo' => null])) }}"
                       class="inline-flex items-center px-2 py-1 bg-[#43883d] text-white text-xs rounded-full">
                        Tipo: {{ ucfirst(request('tipo')) }} ×
                    </a>
                @endif

                <!-- Agregar más badges para otros filtros según necesidad -->
            </div>
        </div>
    @endif
</div>

<!-- Encabezado y botón agregar -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
    <div>
        <h1 class="text-2xl font-ubuntu font-bold text-[#43883d] dark:text-[#93C01F] mb-2">Listado de Documentos</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Mostrando {{ $documents->firstItem() }} - {{ $documents->lastItem() }} de {{ $documents->total() }} documentos
        </p>
    </div>
    <a href="{{ route('document.create') }}" class="inline-flex items-center px-4 py-2 bg-[#43883d] hover:bg-[#3F8827] text-white rounded-md shadow-sm transition duration-150 ease-in-out mt-4 md:mt-0">
        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Agregar Documento
    </a>
</div>

<!-- Mensaje de éxito -->
@if(session('success'))
    <div class="bg-[#D8E5B0] border-l-4 border-[#3F8827] text-[#285F19] p-4 mb-6 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-[#3F8827]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<!-- Grid de cards para documentos -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($documents as $document)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-shadow hover:shadow-lg">
            <!-- Cabecera de la card con color según tipo de documento -->
            <div class="p-4 {{ ucfirst($document->tipo) == 'Decreto' ? 'bg-[#FCF2B1]/40' : 'bg-[#43883d]/40' }}">
                <div class="flex justify-between items-start">
                    <!-- Categoría y Tipo -->
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#D8E5B0] text-[#285F19]">
                            {{ $document->category->nombre ?? 'Sin categoría' }}
                        </span>
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $document->tipo == 'decreto' ? 'bg-[#FCF2B1] text-amber-800' : 'bg-[#F0A9AA] text-red-800' }}">
                            {{ ucfirst($document->tipo) }}
                        </span>
                    </div>
                    
                    <!-- Ícono según tipo de documento -->
                    <div class="{{ ucfirst($document->tipo) == 'decreto' ? 'text-amber-600' : 'text-red-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Contenido principal de la card -->
            <div class="p-5">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    {{ ucfirst($document->tipo) }}: No {{ $document->numero }} de {{ $document->nombre }}
                </h3>
                
                @if($document->descripcion)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        {{ Str::limit($document->descripcion, 100) }}
                    </p>
                @endif
                
                <!-- Metadatos del documento -->
                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400 mb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Fecha: {{ \Carbon\Carbon::parse($document->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}</span>
                    </div>
                    
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Creado: {{ $document->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                
                <!-- Acciones para el documento -->
                <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ asset('storage/' . $document->archivo) }}" target="_blank" 
                        class="text-[#43883d] hover:text-[#3F8827] dark:text-[#93C01F] dark:hover:text-[#93C01F]/80 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>Ver</span>
                    </a>
                    
                    <div class="space-x-2">
                        <a href="{{ route('document.edit', $document->id) }}" 
                            class="inline-flex items-center px-3 py-1.5 bg-[#f8dc0b] hover:bg-[#FCF2B1] text-[#285F19] rounded-md text-sm transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Editar
                        </a>
                        
                        <form action="{{ route('document.destroy', $document->id) }}" method="POST" class="inline-block" 
                            onsubmit="return confirm('¿Seguro que deseas eliminar este documento?')">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-10 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-5">
                    @if(request()->hasAny(['busqueda_general', 'category_id', 'tipo', 'nombre', 'numero', 'año', 'mes', 'fecha', 'fecha_desde', 'fecha_hasta']))
                        No se encontraron documentos que coincidan con los filtros aplicados.
                    @else
                        No hay documentos registrados.
                    @endif
                </p>
                @if(request()->hasAny(['busqueda_general', 'category_id', 'tipo', 'nombre', 'numero', 'año', 'mes', 'fecha', 'fecha_desde', 'fecha_hasta']))
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md mr-3">
                        Limpiar filtros
                    </a>
                @endif
                <a href="{{ route('document.create') }}" class="inline-flex items-center px-4 py-2 bg-[#43883d] hover:bg-[#3F8827] text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ request()->hasAny(['busqueda_general', 'category_id', 'tipo', 'nombre', 'numero', 'año', 'mes', 'fecha', 'fecha_desde', 'fecha_hasta']) ? 'Crear nuevo documento' : 'Crear primer documento' }}
                </a>
            </div>
        </div>
    @endforelse
</div>

<!-- Paginación mejorada -->
@if($documents->hasPages())
    <div class="mt-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <!-- Información de paginación -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                <div class="mb-4 sm:mb-0">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Mostrando 
                        <span class="font-semibold text-[#43883d] dark:text-[#93C01F]">{{ $documents->firstItem() }}</span>
                        a 
                        <span class="font-semibold text-[#43883d] dark:text-[#93C01F]">{{ $documents->lastItem() }}</span>
                        de 
                        <span class="font-semibold text-[#43883d] dark:text-[#93C01F]">{{ $documents->total() }}</span>
                        documentos
                    </p>
                </div>
                
                <!-- Selector de elementos por página -->
                <div class="flex items-center space-x-2">
                    <label class="text-sm text-gray-700 dark:text-gray-300">Mostrar:</label>
                    <form method="GET" action="{{ route('dashboard') }}" id="perPageForm">
                        @foreach(request()->except(['page', 'per_page']) as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $v)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        
                        <select name="per_page" onchange="document.getElementById('perPageForm').submit()" 
                                class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-[#43883d] focus:border-[#43883d]">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <span class="text-sm text-gray-700 dark:text-gray-300">por página</span>
                </div>
            </div>

            <!-- Enlaces de paginación -->
            <div class="flex justify-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    {{-- Botón anterior --}}
                    @if ($documents->onFirstPage())
                        <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Anterior</span>
                        </span>
                    @else
                        <a href="{{ $documents->appends(request()->query())->previousPageUrl() }}" 
                           class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-[#43883d] hover:text-white hover:border-[#43883d] transition-colors">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Anterior</span>
                        </a>
                    @endif

                    {{-- Números de página --}}
                    @foreach ($documents->appends(request()->query())->getUrlRange(1, $documents->lastPage()) as $page => $url)
                        @if ($page == $documents->currentPage())
                            <span class="relative inline-flex items-center px-4 py-2 border border-[#43883d] bg-[#43883d] text-sm font-medium text-white">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" 
                               class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-[#43883d] hover:text-white hover:border-[#43883d] transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Botón siguiente --}}
                    @if ($documents->hasMorePages())
                        <a href="{{ $documents->appends(request()->query())->nextPageUrl() }}" 
                           class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-[#43883d] hover:text-white hover:border-[#43883d] transition-colors">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    @endif
                </nav>
            </div>

            <!-- Información adicional de navegación rápida -->
            @if($documents->lastPage() > 1)
                <div class="mt-4 flex justify-center">
                    <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                        <span>Ir a página:</span>
                        <form method="GET" action="{{ route('dashboard') }}" class="inline-flex">
                            @foreach(request()->except(['page']) as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $v)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            
                            <input type="number" name="page" min="1" max="{{ $documents->lastPage() }}" 
                                   value="{{ $documents->currentPage() }}"
                                   class="w-16 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-center text-sm bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300"
                                   onchange="this.form.submit()">
                            <span class="ml-1">de {{ $documents->lastPage() }}</span>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif

<script>
function toggleAdvancedFilters() {
    const filters = document.getElementById('filtrosAvanzados');
    filters.classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    // Mejorar la experiencia con el filtro de mes
    const añoSelect = document.querySelector('select[name="año"]');
    const mesSelect = document.querySelector('select[name="mes"]');
    
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
                mesSelect.style.borderColor = '#43883d';
                mesSelect.removeAttribute('disabled');
            } else {
                mesSelect.style.borderColor = '';
                mesSelect.value = '';
            }
        });
    }
});
</script>

@endsection