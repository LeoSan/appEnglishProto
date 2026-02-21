<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight flex items-center gap-2">
            <a href="{{ route('materias.index') }}" class="text-slate-500 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            {{ __('Editar Materia:') }} <span class="text-indigo-600">{{ $materia->nombre }}</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200">
                <div class="p-8">
                    <form method="POST" action="{{ route('materias.update', $materia) }}" x-data="materiaForm()">
                        @csrf
                        @method('PUT')

                        <!-- Datos Generales -->
                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-2 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                Información de la Materia
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <x-input-label for="nombre">Nombre de la Materia <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="nombre" class="block mt-1 w-full text-lg font-medium" type="text" name="nombre" :value="old('nombre', $materia->nombre)" required autofocus />
                                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="nivel">Nivel <span class="text-red-500">*</span></x-input-label>
                                    <select id="nivel" name="nivel" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-slate-700" required>
                                        <option value="a1" {{ old('nivel', $materia->nivel) == 'a1' ? 'selected' : '' }}>A1 - Principiante</option>
                                        <option value="a2" {{ old('nivel', $materia->nivel) == 'a2' ? 'selected' : '' }}>A2 - Básico</option>
                                        <option value="b1" {{ old('nivel', $materia->nivel) == 'b1' ? 'selected' : '' }}>B1 - Pre-Intermedio</option>
                                        <option value="b2" {{ old('nivel', $materia->nivel) == 'b2' ? 'selected' : '' }}>B2 - Intermedio</option>
                                        <option value="c1" {{ old('nivel', $materia->nivel) == 'c1' ? 'selected' : '' }}>C1 - Intermedio Alto</option>
                                        <option value="c2" {{ old('nivel', $materia->nivel) == 'c2' ? 'selected' : '' }}>C2 - Avanzado</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('nivel')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="profesor_id">Profesor Responsable <span class="text-red-500">*</span></x-input-label>
                                    <select id="profesor_id" name="profesor_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-slate-700 font-medium bg-slate-50" required>
                                        @if(Auth::user()->role === 'admin')
                                            @foreach($profesores as $profe)
                                                <option value="{{ $profe->id }}" {{ old('profesor_id', $materia->profesor_id) == $profe->id ? 'selected' : '' }}>
                                                    {{ $profe->nombre }} {{ $profe->apellidos }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach($profesores as $profe)
                                                @if($profe->user_id == Auth::id())
                                                    <option value="{{ $profe->id }}" selected>Mi Usuario ({{ $profe->nombre }})</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="fecha_inicio">Fecha de Inicio <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="fecha_inicio" class="block mt-1 w-full" type="date" name="fecha_inicio" :value="old('fecha_inicio', $materia->fecha_inicio)" required />
                                    <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="fecha_fin">Fecha de Fin</x-input-label>
                                    <x-text-input id="fecha_fin" class="block mt-1 w-full text-slate-500" type="date" name="fecha_fin" :value="old('fecha_fin', $materia->fecha_fin)" />
                                    <p class="mt-1 text-xs text-slate-400">Opcional.</p>
                                </div>

                                <div class="md:col-span-2 pt-2">
                                    <label for="activa" class="inline-flex items-center">
                                        <input id="activa" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-5 h-5 cursor-pointer" name="activa" value="1" {{ old('activa', $materia->activa) ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm font-bold text-slate-700 cursor-pointer">Materia Activa (Visible para inscripción/clases)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Horarios -->
                        <div class="mb-10 bg-indigo-50/30 p-6 rounded-xl border border-indigo-100 relative">
                            <h3 class="text-lg font-bold text-indigo-900 border-b border-indigo-100 pb-2 mb-6 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Horarios de la Materia
                                </div>
                                <span class="text-xs font-normal text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full" x-text="horarios.length + ' Horarios definidos'"></span>
                            </h3>

                            <div class="space-y-4">
                                <template x-for="(horario, index) in horarios" :key="horario.id">
                                    <div class="flex items-center gap-4 bg-white p-4 rounded-lg border border-slate-200 shadow-sm relative group overflow-hidden transition hover:border-indigo-300">
                                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-500"></div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 flex-1 items-center pl-2">
                                            <div>
                                                <label class="block font-medium text-xs text-slate-500 uppercase tracking-wider">Día <span class="text-red-500">*</span></label>
                                                <select x-model="horario.dia_semana" :name="`horarios[${index}][dia_semana]`" class="border-b border-gray-300 focus:border-indigo-500 focus:ring-0 px-0 mt-1 w-full text-sm font-medium text-indigo-900" required>
                                                    <option value="lunes">Lunes</option>
                                                    <option value="martes">Martes</option>
                                                    <option value="miercoles">Miércoles</option>
                                                    <option value="jueves">Jueves</option>
                                                    <option value="viernes">Viernes</option>
                                                    <option value="sabado">Sábado</option>
                                                    <option value="domingo">Domingo</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block font-medium text-xs text-slate-500 uppercase tracking-wider">De (HH:MM) <span class="text-red-500">*</span></label>
                                                <input type="time" x-model="horario.hora_inicio" :name="`horarios[${index}][hora_inicio]`" class="border-b border-gray-300 focus:border-indigo-500 focus:ring-0 px-0 mt-1 w-full text-sm bg-transparent" required>
                                            </div>
                                            <div>
                                                <label class="block font-medium text-xs text-slate-500 uppercase tracking-wider">A (HH:MM) <span class="text-red-500">*</span></label>
                                                <input type="time" x-model="horario.hora_fin" :name="`horarios[${index}][hora_fin]`" class="border-b border-gray-300 focus:border-indigo-500 focus:ring-0 px-0 mt-1 w-full text-sm bg-transparent" required>
                                            </div>
                                        </div>

                                        <button type="button" @click="removeHorario(index)" class="self-center p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Eliminar Horario">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <div class="mt-6 flex justify-center">
                                <button type="button" @click="addHorario()" class="inline-flex items-center px-4 py-2 bg-white border border-indigo-300 rounded-md font-bold text-xs text-indigo-700 uppercase tracking-widest shadow-sm hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition w-full justify-center border-dashed">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                    Añadir Horario
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-6 border-t border-slate-200">
                            <a href="{{ route('materias.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition mr-4">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition shadow-md">
                                Actualizar Materia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Alpine.js para gestionar los Horarios (Precarga dinámica en edit) -->
    <script>
        function materiaForm() {
            // Obtenemos los horarios pasados como JSON desde Blade si existen (pasando por html_entity_decode)
            const oldHorarios = {!! old('horarios') ? json_encode(old('horarios')) : $materia->horarios->map(function($h) { 
                return ['dia_semana' => $h->dia_semana, 'hora_inicio' => \Carbon\Carbon::parse($h->hora_inicio)->format('H:i'), 'hora_fin' => \Carbon\Carbon::parse($h->hora_fin)->format('H:i')]; 
            })->toJson() !!};
            
            // Si Laravel nos devuelve un array indexado o un objeto (al fallar validación es un objeto si hay huecos)
            let parsedHorarios = [];
            if(oldHorarios !== null && typeof oldHorarios === 'object') {
                parsedHorarios = Object.values(oldHorarios).map(h => {
                    return {
                        id: Date.now() + Math.random(), // Generar ids únicos para alpine loops
                        dia_semana: h.dia_semana || 'lunes',
                        hora_inicio: h.hora_inicio || '',
                        hora_fin: h.hora_fin || ''
                    };
                });
            }

            return {
                horarios: parsedHorarios.length > 0 ? parsedHorarios : [],
                addHorario() {
                    this.horarios.push({ 
                        id: Date.now() + Math.random(), 
                        dia_semana: 'lunes', 
                        hora_inicio: '10:00', 
                        hora_fin: '12:00' 
                    });
                },
                removeHorario(index) {
                    this.horarios.splice(index, 1);
                }
            }
        }
    </script>
</x-app-layout>
