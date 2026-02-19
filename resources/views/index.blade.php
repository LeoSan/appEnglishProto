<x-app-layout>
    <x-slot name="title">Dashboard Educativo - Landing</x-slot>

    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900 sm:text-4xl">
            Mejora Continua <span class="text-indigo-600">Kaizen</span>
        </h1>
        <p class="mt-4 text-lg text-slate-600 max-w-2xl">
            Descripción de los cursos para americanos, españoles y locales. Formación profesional para todas las edades.
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-100 bg-slate-50">
            <h2 class="font-bold text-slate-700">Cronograma de Cursos</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="p-4 text-sm font-semibold text-slate-600 border-b">MES</th>
                        <th class="p-4 text-sm font-semibold text-slate-600 border-b">DÍAS</th>
                        <th class="p-4 text-sm font-semibold text-slate-600 border-b">PROGRAMA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr>
                        <td class="p-4 font-bold text-indigo-600">JAN / FEV</td>
                        <td class="p-4 text-sm text-slate-500">01 - 08</td>
                        <td class="p-4 italic text-sm">Cursos de Verano - Kids</td>
                    </tr>
                    <tr>
                        <td class="p-4 font-bold text-indigo-600">MAR / ABR</td>
                        <td class="p-4 text-sm text-slate-500">09 - 26</td>
                        <td class="p-4 italic text-sm">Inglés Profesional / Español</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
            <h3 class="text-lg font-bold text-indigo-900 mb-2">Nuestra Metodología</h3>
            <p class="text-indigo-800 text-sm leading-relaxed">
                Aprendizaje dinámico enfocado en la práctica real para estudiantes y profesionales.
            </p>
        </div>
        <div class="bg-slate-800 p-6 rounded-xl text-white">
            <h3 class="text-lg font-bold mb-2 text-white">¿Por qué elegirnos?</h3>
            <ul class="text-sm space-y-2 text-slate-300">
                <li>• Profesores nativos certificados.</li>
                <li>• Material didáctico actualizado.</li>
                <li>• Alianzas gubernamentales (SEMED).</li>
            </ul>
        </div>
    </div>
</x-app-layout>
