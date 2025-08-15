@extends('layouts.app')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #e5e7eb; padding-bottom: 1rem;">
            <div>
                <h2 style="font-size: 1.5rem; font-weight: 600;">Orden de Venta #{{ $salesOrder->order_number }}</h2>
                <p>Fecha: {{ $salesOrder->order_date->format('d/m/Y') }}</p>
                <p>Estado: <span style="background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.5rem; border-radius: 9999px;">{{ ucfirst($salesOrder->status) }}</span></p>
            </div>
            <div style="text-align: right;">
                <h3 style="font-size: 1.25rem; font-weight: 600;">GRANJA AVÍCOLA PRO</h3>
                <p>Dirección de la Granja, Ciudad</p>
                <p>Teléfono: 555-1234</p>
            </div>
        </div>

        <div style="padding: 1.5rem 0;">
            <h3 style="font-size: 1.1rem; font-weight: 600;">Cliente</h3>
            <p>{{ $salesOrder->customer->name }}</p>
            <p>{{ $salesOrder->customer->address }}</p>
            <p>{{ $salesOrder->customer->email }}</p>
        </div>

        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background-color: #f9fafb;">
                <tr>
                    <th style="padding: 0.75rem; text-align: left;">Producto</th>
                    <th style="padding: 0.75rem; text-align: center;">Cantidad</th>
                    <th style="padding: 0.75rem; text-align: right;">Precio Unitario</th>
                    <th style="padding: 0.75rem; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesOrder->items as $item)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 0.75rem;">{{ $item->product_name }}</td>
                    <td style="padding: 0.75rem; text-align: center;">{{ $item->quantity }}</td>
                    <td style="padding: 0.75rem; text-align: right;">${{ number_format($item->unit_price, 2) }}</td>
                    <td style="padding: 0.75rem; text-align: right;">${{ number_format($item->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot style="font-weight: 600;">
                <tr>
                    <td colspan="3" style="text-align: right; padding: 0.75rem;">Subtotal</td>
                    <td style="text-align: right; padding: 0.75rem;">${{ number_format($salesOrder->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right; padding: 0.75rem;">Impuestos (0%)</td>
                    <td style="text-align: right; padding: 0.75rem;">$0.00</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right; padding: 1rem; font-size: 1.25rem; border-top: 2px solid #e5e7eb;">Total</td>
                    <td style="text-align: right; padding: 1rem; font-size: 1.25rem; border-top: 2px solid #e5e7eb;">${{ number_format($salesOrder->total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div style="margin-top: 2rem; text-align: right;">
            <a href="{{ route('sales.downloadInvoice', $salesOrder) }}" style="background-color: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none;">Imprimir / Descargar PDF</a>
        </div>
    </div>
@endsection
