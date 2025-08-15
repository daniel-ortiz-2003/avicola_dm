@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.25rem; font-weight: 600;">Listado de Lotes</h2>
        <a href="{{ route('flocks.create') }}" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none;">Registrar Nuevo Lote</a>
    </div>

    {{-- Formulario de Búsqueda y Filtro --}}
    <div class="card" style="margin-bottom: 1.5rem;">
        <form action="{{ route('flocks.index') }}" method="GET">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                <input type="text" name="search" placeholder="Buscar por nombre..." value="{{ request('search') }}" style="padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                <select name="type" style="padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                    <option value="">Todos los tipos</option>
                    <option value="engorde" @selected(request('type') == 'engorde')>Engorde</option>
                    <option value="ponedoras" @selected(request('type') == 'ponedoras')>Ponedoras</option>
                    <option value="reproductoras" @selected(request('type') == 'reproductoras')>Reproductoras</option>
                </select>
                <select name="status" style="padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                    <option value="">Todos los estados</option>
                    <option value="activo" @selected(request('status') == 'activo')>Activo</option>
                    <option value="cerrado" @selected(request('status') == 'cerrado')>Cerrado</option>
                </select>
                <button type="submit" style="background-color: #4b5563; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">Filtrar</button>
            </div>
        </form>
    </div>

    <div class="card">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background-color: #f9fafb;">
                <tr>
                    <th style="padding: 0.75rem; text-align: left;">Nombre</th>
                    <th style="padding: 0.75rem; text-align: left;">Galpón</th>
                    <th style="padding: 0.75rem; text-align: left;">Tipo</th>
                    <th style="padding: 0.75rem; text-align: left;">Aves Actuales</th>
                    <th style="padding: 0.75rem; text-align: left;">Estado</th>
                    <th style="padding: 0.75rem; text-align: left;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($flocks as $flock)
                    <tr style="border-top: 1px solid #e5e7eb;">
                        <td style="padding: 0.75rem;">{{ $flock->name }}</td>
                        <td style="padding: 0.75rem;">{{ $flock->shed->name }}</td>
                        <td style="padding: 0.75rem;">{{ ucfirst($flock->type) }}</td>
                        <td style="padding: 0.75rem;">{{ number_format($flock->current_bird_count) }}</td>
                        <td style="padding: 0.75rem;">{{ ucfirst($flock->status) }}</td>
                        <td style="padding: 0.75rem;">
                            <a href="{{ route('flocks.show', $flock) }}" style="color: #2563eb; text-decoration: none;">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 1.5rem;">No se encontraron lotes con los filtros aplicados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 1.5rem;">
            {{ $flocks->links() }}
        </div>
    </div>
@endsection
