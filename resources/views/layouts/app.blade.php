<!DOCTYPE html>
<html lang="es" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaizen - Escuela de Idiomas</title>
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden">
    
    <x-navbar />

    <div class="flex">
        <x-sidebar />

        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             class="fixed inset-0 bg-slate-900/50 z-30 md:hidden"
             x-transition:enter="transition opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <main class="flex-1 min-w-0 p-4 md:p-8">
            {{ $slot }}
        </main>
    </div>

    <x-footer />

    @stack('scripts')
</body>
</html>
