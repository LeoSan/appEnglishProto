<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('profesores.index') }}" class="text-slate-500 hover:text-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('Ficha del Profesor') }}
                </h2>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('profesores.edit', $profesore) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Modificar
                </a>
                <form action="{{ route('profesores.destroy', $profesore) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar a este profesor? Se borrará su cuenta asociada.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200">
                
                {{-- Header del Perfil --}}
                <div class="relative bg-indigo-600 h-32 rounded-t-2xl">
                    <div class="absolute -bottom-12 left-8">
                        @if($profesore->url_foto)
                            <img src="{{ $profesore->url_foto }}" alt="{{ $profesore->nombre }}" class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-md bg-white">
                        @else
                            <div class="w-24 h-24 rounded-full border-4 border-white shadow-md bg-indigo-100 flex items-center justify-center text-4xl text-indigo-700 font-bold">
                                {{ substr($profesore->nombre, 0, 1) }}{{ substr($profesore->apellidos, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-8 pt-16">
                    <div class="flex justify-between items-start mb-8 border-b border-slate-100 pb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-slate-900">{{ $profesore->nombre }} {{ $profesore->apellidos }}</h1>
                            <p class="text-indigo-600 font-medium text-lg">{{ $profesore->especialidad ?? 'Profesor General' }}</p>
                            <p class="text-slate-500 mt-1 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                Empleado #{{ $profesore->numero_empleado }}
                            </p>
                        </div>
                        <div>
                            @if($profesore->activo)
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2 mt-1.5"></span>
                                    Cuenta Activa
                                </span>
                            @else
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-bold rounded-full bg-red-100 text-red-800 border border-red-200 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-red-500 mr-2 mt-1.5"></span>
                                    Inactivo / Suspendido
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Columna Izquierda --}}
                        <div class="space-y-6">
                            <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 border-b border-slate-200 pb-2">Cuenta de Usuario</h3>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-xs font-semibold text-slate-500 uppercase">Correo Electrónico (Login)</dt>
                                        <dd class="text-sm text-slate-900 mt-1 font-medium bg-white px-3 py-2 rounded border border-slate-200">{{ $profesore->user?->email ?? 'Sin cuenta asociada' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs font-semibold text-slate-500 uppercase">Privilegios</dt>
                                        <dd class="text-sm text-slate-900 mt-1 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                            Rol: {{ ucfirst($profesore->user?->role ?? 'N/A') }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 border-b border-slate-200 pb-2">Información de Contacto</h3>
                                <dl class="space-y-3">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-slate-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        <div>
                                            <dt class="sr-only">Teléfono</dt>
                                            <dd class="text-sm text-slate-900 font-medium">{{ $profesore->telefono ?: 'No especificado' }}</dd>
                                        </div>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        {{-- Columna Derecha --}}
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 border-b border-slate-200 pb-2">Datos Legales / RRHH</h3>
                                <dl class="space-y-3">
                                    <div class="grid grid-cols-3 gap-4">
                                        <dt class="text-xs font-semibold text-slate-500 uppercase col-span-1">Identificación</dt>
                                        <dd class="text-sm text-slate-900 col-span-2 font-medium">
                                            @if($profesore->tipo_identificacion && $profesore->num_identificacion)
                                                {{ $profesore->tipo_identificacion }}: {{ $profesore->num_identificacion }}
                                            @else
                                                <span class="text-slate-400 italic">No especificado</span>
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        <dt class="text-xs font-semibold text-slate-500 uppercase col-span-1">Antigüedad</dt>
                                        <dd class="text-sm text-slate-900 col-span-2 font-medium">
                                            @if($profesore->fecha_contratacion)
                                                Contratado el {{ \Carbon\Carbon::parse($profesore->fecha_contratacion)->format('d M, Y') }}<br>
                                                <span class="text-xs text-indigo-600">({{ \Carbon\Carbon::parse($profesore->fecha_contratacion)->diffForHumans() }})</span>
                                            @else
                                                <span class="text-slate-400 italic">No especificada</span>
                                            @endif
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            
                            <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100">
                                <h3 class="text-sm font-bold text-indigo-900 uppercase tracking-wider mb-3">Clases Asignadas</h3>
                                @if(isset($profesore->clases) && $profesore->clases->count() > 0)
                                    <div class="bg-white rounded-lg border border-indigo-100 p-4">
                                        <div class="text-3xl font-bold text-indigo-600">{{ $profesore->clases->count() }}</div>
                                        <div class="text-sm text-indigo-800 font-medium font-medium mt-1">Grupos/Clases activas bajo su cargo</div>
                                    </div>
                                @else
                                    <div class="text-sm text-indigo-500 italic flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Este profesor aún no tiene clases asignadas.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 text-center md:text-left text-xs text-slate-400">
                        Registrado en el sistema: {{ $profesore->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
