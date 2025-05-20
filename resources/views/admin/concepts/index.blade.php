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
                                {{ $concept->tipo_documento ?? 'Documento' }}: <Noscript></Noscript> {{ $concept->titulo }} del {{$concept->año}}
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
                <p class="text-gray-500 dark:text-gray-400 font-ubuntu mb-6">No hay conceptos para mostrar.</p>
                <a href="{{ route('concepts.create') }}" class="inline-block px-6 py-3 bg-[#43883d] text-white rounded-md shadow hover:bg-[#3F8827] transition font-ubuntu">
                    Crear el primer concepto
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection