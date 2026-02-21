<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('clases.index') }}" class="text-slate-500 hover:text-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('Clase:') }} {{ $clase->titulo }}
                </h2>
            </div>
            
            <div class="flex space-x-2">
                <a href="{{ route('clases.edit', $clase) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-25 transition">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Modificar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- ENCABEZADO Y CONTENIDO DE LA CLASE --}}
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200 p-8">
                
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-8 border-b border-slate-100 pb-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 font-bold text-xs uppercase tracking-wider border border-indigo-200">{{ strtoupper($clase->nivel) }}</span>
                            @if($clase->etiqueta)
                                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 font-medium text-xs border border-slate-200">{{ $clase->etiqueta }}</span>
                            @endif
                        </div>
                        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $clase->titulo }}</h1>
                    </div>
                    
                    {{-- Tarjeta de Materia --}}
                    @if($clase->materia)
                        <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-xl flex items-start min-w-[250px] shadow-sm">
                            <div class="w-10 h-10 rounded-full bg-indigo-200 text-indigo-700 flex items-center justify-center font-bold shadow-inner">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-[10px] text-indigo-500 font-bold uppercase tracking-wider">Materia</p>
                                <p class="text-sm font-extrabold text-indigo-900 leading-tight">{{ $clase->materia->nombre }}</p>
                                <p class="text-xs text-indigo-700 mt-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $clase->materia->profesor->nombre ?? 'N/A' }} {{ $clase->materia->profesor->apellidos ?? '' }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Contenido Textual --}}
                @if($clase->contenido)
                    <div class="prose prose-indigo max-w-none text-slate-700">
                        {!! nl2br(e($clase->contenido)) !!}
                    </div>
                @else
                    <div class="text-slate-400 italic text-center py-8 bg-slate-50 rounded-lg border border-dashed border-slate-200">
                        Esta clase no tiene contenido teórico o descripción escrita.
                    </div>
                @endif
                
                <div class="mt-8 pt-6 border-t border-slate-100 text-xs text-slate-400 flex justify-between">
                    <span>Creada: {{ $clase->created_at->format('d M, Y H:i') }}</span>
                    <span>Última actualización: {{ $clase->updated_at->diffForHumans() }}</span>
                </div>
            </div>

            {{-- SECCIÓN EVIDENCIA MULTIMEDIA --}}
            <div class="bg-indigo-50/50 overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-indigo-100 p-8">
                <h3 class="text-xl font-bold text-indigo-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Material de la Clase ({{ $clase->multimedias->count() }})
                </h3>

                @if($clase->multimedias->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($clase->multimedias as $media)
                            <a href="{{ $media->url }}" target="_blank" class="block bg-white p-5 rounded-xl border border-indigo-100 shadow-sm hover:shadow-md hover:border-indigo-300 transition group relative overflow-hidden">
                                
                                {{-- Decoración de borde superior según tipo --}}
                                <div class="absolute top-0 left-0 w-full h-1 
                                    {{ $media->tipo === 'video' ? 'bg-red-500' : '' }}
                                    {{ $media->tipo === 'pdf' ? 'bg-orange-500' : '' }}
                                    {{ $media->tipo === 'enlace' ? 'bg-blue-500' : '' }}
                                    {{ $media->tipo === 'audio' ? 'bg-purple-500' : 'bg-indigo-500' }}">
                                </div>

                                <div class="flex items-start justify-between mb-3">
                                    <h4 class="font-bold text-slate-800 group-hover:text-indigo-600 transition truncate pr-4">{{ $media->titulo }}</h4>
                                    
                                    {{-- Iconos según el tipo --}}
                                    @if($media->tipo === 'video')
                                        <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                                    @elseif($media->tipo === 'pdf')
                                        <svg class="w-6 h-6 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    @else
                                        <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                    @endif
                                </div>
                                
                                @if($media->descripcion)
                                    <p class="text-sm text-slate-500 line-clamp-2 mt-1">{{ $media->descripcion }}</p>
                                @endif
                                
                                <div class="mt-4 text-xs font-semibold text-indigo-600 flex items-center gap-1">
                                    Abrir recurso
                                    <svg class="w-3 h-3 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 bg-white rounded-xl border border-indigo-100 shadow-sm">
                        <svg class="mx-auto h-12 w-12 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-2 text-sm text-indigo-500 font-medium">No hay recursos multimedia adjuntos.</p>
                        <a href="{{ route('clases.edit', $clase) }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-sm font-semibold rounded-lg transition border border-indigo-200">
                            Añadir Material
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
