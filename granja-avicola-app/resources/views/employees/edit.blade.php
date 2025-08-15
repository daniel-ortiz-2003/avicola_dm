@extends('layouts.app')

@section('content')
    <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">Editar Empleado: {{ $employee->name }}</h2>

    <div class="card">
        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                <strong>¡Ups! Hubo algunos problemas con tu entrada.</strong>
                <ul style="margin-top: 0.5rem; list-style-type: disc; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.employees.update', $employee) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                <div>
                    <label for="name" style="display: block; margin-bottom: 0.5rem;">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $employee->name) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                </div>
                <div>
                    <label for="email" style="display: block; margin-bottom: 0.5rem;">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                </div>
                <div>
                    <label for="password" style="display: block; margin-bottom: 0.5rem;">Nueva Contraseña (opcional)</label>
                    <input type="password" id="password" name="password" style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                </div>
                <div>
                    <label for="role" style="display: block; margin-bottom: 0.5rem;">Rol</label>
                    <select id="role" name="role" required style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                        <option value="operario" @selected(old('role', $employee->role) == 'operario')>Operario</option>
                        <option value="admin" @selected(old('role', $employee->role) == 'admin')>Administrador</option>
                    </select>
                </div>
            </div>
            <div style="margin-top: 1.5rem; text-align: right;">
                <a href="{{ route('admin.employees.index') }}" style="color: #4b5563; text-decoration: none; margin-right: 1rem;">Cancelar</a>
                <button type="submit" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">Actualizar Empleado</button>
            </div>
        </form>
    </div>
@endsection
