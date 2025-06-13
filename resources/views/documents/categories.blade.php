@extends('layouts.app')  
  
@section('title', 'Gestión de Tipos y Temas de Documentos')  
  
@section('content')  
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">  
    <!-- Cabecera -->  
    <div class="bg-[#43883d] px-6 py-4 rounded-t-lg">  
        <h2 class="text-2xl font-ubuntu font-bold text-white">Gestión de Tipos y Temas de Documentos</h2>  
    </div>  
  
    <!-- Mensajes flash -->  
    @if(session('success'))  
        <div class="mb-6 rounded-md border-l-4 border-[#3F8827] bg-[#D8E5B0] p-4 text-[#285F19]">  
            {{ session('success') }}  
        </div>  
    @endif  
    @if(session('error'))  
        <div class="mb-6 rounded-md border-l-4 border-red-500 bg-red-50 p-4 text-red-700">  
            {{ session('error') }}  
        </div>  
    @endif  
  
    <div class="bg-white rounded-b-lg shadow-lg p-6 border border-gray-200">  
        <!-- Formulario para crear tipo de documento -->  
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6 border border-gray-200 dark:border-gray-700">  
            <div class="flex items-center mb-4">  
                <div class="bg-[#43883d] dark:bg-[#3F8827] p-2 rounded-full mr-3">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>  
                    </svg>  
                </div>  
                <h2 class="text-xl font-ubuntu font-semibold text-gray-800 dark:text-gray-100">Crear Tipo de Documento</h2>  
            </div>  
  
            <form action="{{ route('documents.storeType') }}" method="POST" class="space-y-4">  
                @csrf  
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">  
                    <div>  
                        <label for="type_nombre" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Nombre del Tipo</label>  
                        <input type="text" name="nombre" id="type_nombre" value="{{ old('nombre') }}" required  
                               class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-2.5   
                               focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]  
                               dark:bg-gray-700 dark:text-white font-ubuntu">  
                        @error('nombre')  
                            <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>  
                        @enderror  
                    </div>  
                    <div>  
                        <label for="type_descripcion" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Descripción</label>  
                        <input type="text" name="descripcion" id="type_descripcion" value="{{ old('descripcion') }}"  
                               class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-2.5   
                               focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]  
                               dark:bg-gray-700 dark:text-white font-ubuntu">  
                        @error('descripcion')  
                            <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>  
                        @enderror  
                    </div>  
                </div>  
                <button type="submit" class="w-full bg-[#43883d] hover:bg-[#3F8827] dark:bg-[#3F8827] dark:hover:bg-[#43883d] text-white font-ubuntu font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />  
                    </svg>  
                    Guardar Tipo  
                </button>  
            </form>  
        </div>  
  
        <!-- Formulario para crear tema de documento -->  
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6 border border-gray-200 dark:border-gray-700">  
            <div class="flex items-center mb-4">  
                <div class="bg-[#93C01F] dark:bg-[#81AD32] p-2 rounded-full mr-3">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>  
                    </svg>  
                </div>  
                <h2 class="text-xl font-ubuntu font-semibold text-gray-800 dark:text-gray-100">Crear Tema de Documento</h2>  
            </div>  
  
            <form action="{{ route('documents.storeTheme') }}" method="POST" class="space-y-4">  
                @csrf  
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">  
                    <div>  
                        <label for="theme_document_type_id" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo de Documento</label>  
                        <select name="document_type_id" id="theme_document_type_id" required  
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-2.5   
                                focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]  
                                dark:bg-gray-700 dark:text-white font-ubuntu">  
                            <option value="">Selecciona un tipo</option>  
                            @foreach($documentTypes as $type)  
                                <option value="{{ $type->id }}" {{ old('document_type_id') == $type->id ? 'selected' : '' }}>  
                                    {{ $type->nombre }}  
                                </option>  
                            @endforeach  
                        </select>  
                        @error('document_type_id')  
                            <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>  
                        @enderror  
                    </div>  
                    <div>  
                        <label for="theme_nombre" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Nombre del Tema</label>  
                        <input type="text" name="nombre" id="theme_nombre" value="{{ old('nombre') }}" required  
                               class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-2.5   
                               focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]  
                               dark:bg-gray-700 dark:text-white font-ubuntu">  
                        @error('nombre')  
                            <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>  
                        @enderror  
                    </div>  
                </div>  
                <button type="submit" class="w-full bg-[#93C01F] hover:bg-[#81AD32] dark:bg-[#81AD32] dark:hover:bg-[#93C01F] text-white font-ubuntu font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />  
                    </svg>  
                    Guardar Tema  
                </button>  
            </form>  
        </div>  
  
        <!-- Lista de tipos y temas existentes -->  
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-200 dark:border-gray-700">  
            <div class="flex items-center mb-4">  
                <div class="bg-[#51AD32] dark:bg-[#3F8827] p-2 rounded-full mr-3">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />  
                    </svg>  
                </div>  
                <h2 class="text-xl font-ubuntu font-semibold text-gray-800 dark:text-gray-100">Tipos y Temas Existentes</h2>  
            </div>  
  
            <div class="space-y-4 overflow-y-auto max-h-[420px] pr-2 scrollbar-thin scrollbar-thumb-[#43883d] scrollbar-track-gray-200 dark:scrollbar-thumb-[#51AD32] dark:scrollbar-track-gray-700">  
                @forelse($documentTypes as $type)  
                    <div class="border border-[#D8E5B0] dark:border-[#3F8827] rounded-lg p-4 bg-[#EAECB1]/10 dark:bg-[#43883d]/10 hover:bg-[#EAECB1]/20 dark:hover:bg-[#43883d]/20 transition duration-150">  
                        <div class="flex justify-between items-center">  
                            <h3 class="text-lg font-ubuntu font-semibold text-gray-800 dark:text-gray-100">{{ $type->nombre }}</h3>  
  
                            <form action="{{ route('documents.destroyType', $type->id) }}" method="POST" class="inline-block">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="text-[#DD0A24] hover:text-[#C20E1A] dark:text-red-400 dark:hover:text-red-300 transition-colors" onclick="return confirm('¿Estás seguro? Esto eliminará todos los temas asociados.')">  
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />  
                                    </svg>  
                                </button>  
                            </form>  
                        </div>  
  
                        @if($type->descripcion)  
                            <p class="text-sm font-ubuntu text-gray-600 dark:text-gray-400 mb-3 mt-1">{{ $type->descripcion }}</p>  
                        @endif  
  
                        @if($type->themes->count() > 0)  
                            <div class="mt-3">  
                                <h4 class="text-sm font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Temas:</h4>  
                                <div class="flex flex-wrap gap-2">  
                                    @foreach($type->themes as $theme)  
                                        <div class="flex items-center bg-white dark:bg-gray-700 rounded-md px-3 py-2 border border-gray-100 dark:border-gray-600">  
                                            <span class="text-sm font-ubuntu text-gray-700 dark:text-gray-300 flex-grow">{{ $theme->nombre }}</span>  
  
                                            <form action="{{ route('documents.destroyTheme', $theme->id) }}" method="POST" class="inline-block ml-2">  
                                                @csrf  
                                                @method('DELETE')  
                                                <button type="submit" class="text-[#DD0A24] hover:text-[#C20E1A] dark:text-red-400 dark:hover:text-red-300 transition-colors" onclick="return confirm('¿Estás seguro de eliminar este tema?')">  
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />  
                                                    </svg>  
                                                </button>  
                                            </form>  
                                        </div>  
                                    @endforeach  
                                </div>  
                            </div>  
                        @else  
                            <div class="mt-3 text-center py-3 bg-gray-50 dark:bg-gray-700 rounded-md">  
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-gray-400 dark:text-gray-500 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />  
                                </svg>  
                                <p class="text-sm font-ubuntu text-gray-500 dark:text-gray-400">No hay temas definidos</p>  
                            </div>  
                        @endif  
                    </div>  
                @empty  
                    <div class="text-center py-8">  
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />  
                        </svg>  
                        <p class="text-gray-500 dark:text-gray-400 font-ubuntu">No hay tipos de documento creados aún.</p>  
                        <p class="text-sm text-gray-400 dark:text-gray-500 font-ubuntu mt-1">Crea el primer tipo usando el formulario de arriba.</p>  
                    </div>  
                @endforelse  
            </div>  
        </div>  
    </div>  
</div>  
@endsection
