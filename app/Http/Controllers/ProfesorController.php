<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;
use App\Services\ProfesorService;
use App\Http\Requests\StoreProfesorRequest;
use App\Http\Requests\UpdateProfesorRequest;

class ProfesorController extends Controller
{
    protected $profesorService;

    public function __construct(ProfesorService $profesorService)
    {
        $this->profesorService = $profesorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Profesor::with('user')->latest()->paginate(10);
        return view('profesores.index', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profesores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfesorRequest $request)
    {
        try {
            $this->profesorService->createProfesor($request->validated());
            return redirect()->route('profesores.index')->with('success', 'Profesor creado con éxito. La contraseña inicial es su número de empleado.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al crear el profesor: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesore)
    {
        $profesore->load('user', 'clases'); // Example relation load
        return view('profesores.show', compact('profesore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesore)
    {
        return view('profesores.edit', compact('profesore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfesorRequest $request, Profesor $profesore)
    {
        try {
            $this->profesorService->updateProfesor($profesore, $request->validated());
            return redirect()->route('profesores.index')->with('success', 'Profesor actualizado con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al actualizar el profesor: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesor $profesore)
    {
        try {
            $this->profesorService->deleteProfesor($profesore);
            return redirect()->route('profesores.index')->with('success', 'Profesor y su cuenta eliminados con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar el profesor.');
        }
    }
}
