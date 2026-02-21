<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Materia;
use Illuminate\Http\Request;
use App\Services\ClaseService;
use App\Http\Requests\StoreClaseRequest;
use App\Http\Requests\UpdateClaseRequest;
use Illuminate\Support\Facades\Auth;

class ClaseController extends Controller
{
    protected $claseService;

    public function __construct(ClaseService $claseService)
    {
        $this->claseService = $claseService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Clase::with(['materia', 'multimedias'])->latest();

        // Si es profesor, solo ve clases de sus materias
        if (Auth::user()->role === 'profesor') {
            $query->whereHas('materia', function ($q) {
                $q->where('profesor_id', Auth::user()->profesor->id ?? 0); // Need to check how to get profesor_id
            });
        }

        $clases = $query->paginate(10);
        return view('clases.index', compact('clases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materias = Materia::all();
        return view('clases.create', compact('materias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClaseRequest $request)
    {
        try {
            $this->claseService->createClase($request->validated());
            return redirect()->route('clases.index')->with('success', 'Clase y material multimedia creados con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al crear la clase: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Clase $clase)
    {
        $clase->load(['materia.profesor', 'multimedias']);
        return view('clases.show', compact('clase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clase $clase)
    {
        $clase->load('multimedias');
        $materias = Materia::all();
        return view('clases.edit', compact('clase', 'materias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClaseRequest $request, Clase $clase)
    {
        try {
            $this->claseService->updateClase($clase, $request->validated());
            return redirect()->route('clases.index')->with('success', 'Clase actualizada con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al actualizar la clase: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clase $clase)
    {
        try {
            $this->claseService->deleteClase($clase);
            return redirect()->route('clases.index')->with('success', 'Clase eliminada con éxito.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar la clase.');
        }
    }
}
