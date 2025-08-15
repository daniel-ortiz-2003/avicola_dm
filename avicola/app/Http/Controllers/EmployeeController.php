<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.employees.index')->with('success', 'Empleado creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $employee)
    {
        return redirect()->route('admin.employees.edit', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $employee)
    {
        // Debería usarse un UpdateEmployeeRequest aquí
        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);
        return redirect()->route('admin.employees.index')->with('success', 'Empleado actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Empleado eliminado con éxito.');
    }
}
