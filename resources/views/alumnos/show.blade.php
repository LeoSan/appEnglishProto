<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles del Alumno') }}
            </h2>
            <a href="{{ route('alumnos.index') }}" class="text-gray-600 hover:text-gray-900 font-medium transition">
                &larr; Volver a la lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    
                    <div class="border-b border-gray-200 pb-5 mb-6 flex flex-col md:flex-row md:justify-between md:items-center">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-3xl font-bold text-gray-900">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h3>
                            <p class="text-sm text-gray-500 mt-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                Matrícula: <span class="font-semibold ml-1 text-gray-700">{{ $alumno->matricula }}</span>
                            </p>
                        </div>
                        <div>
                            @if($alumno->activo)
                                <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800 shadow-sm border border-green-200">
                                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    Activo
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800 shadow-sm border border-red-200">
                                    <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                                    Inactivo
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Columna Izquierda -->
                        <div>
                            <div class="bg-gray-50 rounded-lg p-5 border border-gray-100 mb-6">
                                <h4 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                                    Información Académica
                                </h4>
                                <dl class="space-y-4">
                                    <div class="flex justify-between border-b border-gray-200 pb-2">
                                        <dt class="text-sm font-medium text-gray-500">Nivel de Inglés</dt>
                                        <dd class="text-sm text-gray-900 font-bold uppercase">{{ $alumno->nivel }}</dd>
                                    </div>

                                    <div class="flex justify-between">
                                        <dt class="text-sm font-medium text-gray-500">Fecha Inscripción</dt>
                                        <dd class="text-sm text-gray-900">{{ $alumno->fecha_inscripcion ? \Carbon\Carbon::parse($alumno->fecha_inscripcion)->format('d/m/Y') : 'N/D' }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-5 border border-gray-100">
                                <h4 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Cuenta de Usuario
                                </h4>
                                <dl class="space-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">Correo Electrónico (Login)</dt>
                                        <dd class="text-sm text-gray-900 bg-white p-2 rounded border border-gray-200 font-mono">{{ $alumno->user->email ?? 'Sin cuenta vinculada' }}</dd>
                                    </div>
                                    <div class="flex justify-between pt-2">
                                        <dt class="text-sm font-medium text-gray-500">Fecha de Registro</dt>
                                        <dd class="text-sm text-gray-900">{{ $alumno->created_at->format('d/m/Y H:i') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div class="bg-gray-50 rounded-lg p-5 border border-gray-100 h-full">
                            <h4 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                Información Personal y Contacto
                            </h4>
                            <dl class="space-y-5">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Género</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $alumno->genero ?? 'N/D' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Fecha de Nacimiento</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $alumno->fecha_nacimiento ? \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d/m/Y') : 'N/D' }}</dd>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-4">
                                    <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $alumno->telefono ?? 'N/D' }}</dd>
                                </div>
                                <div class="border-t border-gray-200 pt-4">
                                    <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                                    <dd class="mt-1 text-sm text-gray-900 bg-white p-3 rounded border border-gray-200 mt-2 min-h-[80px]">{{ $alumno->direccion ?? 'Sin registro de dirección.' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Materias Inscritas -->
                    <div class="mt-6 bg-gray-50 rounded-lg p-5 border border-gray-100">
                        <h4 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            Materias Inscritas ({{ $alumno->materias->count() }})
                        </h4>
                        @if($alumno->materias->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($alumno->materias as $materia)
                                    <div class="bg-white border border-gray-200 p-3 rounded-lg flex items-center shadow-sm">
                                        <div class="h-10 w-10 rounded bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-3 flex-shrink-0">
                                            {{ strtoupper(substr($materia->nombre, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 leading-tight">{{ $materia->nombre }}</p>
                                            <p class="text-xs text-gray-500 uppercase">{{ $materia->nivel }} • {{ $materia->horarios->count() }} hrs</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-gray-500 text-sm italic border border-dashed border-gray-300 rounded bg-white">
                                Este alumno no está inscrito en ninguna materia actualmente.
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('alumnos.edit', $alumno) }}" class="bg-indigo-50 py-2 px-6 border border-indigo-200 rounded-md shadow-sm text-sm font-bold text-indigo-700 hover:bg-indigo-100 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Hacer Modificaciones
                        </a>
                        <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" onsubmit="return confirm('ATENCIÓN: ¿Estás totalmente seguro de que deseas eliminar este alumno y su respectiva cuenta de login?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-6 inline-flex justify-center text-sm font-bold text-white hover:bg-red-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Eliminar Alumno
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
