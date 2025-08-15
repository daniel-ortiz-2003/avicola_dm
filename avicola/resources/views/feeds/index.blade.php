@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.25rem; font-weight: 600;">Gestión de Alimentos</h2>
        <a href="{{ route('feeds.create') }}" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none;">
            + Registrar Alimento
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
                    <th style="padding: 0.75rem; text-align: left;">Proveedor</th>
                    <th style="padding: 0.75rem; text-align: left;">Stock (kg)</th>
                    <th style="padding: 0.75rem; text-align: left;">Precio/kg</th>
                    <th style="padding: 0.75rem; text-align: left;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feeds as $feed)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 0.75rem;">{{ $feed->name }}</td>
                        <td style="padding: 0.75rem;">{{ $feed->supplier ?? 'N/A' }}</td>
                        <td style="padding: 0.75rem;">{{ number_format($feed->stock_kg, 2) }}</td>
                        <td style="padding: 0.75rem;">${{ number_format($feed->unit_price, 2) }}</td>
                        <td style="padding: 0.75rem;">
                            <a href="{{ route('feeds.edit', $feed) }}" style="color: #2563eb; text-decoration: none;">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 1.5rem;">No hay alimentos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $feeds->links() }}
        </div>
    </div>
@endsection
