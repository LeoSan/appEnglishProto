<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Http\Request;
use App\Services\MateriaService;
use App\Http\Requests\StoreMateriaRequest;
use App\Http\Requests\UpdateMateriaRequest;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    public function __construct(private MateriaService $materiaService)
    {
    }

    public function index()
    {
        $query = Materia::with(['profesor', 'horarios', 'alumnos'])->latest();

        if (Auth::user()->role === 'profesor') {
            $query->where('profesor_id', Auth::user()->profesor->id ?? 0);
        }

        $materias = $query->paginate(10);
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        $profesores = Profesor::all();
        return view('materias.create', compact('profesores'));
    }

    public function store(StoreMateriaRequest $request)
    {
        try {
            $this->materiaService->createMateria($request->validated());
            return redirect()->route('materias.index')->with('success', 'Materia creada con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear materia: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Materia $materia)
    {
        $materia->load(['profesor', 'horarios', 'alumnos', 'clases']);
        return view('materias.show', compact('materia'));
    }

    public function edit(Materia $materia)
    {
        $materia->load('horarios');
        $profesores = Profesor::all();
        return view('materias.edit', compact('materia', 'profesores'));
    }

    public function update(UpdateMateriaRequest $request, Materia $materia)
    {
        try {
            $this->materiaService->updateMateria($materia, $request->validated());
            return redirect()->route('materias.index')->with('success', 'Materia actualizada con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar materia: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Materia $materia)
    {
        try {
            $this->materiaService->deleteMateria($materia);
            return redirect()->route('materias.index')->with('success', 'Materia eliminada con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar esta materia.');
        }
    }
}
