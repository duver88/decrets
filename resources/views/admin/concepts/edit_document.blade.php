@extends('layouts.app')

@section('title', 'Editar Concepto')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Cabecera con identidad institucional -->
    <div class="bg-[#43883d] dark:bg-[#3F8827] rounded-t-lg p-4 flex justify-center">
        <div class="flex items-center justify-center">
            <div class="w-16 h-16 flex items-center justify-center">
                <img src="{{ asset('images/escudo_blanco.png') }}" alt="Escudo Alcaldía de Bucaramanga" class="w-12 h-12">
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-b-lg shadow-lg p-6 border border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-ubuntu font-semibold text-gray-800 dark:text-gray-100 mb-6 text-center">Editar Concepto</h2>

        @if(session('success'))
            <div class="bg-[#B5CBA1] dark:bg-[#3F8827]/30 border-l-4 border-[#43883d] text-[#285F19] dark:text-[#B5CBA1] p-4 mb-6 font-ubuntu flex items-center rounded-r-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 dark:bg-red-900/30 border-l-4 border-[#DD0A24] text-[#DD0A24] dark:text-red-400 p-4 mb-6 font-ubuntu flex items-center rounded-r-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Paso 1: Seleccionar tipo de concepto -->
        <div class="bg-[#EAECB1]/20 dark:bg-[#43883d]/10 border border-[#B5CBA1] dark:border-[#3F8827] rounded-lg p-5 mb-6">
            <h3 class="font-ubuntu font-medium text-gray-700 dark:text-gray-200 mb-4">Seleccionar Tipo de Concepto</h3>
            <form action="{{ route('concepts.edit', $concept->id) }}" method="GET">
                <div class="mb-2">
                    <label for="concept_type_id" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo de Concepto</label>
                    <select name="concept_type_id" id="concept_type_id" 
                        class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3
                        focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]
                        dark:bg-gray-700 dark:text-white font-ubuntu" 
                        onchange="this.form.submit()" required>
                        <option value="">-- Selecciona un tipo de concepto --</option>
                        @foreach($conceptTypes as $type)
                            <option value="{{ $type->id }}" {{ ($selectedTypeId ?? old('concept_type_id', $concept->concept_type_id)) == $type->id ? 'selected' : '' }}>
                                {{ $type->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Paso 2: Formulario completo solo si hay tipo seleccionado -->
        @if($selectedTypeId ?? old('concept_type_id', $concept->concept_type_id))
            <form action="{{ route('concepts.update', $concept->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <input type="hidden" name="concept_type_id" value="{{ $selectedTypeId ?? old('concept_type_id', $concept->concept_type_id) }}">
                <!-- Campo oculto para tipo de documento fijo como "Concepto" -->
                <input type="hidden" name="tipo_documento" value="Concepto">

                <!-- Tema -->
                <div>
                    <label for="concept_theme_id" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Tema</label>
                    <select name="concept_theme_id" id="concept_theme_id" data-selected-theme="{{ old('concept_theme_id', $concept->concept_theme_id) }}" 
                        class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3
                        focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]
                        dark:bg-gray-700 dark:text-white font-ubuntu" required>
                        <option value="">-- Selecciona un tema --</option>
                        @if(isset($themesForTypes[$selectedTypeId ?? old('concept_type_id', $concept->concept_type_id)]))
                            @foreach($themesForTypes[$selectedTypeId ?? old('concept_type_id', $concept->concept_type_id)] as $theme)
                                <option value="{{ $theme->id }}" {{ old('concept_theme_id', $concept->concept_theme_id) == $theme->id ? 'selected' : '' }}>
                                    {{ $theme->nombre }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('concept_theme_id')
                        <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Año -->
                    <div>
                        <label for="año" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Año</label>
                        <select name="año" id="año" 
                            class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3
                            focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]
                            dark:bg-gray-700 dark:text-white font-ubuntu" required>
                            <option value="">Selecciona el año</option>
                            @foreach(range(2022, 2027) as $year)
                                <option value="{{ $year }}" {{ old('año', $concept->año) == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        @error('año')
                            <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Número Documento -->
                    <div>
                        <label for="titulo" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Número Documento</label>
                        <input type="text" name="titulo" id="titulo" 
                            class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3
                            focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]
                            dark:bg-gray-700 dark:text-white font-ubuntu" 
                            value="{{ old('titulo', $concept->titulo) }}" required>
                        @error('titulo')
                            <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha Del Documento -->
                    <div>
                        <label for="fecha" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Fecha Del Documento</label>
                        <input type="date" name="fecha" id="fecha" 
                            class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3
                            focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]
                            dark:bg-gray-700 dark:text-white font-ubuntu" 
                            value="{{ old('fecha', $concept->fecha->format('Y-m-d')) }}" required>
                        @error('fecha')
                            <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Archivo Actual -->
                <div class="border border-[#B5CBA1] dark:border-[#3F8827] rounded-lg p-4 bg-[#EAECB1]/20 dark:bg-[#43883d]/10">
                    <div class="mb-4">
                        <label class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Archivo Actual</label>
                        <div class="flex items-center">
                            <a href="{{ asset('storage/' . $concept->archivo) }}" target="_blank" 
                                class="text-[#43883d] hover:text-[#3F8827] dark:text-[#93C01F] dark:hover:text-[#81AD32] flex items-center font-ubuntu transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Ver archivo actual
                            </a>
                        </div>
                    </div>

                    <!-- Nuevo Archivo (opcional) -->
                    <div>
                        <label for="archivo" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Nuevo Archivo (opcional)</label>
                        <div class="flex items-center">
                            <div class="bg-[#43883d] text-white rounded-lg px-4 py-2 cursor-pointer hover:bg-[#3F8827] transition mr-3">
                                <label for="archivo" class="cursor-pointer font-ubuntu">Seleccionar nuevo archivo</label>
                            </div>
                            <input type="file" name="archivo" id="archivo" class="hidden" onchange="updateFileName(this)">
                            <span id="file-name" class="text-sm text-gray-600 dark:text-gray-400 font-ubuntu">Ningún archivo seleccionado</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-ubuntu flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX (máx. 2MB)
                        </p>
                        @error('archivo')
                            <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Dependencia -->
                <div>
                    <label for="dependencia" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Dependencia</label>
                    <select name="dependencia" id="dependencia" 
                        class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3
                        focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]
                        dark:bg-gray-700 dark:text-white font-ubuntu">
                        <option value="">-- Selecciona una dependencia --</option>
                        @foreach($dependencias as $dependencia)
                            <option value="{{ $dependencia }}" 
                                {{ old('dependencia', $concept->dependencia ?? '') == $dependencia ? 'selected' : '' }}>
                                {{ $dependencia }}
                            </option>
                        @endforeach
                    </select>
                    @error('dependencia')
                        <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="contenido" class="block font-ubuntu font-medium text-gray-700 dark:text-gray-300 mb-2">Descripción</label>
                    <textarea name="contenido" id="contenido" rows="5" 
                        class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm p-3
                        focus:ring-[#43883d] focus:border-[#43883d] dark:focus:ring-[#51AD32] dark:focus:border-[#51AD32]
                        dark:bg-gray-700 dark:text-white font-ubuntu resize-none">{{ old('contenido', $concept->contenido) }}</textarea>
                    @error('contenido')
                        <p class="text-[#DD0A24] dark:text-red-400 text-sm mt-1 font-ubuntu">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end mt-8 space-x-4">
                    <a href="{{ route('concepts.index') }}" 
                        class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 
                        text-gray-800 dark:text-gray-200 py-3 px-6 rounded-lg transition-colors font-ubuntu flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Cancelar
                    </a>
                    <button type="submit" 
                        class="bg-[#43883d] hover:bg-[#3F8827] dark:bg-[#51AD32] dark:hover:bg-[#3F8827] 
                        text-white py-3 px-6 rounded-lg transition-colors font-ubuntu flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        @else
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-600 dark:text-gray-400 font-ubuntu">Por favor, selecciona un tipo de concepto para continuar.</p>
            </div>
        @endif
    </div>
    
    <!-- Pie de página con información institucional -->
    <div class="mt-6 text-center">
        <p class="text-xs text-gray-500 dark:text-gray-400 font-ubuntu">Alcaldía de Bucaramanga © 2025</p>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap');
    
    .font-ubuntu {
        font-family: 'Ubuntu', sans-serif;
    }
</style>

<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : 'Ningún archivo seleccionado';
        document.getElementById('file-name').textContent = fileName;
    }
