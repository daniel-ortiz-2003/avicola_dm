@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.25rem; font-weight: 600;">Gestión de Ventas</h2>
        <a href="{{ route('sales.create') }}" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none;">
            + Nueva Venta
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
                    <th style="padding: 0.75rem; text-align: left;"># Orden</th>
                    <th style="padding: 0.75rem; text-align: left;">Cliente</th>
                    <th style="padding: 0.75rem; text-align: left;">Fecha</th>
                    <th style="padding: 0.75rem; text-align: left;">Estado</th>
                    <th style="padding: 0.75rem; text-align: left;">Total</th>
                    <th style="padding: 0.75rem; text-align: left;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salesOrders as $order)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 0.75rem;">{{ $order->order_number }}</td>
                        <td style="padding: 0.75rem;">{{ $order->customer->name }}</td>
                        <td style="padding: 0.75rem;">{{ $order->order_date->format('d/m/Y') }}</td>
                        <td style="padding: 0.75rem;"><span style="background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.5rem; border-radius: 9999px;">{{ ucfirst($order->status) }}</span></td>
                        <td style="padding: 0.75rem;">${{ number_format($order->total_amount, 2) }}</td>
                        <td style="padding: 0.75rem;">
                            <a href="{{ route('sales.show', $order) }}" style="color: #2563eb; text-decoration: none;">Ver Detalles</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 1.5rem;">No hay ventas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $salesOrders->links() }}
        </div>
    </div>
@endsection
