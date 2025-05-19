@extends('layouts.app')

@section('title', 'Editar Concepto')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Editar Concepto</h2>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Paso 1: Seleccionar tipo de concepto -->
    <form action="{{ route('concepts.edit', $concept->id) }}" method="GET" class="mb-6">
        <div class="mb-4">
            <label for="concept_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Concepto</label>
            <select name="concept_type_id" id="concept_type_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()" required>
                <option value="">-- Selecciona un tipo de concepto --</option>
                @foreach($conceptTypes as $type)
                    <option value="{{ $type->id }}" {{ ($selectedTypeId ?? old('concept_type_id', $concept->concept_type_id)) == $type->id ? 'selected' : '' }}>
                        {{ $type->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Paso 2: Formulario completo solo si hay tipo seleccionado -->
    @if($selectedTypeId ?? old('concept_type_id', $concept->concept_type_id))
        <form action="{{ route('concepts.update', $concept->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="concept_type_id" value="{{ $selectedTypeId ?? old('concept_type_id', $concept->concept_type_id) }}">

            <!-- Tema -->
            <div class="mb-4">
                <label for="concept_theme_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tema</label>
                <select name="concept_theme_id" id="concept_theme_id" data-selected-theme="{{ old('concept_theme_id', $concept->concept_theme_id) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
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
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Año -->
            <div class="mb-4">
                <label for="año" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Año</label>
                <select name="año" id="año" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Selecciona el año</option>
                    @foreach(range(2022, 2027) as $year)
                        <option value="{{ $year }}" {{ old('año', $concept->año) == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                @error('año')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Número Documento -->
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Número Documento</label>
                <input type="text" name="titulo" id="titulo" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('titulo', $concept->titulo) }}" required>
                @error('titulo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha Del Documento -->
            <div class="mb-4">
                <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Del Documento</label>
                <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('fecha', $concept->fecha->format('Y-m-d')) }}" required>
                @error('fecha')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Archivo Actual -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Archivo Actual</label>
                <div class="flex items-center">
                    <a href="{{ asset('storage/' . $concept->archivo) }}" target="_blank" class="text-blue-500 hover:text-blue-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Ver archivo actual
                    </a>
                </div>
            </div>

            <!-- Nuevo Archivo (opcional) -->
            <div class="mb-4">
                <label for="archivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nuevo Archivo (opcional)</label>
                <input type="file" name="archivo" id="archivo" class="w-full border border-gray-300 rounded-md px-3 py-2">
                <p class="text-sm text-gray-500 mt-1">Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX (máx. 2MB)</p>
                @error('archivo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="contenido" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                <textarea name="contenido" id="contenido" rows="5" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('contenido', $concept->contenido) }}</textarea>
                @error('contenido')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('concepts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md transition-colors mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors">
                    Guardar Cambios
                </button>
            </div>
        </form>
    @else
        <div class="text-gray-600 dark:text-gray-400 italic">
            Por favor, selecciona un tipo de concepto para continuar.
        </div>
    @endif
</div>

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
