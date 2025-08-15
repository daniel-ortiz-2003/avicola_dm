<?php

namespace App\Http\Controllers;

use App\Models\Flock;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Flock::with('shed');

        // Aplicar filtro de búsqueda por nombre
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Aplicar filtro por tipo
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Aplicar filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $flocks = $query->latest()->paginate(10)->withQueryString();

        return view('flocks.index', compact('flocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lógica para mostrar el formulario de creación (requiere la lista de galpones)
        // $sheds = \App\Models\Shed::all();
        // return view('flocks.create', compact('sheds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Reemplazar con un FormRequest
    {
        // Autorizar la acción usando la FlockPolicy
        $this->authorize('create', Flock::class);

        // Lógica para guardar el nuevo lote en la BD
    }

    /**
     * Display the specified resource.
     */
    public function show(Flock $flock): View
    {
        // Cargar relaciones para mostrar información detallada
        $flock->load('shed', 'dailyRecords', 'eggProductions');
        return view('flocks.show', compact('flock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flock $flock)
    {
        // Lógica para mostrar el formulario de edición
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flock $flock)
    {
        // Lógica para actualizar el lote en la BD
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flock $flock)
    {
        // Lógica para eliminar el lote
    }
}
