<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>English | Academy</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased text-white bg-black min-h-screen flex flex-col relative overflow-x-hidden selection:bg-red-500 selection:text-white">
    
    <!-- Background Image with Gradient Overlays -->
    <div class="absolute inset-0 z-0 flex items-center justify-center overflow-hidden">
        <style>
            @keyframes slide-fade {
                0% { opacity: 1; transform: scale(1); }
                30% { opacity: 1; transform: scale(1.05); }
                50% { opacity: 0; transform: scale(1.08); }
                100% { opacity: 0; transform: scale(1.08); }
            }
            .animate-bg-1 {
                animation: slide-fade 8s infinite;
            }
            .animate-bg-2 {
                animation: slide-fade 8s infinite;
                animation-delay: 4s; /* Starts halfway through the total loop */
            }
        </style>

        <!-- New English Academy Background Image 1 (Header1) -->
        <div class="absolute inset-0 bg-center animate-bg-1" style="background-image: url('{{ asset('images/Header1.jpg') }}'); filter: brightness(70%) contrast(1.1); transform-origin: center;"></div>
        
        <!-- New English Academy Background Image 2 (Header2) -->
        <!-- Placed over the first one, but starts invisible because of animation delay -->
        <div class="absolute inset-0 bg-center animate-bg-2 opacity-0" style="background-image: url('{{ asset('images/Header2.jpg') }}'); filter: brightness(70%) contrast(1.1); transform-origin: center;"></div>

        <!-- Vignette and bottom fade for text readability -->
        <div class="absolute inset-0 bg-black/20 w-full h-full mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        <div class="absolute top-0 inset-x-0 h-32 bg-gradient-to-b from-black/60 to-transparent"></div>
    </div>

    <!-- Header Navigation -->
    <header class="relative z-20 flex items-center justify-between px-6 lg:px-12 py-8 w-full mx-auto">
        <!-- Brand Logo Box -->
        <div class="flex-shrink-0 flex items-center">
            <a href="/">
                <img src="{{ asset('images/logo2.png') }}" alt="The Palace of Language" class="h-40 w-auto rounded-md shadow-lg transition-transform hover:scale-105" />
            </a>
        </div>
        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center space-x-8 text-[15px] font-medium tracking-wide">
            <a href="#" class="hover:text-red-400 flex items-center gap-1.5 transition-colors">
                Services 
                <svg class="w-3.5 h-3.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
            </a>
            <a href="#" class="hover:text-red-400 transition-colors">Schedule</a>
            <a href="#" class="hover:text-red-400 transition-colors">Contact</a>
            
            <!-- Flags -->
            <div class="flex items-center space-x-3 pl-8 border-l border-white/20">
                <a href="#" class="text-xl transition-transform hover:scale-110" title="English">🇺🇸</a>
                <a href="#" class="text-xl opacity-60 hover:opacity-100 transition-all hover:scale-110" title="Español">🇲🇽</a>
            </div>
            
            <!-- Quick Auth Links (Optional, kept from Laravel default) -->
            @if (Route::has('login'))
                <div class="pl-4 flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm border border-transparent hover:border-white/50 rounded-full transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm border border-transparent hover:border-white/50 rounded-full transition-all">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-white text-black hover:bg-gray-200 rounded-full transition-colors font-semibold">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>
        
        <!-- Mobile Menu Button -->
        <button class="lg:hidden text-white hover:text-red-400 transition ml-auto">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </header>

    <!-- Main Hero Content -->
    <main class="relative z-20 flex-grow flex items-center w-full px-6 lg:px-24">
        <div class="max-w-4xl pt-8 pb-32">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-light leading-[1.1] mb-6 tracking-wide drop-shadow-md">
                Master English.<br />
                Unlock Your <strong class="font-bold tracking-normal text-emerald-400">Global Potential.</strong>
            </h1>
            
            <p class="text-lg md:text-xl text-white/90 font-light max-w-2xl mb-12 leading-relaxed drop-shadow-sm">
                Join our academy and learn with native speakers through interactive, real-world practice designed for fluency and confidence.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-500 rounded-[2rem] text-white text-lg font-semibold hover:bg-emerald-400 focus:ring-4 focus:ring-emerald-500/30 transition-all duration-300 shadow-[0_4px_20px_rgba(16,185,129,0.3)]">
                    Start Learning Today
                </a>
                <a href="#" class="inline-flex items-center justify-center px-10 py-4 bg-transparent border-[1.5px] border-white/70 rounded-[2rem] text-white text-lg font-medium hover:border-white hover:bg-white/10 transition-all duration-300">
                    View Courses
                </a>
            </div>
        </div>
    </main>

    <!-- Services Section -->
    <x-home-services />

    <!-- Footer -->
    <div class="relative z-20">
        <x-footer />
    </div>

</body>
</html>
