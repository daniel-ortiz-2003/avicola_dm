<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::latest()->paginate(10);
        return view('medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineRequest $request)
    {
        Medicine::create($request->validated());
        return redirect()->route('medicines.index')->with('success', 'Medicamento registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        return redirect()->route('medicines.edit', $medicine);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update($request->validated());
        return redirect()->route('medicines.index')->with('success', 'Medicamento actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicamento eliminado con éxito.');
    }
}
