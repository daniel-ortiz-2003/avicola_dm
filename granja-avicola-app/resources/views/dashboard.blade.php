@extends('layouts.app')

@section('content')
    <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">Dashboard General</h2>

    {{-- Sección de KPIs --}}
    <div class="grid">
        <div class="card">
            <h3 class="card-title">Galpones Totales</h3>
            <p class="card-metric">{{ $totalSheds }}</p>
        </div>
        <div class="card">
            <h3 class="card-title">Lotes Activos</h3>
            <p class="card-metric">{{ $activeFlocksCount }}</p>
        </div>
        <div class="card">
            <h3 class="card-title">Total de Aves</h3>
            <p class="card-metric">{{ number_format($totalBirds) }}</p>
        </div>
        {{-- KPI solo para Admin --}}
        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="card">
                <h3 class="card-title">Empleados Registrados</h3>
                <p class="card-metric">{{ $employeeCount ?? 'N/A' }}</p> {{-- Suponiendo que pasamos esta variable --}}
            </div>
        @endif
    </div>

    {{-- Sección de Acciones Rápidas (diferenciada por rol) --}}
    @if(auth()->check() && auth()->user()->role === 'admin')
    <div class="card" style="margin-top: 2rem;">
        <h3 class="card-title">Acciones de Administrador</h3>
        <div style="margin-top: 1rem;">
            <a href="{{ route('admin.employees.index') }}" style="background-color: #4b5563; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none;">
                Gestionar Empleados
            </a>
            {{-- Otros enlaces de admin aquí --}}
        </div>
    </div>
    @endif


    {{-- Sección de Alertas --}}
    <div style="margin-top: 2rem;">
        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem;">Alertas Recientes</h3>
        @if(empty($alerts))
            <div class="card">
                <p>✅ No hay alertas importantes en este momento.</p>
            </div>
        @else
            @foreach($alerts as $alertFlock)
                <div class="alert-card" style="margin-bottom: 1rem;">
                    <p class="alert-title">¡Mortalidad Alta Detectada!</p>
                    <p>
                        El lote <strong>{{ $alertFlock->name }}</strong> en el galpón <strong>{{ $alertFlock->shed->name }}</strong> ha registrado una mortalidad elevada.
                    </p>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Sección de Gráficos --}}
    <div class="chart-container card">
        <h3 class="card-title">Producción de Huevos (Últimos 7 Días)</h3>
        <canvas id="eggProductionChart"></canvas>
    </div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('eggProductionChart');
    const eggProductionData = @json($eggProductionData ?? ['labels' => [], 'data' => []]);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: eggProductionData.labels,
            datasets: [{
                label: '# de Huevos',
                data: eggProductionData.data,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
        }
    });
</script>
@endpush
