@extends('layouts.app')

@section('title', 'Asignar Permisos para Conceptos')

@section('content')
<div class="bg-[#1e2533] text-white min-h-screen">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold">Asignar Permisos</h1>
    </div>
    
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-[#1e2533] text-white p-6 rounded-t-lg border-b border-gray-700">
            <h2 class="text-xl font-semibold">Asignar Permisos para Conceptos</h2>
        </div>
        
        <div class="bg-[#293245] text-white p-6 rounded-b-lg">
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('concepts.updatePermissions') }}" method="POST">
                @csrf
                
                <!-- Selector de Usuario -->
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Usuario</label>
                    <select id="user_selector" name="user_id" class="w-full bg-[#1e2533] border border-gray-600 rounded-md px-4 py-2 text-white">
                        <option value="">-- Seleccionar Usuario --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Sección de Permisos -->
                <div id="permissions_section" class="mb-6 hidden">
                    <label class="block text-sm font-medium mb-2">Permisos</label>
                    <div class="flex flex-wrap gap-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="permission_create" name="permissions[create]" class="form-checkbox h-5 w-5 text-blue-500 bg-[#1e2533] border-gray-500 rounded">
                            <span class="ml-2">Crear</span>
                        </label>
                        
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="permission_edit" name="permissions[edit]" class="form-checkbox h-5 w-5 text-blue-500 bg-[#1e2533] border-gray-500 rounded">
                            <span class="ml-2">Editar</span>
                        </label>
                        
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="permission_delete" name="permissions[delete]" class="form-checkbox h-5 w-5 text-blue-500 bg-[#1e2533] border-gray-500 rounded">
                            <span class="ml-2">Eliminar</span>
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" id="submit_button" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors hidden">
                        Guardar Permisos
                    </button>
                </div>
            </form>
            
            <!-- Lista de Usuarios con Permisos (Cards) -->
            <div class="mt-10">
                <h3 class="text-lg font-medium mb-4">Usuarios con Permisos Asignados</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($usersWithPermissions as $user)
                        <div class="bg-[#1e2533] border border-gray-700 rounded-lg overflow-hidden shadow-lg">
                            <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
                                <div>
                                    <h4 class="font-semibold text-lg">{{ $user->name }}</h4>
                                    <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                                </div>
                                <button type="button" 
                                        class="edit-user-permissions bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md text-sm transition-colors"
                                        data-user-id="{{ $user->id }}"
                                        data-user-name="{{ $user->name }}">
                                    Editar
                                </button>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @if($user->hasGlobalConceptPermission('create'))
                                        <span class="bg-green-500/20 text-green-300 px-2 py-1 rounded-full text-xs font-medium">Crear</span>
                                    @endif
                                    
                                    @if($user->hasGlobalConceptPermission('edit'))
                                        <span class="bg-blue-500/20 text-blue-300 px-2 py-1 rounded-full text-xs font-medium">Editar</span>
                                    @endif
                                    
                                    @if($user->hasGlobalConceptPermission('delete'))
                                        <span class="bg-red-500/20 text-red-300 px-2 py-1 rounded-full text-xs font-medium">Eliminar</span>
                                    @endif
                                    
                                    @if(!$user->hasGlobalConceptPermission('create') && !$user->hasGlobalConceptPermission('edit') && !$user->hasGlobalConceptPermission('delete'))
                                        <span class="bg-gray-500/20 text-gray-300 px-2 py-1 rounded-full text-xs font-medium">Sin permisos</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    @if($usersWithPermissions->isEmpty())
                        <div class="col-span-full bg-[#1e2533] border border-gray-700 rounded-lg p-6 text-center">
                            <p class="text-gray-400">No hay usuarios con permisos asignados</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userSelector = document.getElementById('user_selector');
    const permissionsSection = document.getElementById('permissions_section');
    const submitButton = document.getElementById('submit_button');
    const permissionCreate = document.getElementById('permission_create');
    const permissionEdit = document.getElementById('permission_edit');
    const permissionDelete = document.getElementById('permission_delete');
    
    // Función para cargar los permisos de un usuario
    function loadUserPermissions(userId) {
        permissionsSection.classList.remove('hidden');
        submitButton.classList.remove('hidden');
        
        // Cambiar el valor del selector para que coincida con el usuario seleccionado
        userSelector.value = userId;
        
        // Cargar los permisos del usuario seleccionado mediante Ajax
        fetch(`/concepts/get-user-permissions/${userId}`)
            .then(response => response.json())
            .then(data => {
                // Marcar los checkboxes según los permisos del usuario
                permissionCreate.checked = data.can_create || false;
                permissionEdit.checked = data.can_edit || false;
                permissionDelete.checked = data.can_delete || false;
            })
            .catch(error => {
                console.error('Error:', error);
            });
            
        // Hacer scroll al formulario
        document.querySelector('form').scrollIntoView({ behavior: 'smooth' });
    }
    
    // Mostrar/ocultar secciones según la selección de usuario
    userSelector.addEventListener('change', function() {
        if (this.value) {
            loadUserPermissions(this.value);
        } else {
            permissionsSection.classList.add('hidden');
            submitButton.classList.add('hidden');
        }
    });
    
    // Manejo del botón editar en las cards
    document.querySelectorAll('.edit-user-permissions').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            
            loadUserPermissions(userId);
        });
    });
});
</script>
@endsection