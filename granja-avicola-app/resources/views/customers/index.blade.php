@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.25rem; font-weight: 600;">Gestión de Clientes</h2>
        <a href="{{ route('customers.create') }}" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none;">
            + Nuevo Cliente
        </a>
    </div>

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
                    <th style="padding: 0.75rem; text-align: left;">Teléfono</th>
                    <th style="padding: 0.75rem; text-align: left;">Estado</th>
                    <th style="padding: 0.75rem; text-align: left;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 0.75rem;">{{ $customer->name }}</td>
                        <td style="padding: 0.75rem;">{{ $customer->email }}</td>
                        <td style="padding: 0.75rem;">{{ $customer->phone ?? 'N/A' }}</td>
                        <td style="padding: 0.75rem;">
                            @if($customer->is_active)
                                <span style="background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.5rem; border-radius: 9999px;">Activo</span>
                            @else
                                <span style="background-color: #fee2e2; color: #991b1b; padding: 0.25rem 0.5rem; border-radius: 9999px;">Inactivo</span>
                            @endif
                        </td>
                        <td style="padding: 0.75rem;">
                            <a href="{{ route('customers.edit', $customer) }}" style="color: #2563eb; text-decoration: none;">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 1.5rem;">No hay clientes registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $customers->links() }}
        </div>
    </div>
@endsection
