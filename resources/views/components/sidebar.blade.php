<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed top-16 bottom-0 left-0 z-40 w-64 bg-white border-r border-slate-200 transform transition-transform duration-300 ease-in-out md:relative md:inset-y-0 md:top-0 md:h-screen p-6 space-y-8 overflow-y-auto">
    
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
                <a href="#" class="flex items-center text-indigo-600 font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Inicio
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center text-slate-600 hover:text-indigo-600 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Nuestra Historia
                </a>
            </li>
        </ul>
    </div>

    <div>
        <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Idiomas</h3>
        <div class="flex flex-col gap-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm w-fit font-medium">Inglés</span>
            <span class="px-3 py-1 bg-red-100 text-red-700 rounded text-sm w-fit font-medium">Español</span>
            <span class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm w-fit font-medium">Portugués</span>
        </div>
    </div>

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
