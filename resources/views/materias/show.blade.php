<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('materias.index') }}" class="text-slate-500 hover:text-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                    {{ __('Materia:') }} {{ $materia->nombre }}
                </h2>
            </div>
            
            <div class="flex space-x-2">
                <a href="{{ route('materias.edit', $materia) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-25 transition">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Modificar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- TARJETA PRINCIPAL MATERIA --}}
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200 p-8">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-8 border-b border-slate-100 pb-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 font-bold text-xs uppercase tracking-wider border border-indigo-200">{{ strtoupper($materia->nivel) }}</span>
                            @if($materia->activa)
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 font-bold text-xs uppercase tracking-wider border border-green-200">Activa</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 font-bold text-xs uppercase tracking-wider border border-red-200">Cerrada</span>
                            @endif
                        </div>
                        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $materia->nombre }}</h1>
                        <div class="text-sm text-slate-500 mt-2 flex gap-4">
                            <span>Inicio: <strong>{{ \Carbon\Carbon::parse($materia->fecha_inicio)->format('d/m/Y') }}</strong></span>
                            @if($materia->fecha_fin)
                                <span>Fin: <strong>{{ \Carbon\Carbon::parse($materia->fecha_fin)->format('d/m/Y') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Tarjeta del Profesor --}}
                    @if($materia->profesor)
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 flex items-center min-w-[250px]">
                            @if($materia->profesor->url_foto)
                                <img src="{{ $materia->profesor->url_foto }}" alt="Profesor" class="w-12 h-12 rounded-full border-2 border-white shadow-sm object-cover">
                            @else
                                <div class="w-12 h-12 rounded-full border-2 border-white shadow-sm bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                    {{ substr($materia->profesor->nombre, 0, 1) }}
                                </div>
                            @endif
                            <div class="ml-4">
                                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Profesor Responsable</p>
                                <p class="text-sm font-bold text-slate-900">{{ $materia->profesor->nombre }} {{ $materia->profesor->apellidos }}</p>
                                <p class="text-xs text-slate-500">{{ $materia->profesor->especialidad }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Horarios Grid --}}
                <div class="mb-4">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Horarios Programados</h3>
                    @if($materia->horarios->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($materia->horarios as $horario)
                                <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-3 flex flex-col items-center justify-center text-center">
                                    <span class="text-xs font-bold uppercase text-indigo-500 tracking-widest">{{ $horario->dia_semana }}</span>
                                    <span class="text-lg font-black text-indigo-900 mt-1">
                                        {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}
                                        <span class="text-xs font-normal text-indigo-400 mx-1">a</span>
                                        {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-slate-400 italic text-sm py-4 bg-slate-50 rounded border border-dashed text-center">Sin horarios definidos.</div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- ALUMNOS INSCRITOS --}}
                <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200 p-8">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center justify-between border-b border-slate-100 pb-2">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Alumnos Inscritos
                        </div>
                        <span class="bg-indigo-100 text-indigo-700 py-0.5 px-2 rounded-full text-xs font-bold">{{ $materia->alumnos->count() }}</span>
                    </h3>

                    @if($materia->alumnos->count() > 0)
                        <div class="divide-y divide-slate-100 max-h-96 overflow-y-auto pr-2">
                            @foreach($materia->alumnos as $alumno)
                                <div class="py-3 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                                            {{ substr($alumno->nombre, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-slate-900">{{ $alumno->nombre }} {{ $alumno->apellidos }}</p>
                                            <p class="text-xs text-slate-500">{{ $alumno->matricula }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 uppercase">{{ $alumno->nivel }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <p class="mt-2 text-sm text-slate-500">No hay alumnos inscritos en esta materia aún.</p>
                        </div>
                    @endif
                </div>

                {{-- CLASES DE LA MATERIA --}}
                <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-2xl border border-slate-200 p-8">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center justify-between border-b border-slate-100 pb-2">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            Material y Clases
                        </div>
                        <span class="bg-indigo-100 text-indigo-700 py-0.5 px-2 rounded-full text-xs font-bold">{{ $materia->clases->count() }}</span>
                    </h3>

                    @if($materia->clases->count() > 0)
                        <div class="divide-y divide-slate-100 max-h-96 overflow-y-auto pr-2">
                            @foreach($materia->clases as $clase)
                                <a href="{{ route('clases.show', $clase) }}" class="py-3 flex flex-col justify-center group hover:bg-slate-50 transition px-2 -mx-2 rounded">
                                    <div class="flex justify-between items-start">
                                        <p class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition">{{ $clase->titulo }}</p>
                                        <span class="text-[10px] font-medium text-slate-400">{{ $clase->created_at->format('d/M/Y') }}</span>
                                    </div>
                                    @if($clase->etiqueta)
                                        <span class="text-xs text-slate-500 mt-1">{{ $clase->etiqueta }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <p class="mt-2 text-sm text-slate-500">No hay clases registradas para esta materia.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
