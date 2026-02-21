<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('profesores.index') }}" class="text-slate-500 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Modificar Profesor') }}: {{ $profesore->nombre }} {{ $profesore->apellidos }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-xl border border-slate-200">
                <div class="p-8 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('profesores.update', $profesore) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        {{-- SECCIÓN 1: CUENTA DE SISTEMA --}}
                        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
                            <h3 class="text-lg font-bold text-indigo-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Cuenta de Sistema
                            </h3>
                            <p class="text-sm text-indigo-700 mb-6 font-medium">Actualizar estos datos cambiará las credenciales de acceso del profesor.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="email" class="text-indigo-900">Correo Electrónico (Acceso) <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="email" class="block mt-1 w-full bg-white border-indigo-200 focus:ring-indigo-500" type="email" name="email" :value="old('email', $profesore->user?->email)" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="numero_empleado" class="text-indigo-900">Número de Empleado <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="numero_empleado" class="block mt-1 w-full bg-white font-mono text-indigo-700 border-indigo-200 focus:ring-indigo-500" type="text" name="numero_empleado" :value="old('numero_empleado', $profesore->numero_empleado)" required />
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
                                    <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $profesore->nombre)" required autofocus />
                                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="apellidos">Apellidos <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos" :value="old('apellidos', $profesore->apellidos)" required />
                                    <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="tipo_identificacion" :value="__('Tipo de Identificación')" />
                                    <select id="tipo_identificacion" name="tipo_identificacion" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-slate-700">
                                        <option value="">Seleccionar...</option>
                                        <option value="DNI" {{ old('tipo_identificacion', $profesore->tipo_identificacion) == 'DNI' ? 'selected' : '' }}>DNI</option>
                                        <option value="Pasaporte" {{ old('tipo_identificacion', $profesore->tipo_identificacion) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                        <option value="Cédula" {{ old('tipo_identificacion', $profesore->tipo_identificacion) == 'Cédula' ? 'selected' : '' }}>Cédula</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('tipo_identificacion')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="num_identificacion" :value="__('Número de Identificación')" />
                                    <x-text-input id="num_identificacion" class="block mt-1 w-full" type="text" name="num_identificacion" :value="old('num_identificacion', $profesore->num_identificacion)" />
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
                                    <x-text-input id="especialidad" class="block mt-1 w-full" type="text" name="especialidad" :value="old('especialidad', $profesore->especialidad)" />
                                    <x-input-error :messages="$errors->get('especialidad')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="telefono" :value="__('Teléfono de Contacto')" />
                                    <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono', $profesore->telefono)" />
                                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="fecha_contratacion" :value="__('Fecha de Contratación')" />
                                    <x-text-input id="fecha_contratacion" class="block mt-1 w-full text-slate-600" type="date" name="fecha_contratacion" :value="old('fecha_contratacion', $profesore->fecha_contratacion?->format('Y-m-d') ?? $profesore->fecha_contratacion)" />
                                    <x-input-error :messages="$errors->get('fecha_contratacion')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="url_foto" :value="__('URL de Foto (Avatar)')" />
                                    <x-text-input id="url_foto" class="block mt-1 w-full" type="url" name="url_foto" :value="old('url_foto', $profesore->url_foto)" placeholder="https://..." />
                                    <x-input-error :messages="$errors->get('url_foto')" class="mt-2" />
                                    <p class="text-xs text-slate-400 mt-1">Enlace a una imagen pública para el perfil del profesor.</p>
                                </div>
                                
                                <div class="col-span-1 md:col-span-2 pt-4 flex items-center justify-between">
                                    <label for="activo" class="inline-flex items-center p-4 border {{ $profesore->activo ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }} rounded-lg cursor-pointer hover:shadow-sm transition w-full md:w-auto">
                                        <input id="activo" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-5 w-5" name="activo" value="1" {{ old('activo', $profesore->activo) ? 'checked' : '' }}>
                                        <div class="ml-3">
                                            <span class="block text-sm font-bold {{ $profesore->activo ? 'text-green-800' : 'text-red-800' }}">Estado: {{ $profesore->activo ? 'Activo' : 'Inactivo' }}</span>
                                            <span class="block text-xs {{ $profesore->activo ? 'text-green-600' : 'text-red-600' }}">Quitar marca deshabilitará el acceso al sistema.</span>
                                        </div>
                                    </label>
                                    <x-input-error :messages="$errors->get('activo')" class="mt-2" />

                                    @if($profesore->url_foto)
                                        <div class="hidden md:block">
                                            <img src="{{ $profesore->url_foto }}" alt="Foto actual" class="h-20 w-20 rounded-full object-cover border-4 border-white shadow">
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-slate-200 mt-8">
                            <div>
                                <p class="text-sm text-slate-500">Última actualización: {{ $profesore->updated_at?->diffForHumans() }}</p>
                            </div>
                            <div class="flex gap-4">
                                <a href="{{ route('profesores.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Cancelar
                                </a>
                                <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                    Actualizar Profesor
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
