<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('clases.index') }}" class="text-slate-500 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Modificar Clase: ') }} {{ $clase->titulo }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('clases.update', $clase) }}" x-data="multimediaForm()" class="space-y-6">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">No se pudieron guardar los cambios</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    {{-- COLUMNA IZQUIERDA: DATOS MAESTROS (CLASE) --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-xl border border-slate-200 p-6">
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-5 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Detalles de la Clase
                            </h3>
                            
                            <div class="space-y-5">
                                <div>
                                    <x-input-label for="titulo">Título de la Clase <span class="text-red-500">*</span></x-input-label>
                                    <x-text-input id="titulo" class="block mt-1 w-full text-lg font-medium" type="text" name="titulo" :value="old('titulo', $clase->titulo)" required autofocus />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <x-input-label for="nivel">Nivel Requerido <span class="text-red-500">*</span></x-input-label>
                                        <select id="nivel" name="nivel" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-slate-700" required>
                                            <option value="">Seleccionar nivel...</option>
                                            <option value="a1" {{ old('nivel', $clase->nivel) == 'a1' ? 'selected' : '' }}>A1 - Principiante</option>
                                            <option value="a2" {{ old('nivel', $clase->nivel) == 'a2' ? 'selected' : '' }}>A2 - Básico</option>
                                            <option value="b1" {{ old('nivel', $clase->nivel) == 'b1' ? 'selected' : '' }}>B1 - Pre-Intermedio</option>
                                            <option value="b2" {{ old('nivel', $clase->nivel) == 'b2' ? 'selected' : '' }}>B2 - Intermedio</option>
                                            <option value="c1" {{ old('nivel', $clase->nivel) == 'c1' ? 'selected' : '' }}>C1 - Avanzado</option>
                                            <option value="c2" {{ old('nivel', $clase->nivel) == 'c2' ? 'selected' : '' }}>C2 - Dominio</option>
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="etiqueta" :value="__('Etiqueta (Tema)')" />
                                        <x-text-input id="etiqueta" class="block mt-1 w-full" type="text" name="etiqueta" :value="old('etiqueta', $clase->etiqueta)" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="contenido" :value="__('Descripción o Contenido Teórico')" />
                                    <textarea id="contenido" name="contenido" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('contenido', $clase->contenido) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- SECCIÓN DINÁMICA: MULTIMEDIA --}}
                        <div class="bg-indigo-50/50 overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-xl border border-indigo-100 p-6">
                            <div class="flex justify-between items-center border-b border-indigo-100 pb-3 mb-5">
                                <div>
                                    <h3 class="text-lg font-bold text-indigo-900 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        Material Multimedia Adjunto
                                    </h3>
                                    <p class="text-xs text-indigo-600 mt-1">Al guardar, se sobrescribirán los archivos con lo que se muestre en esta lista.</p>
                                </div>
                                <button type="button" @click="addMediaRow()" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Añadir Recurso
                                </button>
                            </div>

                            <div class="space-y-4">
                                <template x-for="(media, index) in multimedias" :key="media.id">
                                    <div class="bg-white p-4 rounded-lg border border-indigo-200 shadow-sm relative group hover:border-indigo-400 transition">
                                        <button type="button" @click="removeMediaRow(index)" class="absolute -top-3 -right-3 bg-red-100 text-red-600 rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600 hover:text-white shadow-sm border border-red-200" title="Eliminar este recurso">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                            <div class="col-span-1 md:col-span-2">
                                                <label class="block font-medium text-xs text-slate-500 uppercase tracking-wider">Título del Recurso <span class="text-red-500">*</span></label>
                                                <input type="text" x-model="media.titulo" :name="`multimedia[${index}][titulo]`" class="border-b border-gray-300 focus:border-indigo-500 focus:ring-0 px-0 mt-1 w-full text-sm bg-transparent font-medium text-indigo-900" placeholder="Ej: Ejercicio 1" required>
                                            </div>
                                            <div class="col-span-1 md:col-span-2">
                                                <label class="block font-medium text-xs text-slate-500 uppercase tracking-wider">Enlace (URL) <span class="text-red-500">*</span></label>
                                                <input type="url" x-model="media.url" :name="`multimedia[${index}][url]`" class="border-b border-gray-300 focus:border-indigo-500 focus:ring-0 px-0 mt-1 w-full text-sm bg-transparent" placeholder="https://..." required>
                                            </div>
                                            <div class="col-span-1 md:col-span-3">
                                                <label class="block font-medium text-xs text-slate-500 uppercase tracking-wider">Descripción (Opcional)</label>
                                                <input type="text" x-model="media.descripcion" :name="`multimedia[${index}][descripcion]`" class="border-b border-gray-300 focus:border-indigo-500 focus:ring-0 px-0 mt-1 w-full text-sm bg-transparent text-slate-600">
                                            </div>
                                            <div class="col-span-1">
                                                <label class="block font-medium text-xs text-slate-500 uppercase tracking-wider">Tipo</label>
                                                <select x-model="media.tipo" :name="`multimedia[${index}][tipo]`" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded text-sm mt-1 w-full bg-slate-50 text-slate-700">
                                                    <option value="video">Video</option>
                                                    <option value="enlace">Página Web</option>
                                                    <option value="pdf">Documento PDF</option>
                                                    <option value="audio">Audio</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                    </div>

                    {{-- COLUMNA DERECHA: CONFIGURACIÓN Y ACCIONES --}}
                    <div class="lg:col-span-1 space-y-6">
                        
                        <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-xl border border-slate-200 p-6 sticky top-6">
                            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-100 pb-2 mb-4">Administración</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="materia_id">Materia <span class="text-red-500">*</span></x-input-label>
                                    <select id="materia_id" name="materia_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-slate-700 bg-slate-50 font-medium" required>
                                        @if(Auth::user()->role === 'admin')
                                            <option value="">-- Seleccionar Materia --</option>
                                            @foreach($materias as $mat)
                                                <option value="{{ $mat->id }}" {{ old('materia_id', $clase->materia_id) == $mat->id ? 'selected' : '' }}>
                                                    {{ $mat->nombre }} (Nivel: {{ strtoupper($mat->nivel) }})
                                                </option>
                                            @endforeach
                                        @else
                                            {{-- Si es profesor, forzamos a mostrar sus materias --}}
                                            @foreach($materias as $mat)
                                                @if($mat->profesor && $mat->profesor->user_id == Auth::id())
                                                    <option value="{{ $mat->id }}" {{ old('materia_id', $clase->materia_id) == $mat->id ? 'selected' : '' }}>
                                                        {{ $mat->nombre }} (Nivel: {{ strtoupper($mat->nivel) }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-slate-200 flex flex-col gap-3">
                                <button type="submit" class="w-full flex justify-center items-center px-4 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    Actualizar Cambios
                                </button>
                                <a href="{{ route('clases.index') }}" class="w-full flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                                    Cancelar
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            
            // Inyectamos la data anidada desde el controlador (modelo Multimedia asociado)
            let multimediasExistentes = {!! json_encode($clase->multimedias->toArray()) !!};
            
            // Re-mapear para que tenga un ID único para Alpine y no falle el :key
            multimediasExistentes = multimediasExistentes.map((m, index) => {
                return {
                    id: 'existente_' + m.id + '_' + index,
                    titulo: m.titulo,
                    url: m.url,
                    descripcion: m.descripcion || '',
                    tipo: m.tipo || 'video'
                };
            });

            Alpine.data('multimediaForm', () => ({
                // Si hubo un old input por error de validación lo usamos, si no, los de DB
                multimedias: {!! json_encode(old('multimedia', [])) !!}.length > 0 
                             ? {!! json_encode(old('multimedia', [])) !!} 
                             : (multimediasExistentes.length > 0 ? multimediasExistentes : [{ id: Date.now(), titulo: '', url: '', descripcion: '', tipo: 'video' }]),
                
                addMediaRow() {
                    this.multimedias.push({
                        id: Date.now(),
                        titulo: '',
                        url: '',
                        descripcion: '',
                        tipo: 'video'
                    });
                },
                
                removeMediaRow(index) {
                    this.multimedias.splice(index, 1);
                }
            }));
        });
    </script>
    @endpush
</x-app-layout>
