<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('profesores.index') }}" class="text-slate-500 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Nuevo Profesor') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-xl border border-slate-200">
                <div class="p-8 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('profesores.store') }}" class="space-y-8">
                        @csrf

                        {{-- SECCIÓN 1: CUENTA DE SISTEMA --}}
                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Cuenta de Sistema
                            </h3>
                            <p class="text-sm text-slate-500 mb-6 font-medium">Esta información se utilizará para que el profesor acceda al sistema. La contraseña inicial será su número de empleado.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="email">Correo Electrónico <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="email" class="block mt-1 w-full bg-white" type="email" name="email" :value="old('email')" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="numero_empleado">Número de Empleado (Usuario/Contraseña) <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="numero_empleado" class="block mt-1 w-full bg-white font-mono text-indigo-700" type="text" name="numero_empleado" :value="old('numero_empleado')" required />
                                    <x-input-error :messages="$errors->get('numero_empleado')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- SECCIÓN 2: DATOS PERSONALES --}}
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-2 mb-6">Información Personal</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="nombre">Nombre(s) <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
                                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="apellidos">Apellidos <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos" :value="old('apellidos')" required />
                                    <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="tipo_identificacion" :value="__('Tipo de Identificación')" />
                                    <select id="tipo_identificacion" name="tipo_identificacion" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-slate-700">
                                        <option value="">Seleccionar...</option>
                                        <option value="DNI" {{ old('tipo_identificacion') == 'DNI' ? 'selected' : '' }}>DNI</option>
                                        <option value="Pasaporte" {{ old('tipo_identificacion') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                        <option value="Cédula" {{ old('tipo_identificacion') == 'Cédula' ? 'selected' : '' }}>Cédula</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('tipo_identificacion')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="num_identificacion" :value="__('Número de Identificación')" />
                                    <x-text-input id="num_identificacion" class="block mt-1 w-full" type="text" name="num_identificacion" :value="old('num_identificacion')" />
                                    <x-input-error :messages="$errors->get('num_identificacion')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- SECCIÓN 3: PERFIL PROFESIONAL --}}
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-2 mb-6">Perfil Profesional</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div>
                                    <x-input-label for="especialidad" :value="__('Especialidad (Ej: Inglés Nativo, Gramática)')" />
                                    <x-text-input id="especialidad" class="block mt-1 w-full" type="text" name="especialidad" :value="old('especialidad')" />
                                    <x-input-error :messages="$errors->get('especialidad')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="telefono" :value="__('Teléfono de Contacto')" />
                                    <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" />
                                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="fecha_contratacion" :value="__('Fecha de Contratación')" />
                                    <x-text-input id="fecha_contratacion" class="block mt-1 w-full text-slate-600" type="date" name="fecha_contratacion" :value="old('fecha_contratacion')" />
                                    <x-input-error :messages="$errors->get('fecha_contratacion')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="url_foto" :value="__('URL de Foto (Avatar)')" />
                                    <x-text-input id="url_foto" class="block mt-1 w-full" type="url" name="url_foto" :value="old('url_foto')" placeholder="https://..." />
                                    <x-input-error :messages="$errors->get('url_foto')" class="mt-2" />
                                    <p class="text-xs text-slate-400 mt-1">Enlace a una imagen pública para el perfil del profesor.</p>
                                </div>
                                
                                <div class="col-span-1 md:col-span-2 pt-4">
                                    <label for="activo" class="inline-flex items-center p-4 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50 transition w-full md:w-auto">
                                        <input id="activo" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-5 w-5" name="activo" value="1" {{ old('activo', true) ? 'checked' : '' }}>
                                        <div class="ml-3">
                                            <span class="block text-sm font-medium text-gray-700">Profesor Activo</span>
                                            <span class="block text-xs text-slate-500">¿Puede impartir clases e iniciar sesión?</span>
                                        </div>
                                    </label>
                                    <x-input-error :messages="$errors->get('activo')" class="mt-2" />
                                </div>

                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-6 border-t border-slate-200 gap-4 mt-8">
                            <a href="{{ route('profesores.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                Guardar Profesor
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
