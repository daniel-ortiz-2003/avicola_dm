@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.25rem; font-weight: 600;">Gestión de Empleados</h2>
        <a href="{{ route('admin.employees.create') }}" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none;">
            + Nuevo Empleado
        </a>
    </div>

    {{-- Mostrar mensajes de éxito --}}
    @if (session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <th style="padding: 0.75rem; text-align: left;">Nombre</th>
                    <th style="padding: 0.75rem; text-align: left;">Email</th>
                    <th style="padding: 0.75rem; text-align: left;">Rol</th>
                    <th style="padding: 0.75rem; text-align: left;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 0.75rem;">{{ $employee->name }}</td>
                        <td style="padding: 0.75rem;">{{ $employee->email }}</td>
                        <td style="padding: 0.75rem;">{{ ucfirst($employee->role) }}</td>
                        <td style="padding: 0.75rem;">
                            <a href="{{ route('admin.employees.edit', $employee) }}" style="color: #2563eb; text-decoration: none;">Editar</a>
                            {{-- Formulario para eliminar --}}
                            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" style="display: inline-block; margin-left: 1rem;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a este empleado?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 1.5rem;">No hay empleados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div style="margin-top: 1.5rem;">
            {{ $employees->links() }}
        </div>
    </div>
@endsection