</script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('concept_type_id');
    const themeSelect = document.getElementById('concept_theme_id');

    const baseUrl = "{{ url('concepts/themes') }}";
    const initialThemeId = themeSelect.dataset.selectedTheme || null;

    function loadThemes(typeId, selectedThemeId = null) {
        if (!typeId) {
            themeSelect.innerHTML = '<option value="">-- Selecciona un tipo primero --</option>';
            return;
        }

        fetch(`${baseUrl}/${typeId}`)
            .then(response => response.json())
            .then(data => {
                themeSelect.innerHTML = '<option value="">-- Selecciona un tema --</option>';

                data.forEach(theme => {
                    const option = document.createElement('option');
                    option.value = theme.id;
                    option.textContent = theme.nombre;

                    if (selectedThemeId && theme.id == selectedThemeId) {
                        option.selected = true;
                    }
                    themeSelect.appendChild(option);
                });

                if (!themeSelect.querySelector('option[selected]') && data.length > 0) {
                    themeSelect.querySelector('option:nth-child(2)').selected = true;
                }
            })
            .catch(error => {
                console.error('Error cargando temas:', error);
            });
    }

    typeSelect.addEventListener('change', function() {
        loadThemes(this.value);
    });

    if (typeSelect.value) {
        loadThemes(typeSelect.value, initialThemeId);
    }
});
</script>
@endpush
@endsection