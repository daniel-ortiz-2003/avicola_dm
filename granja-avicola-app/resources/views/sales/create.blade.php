@extends('layouts.app')

@section('content')
    <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">Crear Nueva Orden de Venta</h2>

    <div class="card">
        @if(session('error'))
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            {{-- Detalles de la Orden --}}
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label for="customer_id" style="display: block; margin-bottom: 0.5rem;">Cliente</label>
                    <select id="customer_id" name="customer_id" required style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                        <option value="">Seleccione un cliente</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="order_date" style="display: block; margin-bottom: 0.5rem;">Fecha de la Orden</label>
                    <input type="date" id="order_date" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                </div>
                 <div style="grid-column: span 2;">
                    <label for="notes" style="display: block; margin-bottom: 0.5rem;">Notas Adicionales</label>
                    <textarea id="notes" name="notes" rows="2" style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">{{ old('notes') }}</textarea>
                </div>
                 <input type="hidden" name="status" value="pending">
            </div>

            {{-- Items de la Orden --}}
            <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem;">Artículos de la Venta</h3>
            <div id="sale-items-container">
                {{-- Las filas de artículos se añadirán aquí con JS --}}
            </div>
            <button type="button" id="add-item-btn" style="margin-top: 1rem; background-color: #10b981; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">
                + Añadir Artículo
            </button>

            <div style="margin-top: 2rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem; text-align: right;">
                <a href="{{ route('sales.index') }}" style="color: #4b5563; text-decoration: none; margin-right: 1rem;">Cancelar</a>
                <button type="submit" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">Guardar Venta</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('sale-items-container');
        const addItemBtn = document.getElementById('add-item-btn');
        let itemIndex = 0;

        function createItemRow() {
            const itemRow = document.createElement('div');
            itemRow.classList.add('sale-item-row');
            itemRow.style.cssText = 'display: grid; grid-template-columns: 3fr 1fr 1fr 1fr auto; gap: 1rem; align-items: center; margin-bottom: 1rem;';

            itemRow.innerHTML = `
                <input type="text" name="items[${itemIndex}][product_name]" placeholder="Nombre del Producto" required style="padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                <input type="number" name="items[${itemIndex}][quantity]" placeholder="Cantidad" min="1" required style="padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                <input type="number" name="items[${itemIndex}][unit_price]" placeholder="Precio Unit." step="0.01" min="0" required style="padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                <input type="text" placeholder="Total" readonly style="padding: 0.5rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                <button type="button" class="remove-item-btn" style="background-color: #ef4444; color: white; border: none; cursor: pointer; padding: 0.5rem; border-radius: 0.375rem;">X</button>
            `;

            container.appendChild(itemRow);
            itemIndex++;
        }

        addItemBtn.addEventListener('click', createItemRow);

        container.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-item-btn')) {
                e.target.closest('.sale-item-row').remove();
            }
        });

        // Crear una fila inicial
        createItemRow();
    });
</script>
@endpush
