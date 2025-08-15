@extends('layouts.app')

@section('content')
    <a href="{{ route('flocks.index') }}" style="color: #4b5563; text-decoration: none; margin-bottom: 1rem; display: inline-block;">&larr; Volver al listado de lotes</a>
    <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">Detalles del Lote: {{ $flock->name }}</h2>

    {{-- Información General --}}
    <div class="card" style="margin-bottom: 1.5rem;">
        <h3 class="card-title">Información General</h3>
        <div style="margin-top: 1rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <p><strong>Galpón:</strong> {{ $flock->shed->name }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($flock->type) }}</p>
            <p><strong>Fecha de Ingreso:</strong> {{ \Carbon\Carbon::parse($flock->entry_date)->format('d/m/Y') }}</p>
            <p><strong>Aves Iniciales:</strong> {{ number_format($flock->initial_bird_count) }}</p>
            <p><strong>Aves Actuales:</strong> {{ number_format($flock->current_bird_count) }}</p>
            <p><strong>Estado:</strong> <span style="background-color: #dbeafe; color: #1e40af; padding: 0.25rem 0.5rem; border-radius: 9999px;">{{ ucfirst($flock->status) }}</span></p>
        </div>
    </div>

    {{-- Registros Diarios --}}
    <div class="card" style="margin-bottom: 1.5rem;">
        <h3 class="card-title">Registros Diarios</h3>
        <table style="width: 100%; margin-top: 1rem;">
            <thead>
                <tr>
                    <th style="text-align: left; padding-bottom: 0.5rem;">Fecha</th>
                    <th style="text-align: left; padding-bottom: 0.5rem;">Mortalidad</th>
                    <th style="text-align: left; padding-bottom: 0.5rem;">Peso Promedio (gr)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($flock->dailyRecords->sortByDesc('record_date') as $record)
                    <tr style="border-top: 1px solid #e5e7eb;">
                        <td style="padding: 0.5rem 0;">{{ \Carbon\Carbon::parse($record->record_date)->format('d/m/Y') }}</td>
                        <td style="padding: 0.5rem 0;">{{ $record->mortality_count }}</td>
                        <td style="padding: 0.5rem 0;">{{ $record->average_weight_gr }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="padding-top: 1rem;">No hay registros diarios.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Producción de Huevos (si aplica) --}}
    @if($flock->type === 'ponedoras')
    <div class="card">
        <h3 class="card-title">Producción de Huevos</h3>
        {{-- Aquí iría la tabla de producción de huevos --}}
    </div>
    @endif
@endsection
