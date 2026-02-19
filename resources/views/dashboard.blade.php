<x-app-layout>
    <div class="max-w-5xl mx-auto">
        <div class="mb-8 border-b border-slate-200 pb-6">
            <h1 class="text-2xl font-bold md:text-4xl text-slate-800">Cronograma Académico</h1>
            <p class="text-slate-500 mt-2 italic">Organización semestral de cursos y niveles.</p>
        </div>

        <div class="bg-white shadow-xl shadow-slate-200/50 rounded-2xl overflow-hidden border border-slate-200">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="p-4 text-left font-semibold">Meses</th>
                            <th class="p-4 text-left font-semibold">Días</th>
                            <th class="p-4 text-left font-semibold">Programa / Descripción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 font-bold text-slate-700">JAN / FEV</td>
                            <td class="p-4 text-slate-500 font-mono">01 - 08</td>
                            <td class="p-4 text-sm text-slate-600">Apertura de ciclo: Inglés y Portugués para Kids.</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 font-bold text-slate-700">MAR / ABR / MAI</td>
                            <td class="p-4 text-slate-500 font-mono">09 - 18</td>
                            <td class="p-4 text-sm text-slate-600">Cursos intensivos para profesionales y estudiantes.</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 font-bold text-slate-700">JUN / JUL / AGO</td>
                            <td class="p-4 text-slate-500 font-mono">19 - 26</td>
                            <td class="p-4 text-sm text-slate-600">Metodología aplicada: Español para extranjeros.</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 font-bold text-slate-700">SET / OUT / NOV / DEZ</td>
                            <td class="p-4 text-slate-500 font-mono">27 - 31</td>
                            <td class="p-4 text-sm text-slate-600">Cierre de año y certificaciones internacionales[cite: 1, 4].</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-12 bg-indigo-900 rounded-3xl p-8 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl font-bold">Contáctanos</h2>
                <p class="mt-2 text-indigo-100 max-w-md">¿Listo para empezar tu aprendizaje? Estamos aquí para ayudarte.</p>
                <button class="mt-6 bg-white text-indigo-900 px-8 py-3 rounded-full font-bold hover:bg-indigo-50 transition">
                    Enviar Mensaje
                </button>
            </div>
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-800 rounded-full opacity-50"></div>
        </div>
    </div>
</x-app-layout>
