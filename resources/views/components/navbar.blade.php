<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-4">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">
                    E
                </div>
                <span class="font-bold text-xl tracking-tight">Escuela Logo</span>
            </div>
            
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ url('/') }}" class="text-slate-600 hover:text-indigo-600 transition">Inicio</a>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-slate-600 hover:text-indigo-600 transition">Dashboard</a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-indigo-700 transition">
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 transition">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-indigo-700 transition">
                        Inscribirse
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
