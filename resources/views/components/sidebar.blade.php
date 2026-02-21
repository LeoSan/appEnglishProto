<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed top-16 bottom-0 left-0 z-40 w-64 bg-white border-r border-slate-200 transform md:translate-x-0 transition-transform duration-300 ease-in-out md:relative md:inset-y-0 md:top-0 md:h-[calc(100vh-4rem)] p-6 space-y-8 overflow-y-auto">
    
    <!-- Mobile Close Button (Optional but good for UX) -->
    <div class="md:hidden flex justify-end mb-4">
        <button @click="sidebarOpen = false" class="text-slate-500 hover:text-slate-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div>
        <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Navegación</h3>
        <ul class="space-y-3">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center {{ request()->routeIs('dashboard') ? 'text-indigo-600 font-medium' : 'text-slate-600 hover:text-indigo-600 transition' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}" class="flex items-center text-slate-600 hover:text-indigo-600 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Nuestra Historia
                </a>
            </li>
        </ul>
    </div>

    @auth
        @if(in_array(Auth::user()->role, ['admin', 'profesor']))
        <div>
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Gestión</h3>
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('alumnos.index') }}" class="flex items-center {{ request()->routeIs('alumnos.index') ? 'text-indigo-600 font-medium' : 'text-slate-600 hover:text-indigo-600 transition' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Listar Alumnos
                    </a>
                </li>
                <li>
                    <a href="{{ route('alumnos.create') }}" class="flex items-center {{ request()->routeIs('alumnos.*') && !request()->routeIs('alumnos.index') ? 'text-indigo-600 font-medium' : 'text-slate-600 hover:text-indigo-600 transition' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        Crear Alumno
                    </a>
                </li>

                {{-- CLASES (Admin y Profesor) --}}
                @if(in_array(auth()->user()->role, ['admin', 'profesor']))
                <li class="pt-2 border-t border-slate-100 mt-2">
                    <x-nav-link :href="route('materias.index')" :active="request()->routeIs('materias.*')" class="flex items-center {{ request()->routeIs('materias.*') ? 'text-indigo-600 font-medium' : 'text-slate-600 hover:text-indigo-600 transition' }}">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Librería de Materias
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('clases.index')" :active="request()->routeIs('clases.*')" class="flex items-center {{ request()->routeIs('clases.*') ? 'text-indigo-600 font-medium' : 'text-slate-600 hover:text-indigo-600 transition' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Librería de Clases
                    </x-nav-link>
                </li>
                @endif

                @if(Auth::user()->role === 'admin')
                <li class="pt-2 border-t border-slate-100 mt-2">
                    <a href="{{ route('profesores.index') }}" class="flex items-center {{ request()->routeIs('profesores.index') ? 'text-indigo-600 font-medium' : 'text-slate-600 hover:text-indigo-600 transition' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Listar Profesores
                    </a>
                </li>
                <li>
                    <a href="{{ route('profesores.create') }}" class="flex items-center {{ request()->routeIs('profesores.*') && !request()->routeIs('profesores.index') ? 'text-indigo-600 font-medium' : 'text-slate-600 hover:text-indigo-600 transition' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Añadir Profesor
                    </a>
                </li>
                @endif
            </ul>
        </div>
        @endif
    @endauth


    @auth
    <div class="pt-4 border-t border-slate-200">
        <div class="flex items-center gap-3 mb-4 px-2">
            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="text-sm">
                <p class="font-medium text-slate-700">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center text-red-600 hover:bg-red-50 px-3 py-2 rounded-md transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Cerrar Sesión
            </button>
        </form>
    </div>
    @endauth
</aside>
