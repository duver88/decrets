@extends('layouts.app')

@section('title', 'Relatoría Conceptos')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <!-- Botones de acceso rápido con diseño actualizado -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('concepts.create') }}" class="flex items-center justify-center gap-2 bg-[#43883d] hover:bg-[#3F8827] text-white rounded-md p-4 shadow-md transition duration-300 focus:outline-none focus:ring-4 focus:ring-[#93C01F]/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-ubuntu font-medium">Crear Concepto</span>
            </a>
            <a href="{{ route('concepts.categories') }}" class="flex items-center justify-center gap-2 bg-[#43883d] hover:bg-[#3F8827] text-white rounded-md p-4 shadow-md transition duration-300 focus:outline-none focus:ring-4 focus:ring-[#93C01F]/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <span class="font-ubuntu font-medium">Categorías</span>
            </a>
            @if(auth()->user()->is_admin)
            <a href="{{ route('concepts.permissions') }}" class="flex items-center justify-center gap-2 bg-[#43883d] hover:bg-[#3F8827] text-white rounded-md p-4 shadow-md transition duration-300 focus:outline-none focus:ring-4 focus:ring-[#93C01F]/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span class="font-ubuntu font-medium">Asignar Permisos</span>
            </a>
            @endif
        </div>
    </div>

    <!-- Mensajes flash con colores actualizados -->
    @if(session('success'))
        <div class="mb-6 rounded-md border-l-4 border-[#3F8827] bg-[#D8E5B0] p-4 text-[#285F19] shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 rounded-md border-l-4 border-red-500 bg-red-50 p-4 text-red-700 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- SECCIÓN DE FILTROS Y BÚSQUEDA -->
<!-- SECCIÓN DE FILTROS Y BÚSQUEDA -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8 border border-gray-200 dark:border-gray-700">
    @php
        $selectedType = request('concept_type_id');
        $selectedOrder = request('orden', 'fecha_desc');
        $currentTipoDocumento = request('tipo_documento');
    @endphp

    <!-- CHIPS DE TIPOS DE DOCUMENTO -->
    <div class="mb-4">
        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tipo de Documento:</h4>
        <div class="flex flex-wrap gap-2">
            @foreach($tiposDocumento as $tipo)
                <form method="GET" action="{{ route('concepts.index') }}" class="inline">
                    @foreach(request()->except(['tipo_documento', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input type="hidden" name="tipo_documento" value="{{ $tipo }}">
                    <button type="submit" class="px-3 py-1 text-sm rounded-full transition-colors border {{ $currentTipoDocumento == $tipo ? 'bg-[#43883d] text-white border-[#43883d]' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        {{ $tipo }} ({{ $stats['por_tipo_documento'][$tipo] ?? 0 }})
                    </button>
                </form>
            @endforeach
            <form method="GET" action="{{ route('concepts.index') }}" class="inline">
                @foreach(request()->except(['tipo_documento', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" class="px-3 py-1 text-sm rounded-full transition-colors border {{ !$currentTipoDocumento ? 'bg-[#43883d] text-white border-[#43883d]' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    Todos
                </button>
            </form>
        </div>
    </div>

    <!-- CHIPS DE TIPOS DE CONCEPTO -->
    <div class="mb-6">
        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tipo de Concepto:</h4>
        <div class="flex flex-wrap gap-2">
            @foreach($conceptTypes as $tipo)
                <form method="GET" action="{{ route('concepts.index') }}" class="inline">
                    @foreach(request()->except(['concept_type_id', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input type="hidden" name="concept_type_id" value="{{ $tipo->id }}">
                    <button type="submit" class="px-3 py-1 text-sm rounded-full transition-colors border {{ $selectedType == $tipo->id ? 'bg-[#43883d] text-white border-[#43883d]' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        {{ $tipo->nombre }}
                    </button>
                </form>
            @endforeach
        </div>
    </div>

    <!-- FORMULARIO DE BÚSQUEDA Y FILTROS PRINCIPALES -->
    <form method="GET" action="{{ route('concepts.index') }}" class="space-y-4">
        <!-- BUSCADOR GENERAL -->
        <div class="flex gap-2">
            <div class="flex-1">
                <input type="search" 
                       name="busqueda_general" 
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#43883d] dark:focus:border-[#43883d] placeholder-gray-500 dark:placeholder-gray-400"
                       placeholder="Buscar por título, contenido, año..." 
                       value="{{ request('busqueda_general') }}">
            </div>
            <button type="submit" class="px-6 py-2 bg-[#43883d] text-white rounded-md hover:bg-[#3F8827] transition focus:outline-none focus:ring-4 focus:ring-[#93C01F]/50">
                Buscar
            </button>
        </div>

        <!-- FILTROS PRINCIPALES -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Ordenamiento -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ordenar por:</label>
                <select name="orden" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#43883d] dark:focus:border-[#43883d]" 
                        onchange="this.form.submit()">
                    <option value="fecha_desc" {{ request('orden') == 'fecha_desc' ? 'selected' : '' }}>Más recientes</option>
                    <option value="fecha_asc" {{ request('orden') == 'fecha_asc' ? 'selected' : '' }}>Más antiguos</option>
                    <option value="titulo_asc" {{ request('orden') == 'titulo_asc' ? 'selected' : '' }}>Título A-Z</option>
                    <option value="titulo_desc" {{ request('orden') == 'titulo_desc' ? 'selected' : '' }}>Título Z-A</option>
                </select>
            </div>

            <!-- Tipo de Concepto -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Concepto:</label>
                <select name="concept_type_id" 
                        id="concept_type_id" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#43883d] dark:focus:border-[#43883d]">
                    <option value="">Todos</option>
                    @foreach($conceptTypes as $tipo)
                        <option value="{{ $tipo->id }}" {{ request('concept_type_id') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tema específico -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tema específico:</label>
                <select name="concept_theme_id" 
                        id="concept_theme_id" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#43883d] dark:focus:border-[#43883d]">
                    <option value="">Todos</option>
                    @foreach($conceptThemes as $tema)
                        <option value="{{ $tema->id }}" data-type-id="{{ $tema->concept_type_id }}"
                            {{ request('concept_theme_id') == $tema->id ? 'selected' : '' }}>
                            {{ $tema->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Año -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Año:</label>
                <select name="año" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#43883d] dark:focus:border-[#43883d]">
                    <option value="">Todos</option>
                    @foreach($años as $a)
                        <option value="{{ $a }}" {{ request('año') == $a ? 'selected' : '' }}>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- FILTROS AVANZADOS (COLAPSABLES) -->
        <div class="border-t pt-4 border-gray-200 dark:border-gray-600">
            <button type="button" id="toggle-advanced" class="text-[#43883d] text-sm font-medium hover:text-[#3F8827] transition focus:outline-none">
                <span id="toggle-text">Mostrar filtros avanzados</span>
                <svg id="toggle-icon" class="inline w-4 h-4 ml-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div id="advanced-filters" class="mt-4 space-y-4 hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Tipo de Documento -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Documento:</label>
                        <select name="tipo_documento" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#43883d] dark:focus:border-[#43883d]">
                            <option value="">Todos</option>
                            @foreach($tiposDocumento as $tipo)
                                <option value="{{ $tipo }}" {{ request('tipo_documento') == $tipo ? 'selected' : '' }}>
                                    {{ $tipo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fecha desde -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha desde:</label>
                        <input type="date" 
                               name="fecha_desde" 
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#43883d] dark:focus:border-[#43883d]" 
                               value="{{ request('fecha_desde') }}">
                    </div>

                    <!-- Fecha hasta -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha hasta:</label>
                        <input type="date" 
                               name="fecha_hasta" 
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#43883d] dark:focus:border-[#43883d]" 
                               value="{{ request('fecha_hasta') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTONES DE ACCIÓN GLOBALES (Fuera de filtros avanzados) -->
        <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
            <div class="flex gap-2 justify-end">
                <a href="{{ route('concepts.index') }}" 
                   class="px-4 py-2 bg-gray-500 dark:bg-gray-600 text-white rounded-md hover:bg-gray-600 dark:hover:bg-gray-700 transition focus:outline-none focus:ring-4 focus:ring-gray-500/50">
                    Limpiar filtros
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-[#43883d] text-white rounded-md hover:bg-[#3F8827] transition focus:outline-none focus:ring-4 focus:ring-[#93C01F]/50">
                    Aplicar filtros
                </button>
            </div>
        </div>
    </form>

    <!-- FILTROS APLICADOS -->
    @if(request()->hasAny(['busqueda_general', 'concept_type_id', 'concept_theme_id', 'tipo_documento', 'año', 'fecha_desde', 'fecha_hasta', 'orden']))
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
            <h6 class="text-sm font-semibold text-[#43883d] mb-2">Filtros aplicados:</h6>
            <div class="flex flex-wrap gap-2">
                @php
                    $baseParams = request()->except(['_token', 'page']);
                @endphp

                @if(request()->filled('busqueda_general'))
                    <a href="{{ route('concepts.index', array_merge($baseParams, ['busqueda_general' => null])) }}"
                       class="inline-flex items-center px-3 py-1 bg-[#43883d] text-white text-xs rounded-full hover:bg-[#3F8827] transition">
                        🔍 {{ request('busqueda_general') }}
                        <span class="ml-1">×</span>
                    </a>
                @endif

                @if(request()->filled('concept_type_id'))
                    <a href="{{ route('concepts.index', array_merge($baseParams, ['concept_type_id' => null, 'concept_theme_id' => null])) }}"
                       class="inline-flex items-center px-3 py-1 bg-[#3F8827] text-white text-xs rounded-full hover:bg-[#285F19] transition">
                        Tipo: {{ $conceptTypes->firstWhere('id', request('concept_type_id'))?->nombre }}
                        <span class="ml-1">×</span>
                    </a>
                @endif

                @if(request()->filled('concept_theme_id'))
                    <a href="{{ route('concepts.index', array_merge($baseParams, ['concept_theme_id' => null])) }}"
                       class="inline-flex items-center px-3 py-1 bg-[#6A9739] text-white text-xs rounded-full hover:bg-[#5A8629] transition">
                        Tema: {{ $conceptThemes->firstWhere('id', request('concept_theme_id'))?->nombre }}
                        <span class="ml-1">×</span>
                    </a>
                @endif

                @if(request()->filled('tipo_documento'))
                    <a href="{{ route('concepts.index', array_merge($baseParams, ['tipo_documento' => null])) }}"
                       class="inline-flex items-center px-3 py-1 bg-gray-600 dark:bg-gray-500 text-white text-xs rounded-full hover:bg-gray-700 dark:hover:bg-gray-600 transition">
                        Documento: {{ request('tipo_documento') }}
                        <span class="ml-1">×</span>
                    </a>
                @endif

                @if(request()->filled('año'))
                    <a href="{{ route('concepts.index', array_merge($baseParams, ['año' => null])) }}"
                       class="inline-flex items-center px-3 py-1 bg-yellow-600 dark:bg-yellow-500 text-white text-xs rounded-full hover:bg-yellow-700 dark:hover:bg-yellow-600 transition">
                        Año: {{ request('año') }}
                        <span class="ml-1">×</span>
                    </a>
                @endif

                @if(request()->filled('fecha_desde'))
                    <a href="{{ route('concepts.index', array_merge($baseParams, ['fecha_desde' => null])) }}"
                       class="inline-flex items-center px-3 py-1 bg-indigo-600 dark:bg-indigo-500 text-white text-xs rounded-full hover:bg-indigo-700 dark:hover:bg-indigo-600 transition">
                        Desde: {{ request('fecha_desde') }}
                        <span class="ml-1">×</span>
                    </a>
                @endif

                @if(request()->filled('fecha_hasta'))
                    <a href="{{ route('concepts.index', array_merge($baseParams, ['fecha_hasta' => null])) }}"
                       class="inline-flex items-center px-3 py-1 bg-indigo-600 dark:bg-indigo-500 text-white text-xs rounded-full hover:bg-indigo-700 dark:hover:bg-indigo-600 transition">
                        Hasta: {{ request('fecha_hasta') }}
                        <span class="ml-1">×</span>
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>

    <!-- INFORMACIÓN DE RESULTADOS -->
    @if($concepts->total() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Mostrando <span class="font-semibold text-[#43883d]">{{ $concepts->firstItem() }}</span> 
                    a <span class="font-semibold text-[#43883d]">{{ $concepts->lastItem() }}</span> 
                    de <span class="font-semibold text-[#43883d]">{{ $concepts->total() }}</span> resultados
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Página <span class="font-semibold text-[#43883d]">{{ $concepts->currentPage() }}</span> 
                    de <span class="font-semibold text-[#43883d]">{{ $concepts->lastPage() }}</span>
                </div>
            </div>
        </div>
    @endif

    <!-- Lista de conceptos con diseño actualizado -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($concepts ?? [] as $concept)
            @php
                $extension = strtolower(pathinfo($concept->archivo, PATHINFO_EXTENSION));
                // Definir colores e íconos por tipo de archivo según manual de identidad
                $colorClass = 'text-gray-500';
                $bgClass = 'bg-gray-100';
                $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>';
                if ($extension === 'pdf') {
                    $colorClass = 'text-red-600';
                    $bgClass = 'bg-red-50';
                    $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                    </svg>';
                } elseif (in_array($extension, ['doc', 'docx'])) {
                    $colorClass = 'text-blue-600';
                    $bgClass = 'bg-blue-50';
                    $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                        <path d="M4.08 11.92 6 9.5 4.08 7.08l.92-.92L7.5 8.5l2.5-2.34.92.92L8.5 9.5l2.42 2.42-.92.92L7.5 10.5 5 12.84l-.92-.92z"/>
                    </svg>';
                } elseif (in_array($extension, ['xls', 'xlsx'])) {
                    $colorClass = 'text-[#3F8827]';
                    $bgClass = 'bg-[#D8E5B0]';
                    $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
                    </svg>';
                }
            @endphp

            <article class="bg-white dark:bg-gray-900 rounded-lg shadow-md hover:shadow-lg p-5 flex flex-col transition-all duration-300 border border-gray-100 dark:border-gray-700">
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 {{ $bgClass }} p-2 rounded-md {{ $colorClass }}">
                        {!! $iconSvg !!}
                    </div>
                    <div class="flex-grow">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2 py-0.5 bg-[#EAECB1] text-[#285F19] text-xs font-ubuntu font-medium rounded-full">
                                {{ $concept->tipo_documento ?? 'Documento' }}
                            </span>
                            <span class="px-2 py-0.5 bg-[#D8E5B0] text-[#285F19] text-xs font-ubuntu font-medium rounded-full">
                                {{ $concept->año }}
                            </span>
                        </div>
                        <h3 class="text-lg font-ubuntu font-semibold text-gray-900 dark:text-gray-100 hover:text-[#43883d] transition">
                            <a href="{{ route('concepts.show', $concept->id) }}" class="block">
                                {{ $concept->tipo_documento ?? 'Documento' }}: No {{ $concept->titulo }} del {{$concept->año}}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-1 line-clamp-2 font-ubuntu text-sm">{{ $concept->contenido }}</p>
                    </div>
                </div>
                
                <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400 font-ubuntu mb-4">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($concept->fecha)->translatedFormat('d \d\e F \d\e\l Y') }}
                    </span>
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $concept->created_at->diffForHumans() }}
                    </span>
                </div>
                
                <div class="mt-auto flex gap-2">
                    <a href="{{ route('concepts.show', $concept->id) }}" class="flex-1 py-2 rounded-md bg-[#43883d] text-white text-center hover:bg-[#3F8827] transition font-ubuntu text-sm">
                        Ver
                    </a>
                    @if(auth()->user()->is_admin || auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'edit'))
                    <a href="{{ route('concepts.edit', $concept->id) }}" class="flex-1 py-2 rounded-md bg-[#696862] text-[#ffffff] text-center hover:bg-[#8f8e87] transition font-ubuntu text-sm">
                        Editar
                    </a>
                    @endif
                    @if(auth()->user()->is_admin || auth()->user()->hasConceptPermissionFor($concept->concept_type_id, 'delete'))
                    <form action="{{ route('concepts.destroy', $concept->id) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Estás seguro que deseas eliminar este concepto? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2 rounded-md bg-red-600 text-white hover:bg-red-700 transition font-ubuntu text-sm">
                            Eliminar
                        </button>
                    </form>
                    @endif
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-16 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <div class="text-[#43883d] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400 font-ubuntu mb-6">
                    @if(request()->hasAny(['busqueda_general', 'concept_type_id', 'concept_theme_id', 'tipo_documento', 'año', 'fecha_desde', 'fecha_hasta']))
                        No se encontraron conceptos que coincidan con los filtros aplicados.
                        <br><a href="{{ route('concepts.index') }}" class="text-[#43883d] hover:text-[#3F8827] underline">Limpiar filtros</a>
                    @else
                        No hay conceptos para mostrar.
                    @endif
                </p>
                @if(!request()->hasAny(['busqueda_general', 'concept_type_id', 'concept_theme_id', 'tipo_documento', 'año', 'fecha_desde', 'fecha_hasta']))
                <a href="{{ route('concepts.create') }}" class="inline-block px-6 py-3 bg-[#43883d] text-white rounded-md shadow hover:bg-[#3F8827] transition font-ubuntu">
                    Crear el primer concepto
                </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- PAGINACIÓN MEJORADA -->
    @if($concepts->hasPages())
        <div class="mt-12 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-xl p-8 shadow-lg">


            <!-- Enlaces de paginación con estilo personalizado -->
            <div class="flex justify-center">
                <nav class="flex items-center gap-1" role="navigation" aria-label="Pagination Navigation">
                    {{-- Previous Page Link --}}
                    @if ($concepts->onFirstPage())
                        <span class="px-4 py-3 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $concepts->appends(request()->query())->previousPageUrl() }}" 
                           class="px-4 py-3 bg-white text-[#43883d] border border-gray-300 rounded-lg hover:bg-[#43883d] hover:text-white transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($concepts->appends(request()->query())->getUrlRange(1, $concepts->lastPage()) as $page => $url)
                        @if ($page == $concepts->currentPage())
                            <span class="px-4 py-3 bg-[#43883d] text-white border border-[#43883d] rounded-lg font-semibold shadow-md transform -translate-y-0.5">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" 
                               class="px-4 py-3 bg-white text-[#43883d] border border-gray-300 rounded-lg hover:bg-[#43883d] hover:text-white transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($concepts->hasMorePages())
                        <a href="{{ $concepts->appends(request()->query())->nextPageUrl() }}" 
                           class="px-4 py-3 bg-white text-[#43883d] border border-gray-300 rounded-lg hover:bg-[#43883d] hover:text-white transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <span class="px-4 py-3 text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle para filtros avanzados
    const toggleBtn = document.getElementById('toggle-advanced');
    const advancedFilters = document.getElementById('advanced-filters');
    const toggleText = document.getElementById('toggle-text');
    const toggleIcon = document.getElementById('toggle-icon');

    if (toggleBtn && advancedFilters) {
        toggleBtn.addEventListener('click', function() {
            const isHidden = advancedFilters.classList.contains('hidden');
            
            if (isHidden) {
                advancedFilters.classList.remove('hidden');
                toggleText.textContent = 'Ocultar filtros avanzados';
                toggleIcon.style.transform = 'rotate(180deg)';
            } else {
                advancedFilters.classList.add('hidden');
                toggleText.textContent = 'Mostrar filtros avanzados';
                toggleIcon.style.transform = 'rotate(0deg)';
            }
        });
    }

    // Manejo de temas por tipo de concepto
    const typeSelect = document.getElementById('concept_type_id');
    const themeSelect = document.getElementById('concept_theme_id');

    if (typeSelect && themeSelect) {
        async function loadThemes(typeId) {
            if (!typeId) {
                // Restaurar todas las opciones originales
                const allOptions = themeSelect.querySelectorAll('option');
                allOptions.forEach(option => {
                    option.style.display = 'block';
                });
                return;
            }

            try {
                const response = await fetch(`/api/concept-themes-by-type/${typeId}`);
                const themes = await response.json();
                
                // Ocultar todas las opciones excepto "Todos"
                const allOptions = themeSelect.querySelectorAll('option');
                allOptions.forEach(option => {
                    if (option.value === '') {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Mostrar solo los temas del tipo seleccionado
                themes.forEach(theme => {
                    const option = themeSelect.querySelector(`option[value="${theme.id}"]`);
                    if (option) {
                        option.style.display = 'block';
                    }
                });

                // Si el tema actual no pertenece al tipo seleccionado, resetear
                const currentTheme = themeSelect.value;
                if (currentTheme) {
                    const currentOption = themeSelect.querySelector(`option[value="${currentTheme}"]`);
                    if (currentOption && currentOption.style.display === 'none') {
                        themeSelect.value = '';
                    }
                }
            } catch (error) {
                console.error('Error loading themes:', error);
            }
        }

        typeSelect.addEventListener('change', function() {
            loadThemes(this.value);
        });

        // Cargar temas al inicializar si hay un tipo seleccionado
        if (typeSelect.value) {
            loadThemes(typeSelect.value);
        }
    }
});
</script>

@endsection