<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\User;
use App\Models\Profesor;
use App\Services\AlumnoService;
use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    protected $alumnoService;

    public function __construct(AlumnoService $alumnoService)
    {
        $this->alumnoService = $alumnoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::with('user', 'profesor')->latest()->paginate(10);
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profesores = Profesor::all();
        return view('alumnos.create', compact('profesores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlumnoRequest $request)
    {
        try {
            $this->alumnoService->createAlumno($request->validated());
            return redirect()->route('alumnos.index')->with('success', 'Alumno creado con éxito. La contraseña inicial es su matrícula.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al crear el alumno: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        $alumno->load('user', 'profesor');
        return view('alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno)
    {
        $profesores = Profesor::all();
        return view('alumnos.edit', compact('alumno', 'profesores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlumnoRequest $request, Alumno $alumno)
    {
        try {
            $this->alumnoService->updateAlumno($alumno, $request->validated());
            return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al actualizar el alumno: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        try {
            $this->alumnoService->deleteAlumno($alumno);
            return redirect()->route('alumnos.index')->with('success', 'Alumno y su cuenta eliminados con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar el alumno.');
        }
    }
}
