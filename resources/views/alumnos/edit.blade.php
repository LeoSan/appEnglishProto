<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight bg-white">
            {{ __('Editar Alumno') }}: <span class="text-indigo-600">{{ $alumno->nombre }} {{ $alumno->apellidos }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if($errors->any())
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                    <strong>Error:</strong> Por favor corrige los siguientes errores de validación.
                    <ul class="list-disc mt-2 ml-4 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('alumnos.update', $alumno) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                            <!-- Información Académica -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 8.56l-1.22-.524a2 2 0 010-3.682l7-3a2 2 0 011.576 0l7 3a2 2 0 010 3.682l-1.22.524a2.992 2.992 0 00-1.077 1.076L12.394 13.5a1 1 0 01-1.576 0l-3.238-2.61a2.992 2.992 0 00-1.076-1.076z"/><path d="M9 14.5a1 1 0 012 0v2.793l1.854-1.853a.5.5 0 01.707.707l-2.5 2.5a.5.5 0 01-.707 0l-2.5-2.5a.5.5 0 01.707-.707L9 17.293V14.5z"/></svg>
                                    Información de la Cuenta y Académica
                                </h3>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico <span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $alumno->user->email ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                            </div>

                            <div>
                                <label for="matricula" class="block text-sm font-medium text-gray-700">Matrícula <span class="text-red-500">*</span></label>
                                <input type="text" name="matricula" id="matricula" value="{{ old('matricula', $alumno->matricula) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                            </div>

                            <div>
                                <label for="nivel" class="block text-sm font-medium text-gray-700">Nivel de Inglés <span class="text-red-500">*</span></label>
                                <select id="nivel" name="nivel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                                    <option value="a1" {{ old('nivel', $alumno->nivel) == 'a1' ? 'selected' : '' }}>A1 - Principiante</option>
                                    <option value="a2" {{ old('nivel', $alumno->nivel) == 'a2' ? 'selected' : '' }}>A2 - Básico</option>
                                    <option value="b1" {{ old('nivel', $alumno->nivel) == 'b1' ? 'selected' : '' }}>B1 - Intermedio</option>
                                    <option value="b2" {{ old('nivel', $alumno->nivel) == 'b2' ? 'selected' : '' }}>B2 - Intermedio Alto</option>
                                    <option value="c1" {{ old('nivel', $alumno->nivel) == 'c1' ? 'selected' : '' }}>C1 - Avanzado</option>
                                    <option value="c2" {{ old('nivel', $alumno->nivel) == 'c2' ? 'selected' : '' }}>C2 - Dominio</option>
                                </select>
                            </div>
                            

                            <!-- Información Personal -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                                    Información Personal
                                </h3>
                            </div>

                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre(s) <span class="text-red-500">*</span></label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $alumno->nombre) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                            </div>

                            <div>
                                <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos <span class="text-red-500">*</span></label>
                                <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $alumno->apellidos) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                            </div>

                            <div>
                                <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                                <select id="genero" name="genero" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                                    <option value="">Selecciona...</option>
                                    <option value="Hombre" {{ old('genero', $alumno->genero) == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                                    <option value="Mujer" {{ old('genero', $alumno->genero) == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                                    <option value="Otro" {{ old('genero', $alumno->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>

                            <div>
                                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                            </div>

                            <!-- Información de Contacto e Inscripción -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z" clip-rule="evenodd" /></svg>
                                    Información de Contacto e Inscripción
                                </h3>
                            </div>

                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $alumno->telefono) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                            </div>

                            <div>
                                <label for="fecha_inscripcion" class="block text-sm font-medium text-gray-700">Fecha de Inscripción</label>
                                <input type="date" name="fecha_inscripcion" id="fecha_inscripcion" value="{{ old('fecha_inscripcion', $alumno->fecha_inscripcion) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                            </div>

                            <div class="md:col-span-2">
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <textarea name="direccion" id="direccion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">{{ old('direccion', $alumno->direccion) }}</textarea>
                            </div>

                            <!-- Inscripción a Materias -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-lg font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    Gestión de Inscripción a Materias
                                </h3>
                                
                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @php
                                        // Array de IDs de materias seleccionadas anteriormente (o desde BD)
                                        $selectedMaterias = old('materias', $alumno->materias->pluck('id')->toArray());
                                    @endphp
                                    @forelse($materias as $materia)
                                        <label class="flex items-start bg-slate-50 p-3 rounded-lg border border-slate-200 hover:border-indigo-300 transition cursor-pointer select-none">
                                            <div class="flex items-center h-5">
                                                <input name="materias[]" type="checkbox" value="{{ $materia->id }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded cursor-pointer" {{ is_array($selectedMaterias) && in_array($materia->id, $selectedMaterias) ? 'checked' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm flex-1">
                                                <div class="font-bold text-slate-700 leading-tight">{{ $materia->nombre }}</div>
                                                <p class="text-slate-500 text-xs mt-0.5"><span class="uppercase font-semibold text-indigo-600 mr-2">{{ $materia->nivel }}</span> {{ $materia->horarios->count() }} hrs</p>
                                            </div>
                                        </label>
                                    @empty
                                        <div class="col-span-full shadow-sm text-center py-6 bg-slate-50 rounded-lg border border-slate-200 text-slate-500 text-sm italic">
                                            No hay materias activas disponibles.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="md:col-span-2 mt-2 bg-gray-50 p-4 rounded border border-gray-200">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="activo" name="activo" type="checkbox" value="1" {{ old('activo', $alumno->activo) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="activo" class="font-medium text-gray-700 cursor-pointer">Alumno Activo</label>
                                        <p class="text-gray-500">Indica si el alumno está actualmente cursando o habilitado en la institución.</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end space-x-3">
                            <a href="{{ route('alumnos.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-600 border border-transparent rounded-md shadow-sm py-2 px-8 inline-flex justify-center text-sm font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                Actualizar Alumno
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
