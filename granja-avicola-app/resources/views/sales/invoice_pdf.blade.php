<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #{{-- $salesOrder->order_number --}}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        .container { width: 100%; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; padding-bottom: 20px; border-bottom: 2px solid #ccc; }
        .header .company-details { text-align: right; }
        .customer-details { margin-top: 30px; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; }
        thead { background-color: #f2f2f2; }
        tbody tr { border-bottom: 1px solid #eee; }
        .totals { margin-top: 30px; text-align: right; }
        .totals table { width: 300px; float: right; }
        .totals td { text-align: right; }
        .totals .total-row td { font-weight: bold; font-size: 1.2em; border-top: 2px solid #333; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>FACTURA</h1>
                <p><strong>Orden #:</strong> {{-- $salesOrder->order_number --}}000123</p>
                <p><strong>Fecha:</strong> {{-- $salesOrder->order_date->format('d/m/Y') --}}15/08/2025</p>
            </div>
            <div class="company-details">
                <h2>GRANJA AVÍCOLA PRO</h2>
                <p>Dirección de la Granja, Ciudad</p>
                <p>contacto@granjapro.com</p>
            </div>
        </div>

        <div class="customer-details">
            <h3>Facturar a:</h3>
            <p><strong>{{-- $salesOrder->customer->name --}}Cliente Mayorista A</strong></p>
            <p>{{-- $salesOrder->customer->address --}}Dirección del Cliente</p>
            <p>{{-- $salesOrder->customer->email --}}contacto@mayoristaa.com</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th style="text-align: center;">Cantidad</th>
                    <th style="text-align: right;">Precio Unit.</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($salesOrder->items as $item) --}}
                <tr>
                    <td>{{-- $item->product_name --}}Huevos de Primera Calidad (Caja x 360)</td>
                    <td style="text-align: center;">{{-- $item->quantity --}}10</td>
                    <td style="text-align: right;">${{-- number_format($item->unit_price, 2) --}}125.00</td>
                    <td style="text-align: right;">${{-- number_format($item->total_price, 2) --}}1,250.00</td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td>${{-- number_format($salesOrder->total_amount, 2) --}}1,250.00</td>
                </tr>
                <tr class="total-row">
                    <td>TOTAL:</td>
                    <td>${{-- number_format($salesOrder->total_amount, 2) --}}1,250.00</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
