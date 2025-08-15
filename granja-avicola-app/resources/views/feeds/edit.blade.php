@extends('layouts.app')

@section('content')
    <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">Editar Alimento: {{ $feed->name }}</h2>

    <div class="card">
        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                <strong>¡Ups! Hubo algunos problemas.</strong>
                <ul style="margin-top: 0.5rem; list-style-type: disc; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('feeds.update', $feed) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                <div>
                    <label for="name" style="display: block; margin-bottom: 0.5rem;">Nombre del Alimento</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $feed->name) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                </div>
                 <div>
                    <label for="supplier" style="display: block; margin-bottom: 0.5rem;">Proveedor</label>
                    <input type="text" id="supplier" name="supplier" value="{{ old('supplier', $feed->supplier) }}" style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                </div>
                <div>
                    <label for="stock_kg" style="display: block; margin-bottom: 0.5rem;">Stock Actual (kg)</label>
                    <input type="number" step="0.01" id="stock_kg" name="stock_kg" value="{{ old('stock_kg', $feed->stock_kg) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                </div>
                <div>
                    <label for="unit_price" style="display: block; margin-bottom: 0.5rem;">Precio por Kg</label>
                    <input type="number" step="0.01" id="unit_price" name="unit_price" value="{{ old('unit_price', $feed->unit_price) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                </div>
                 <div>
                    <label for="description" style="display: block; margin-bottom: 0.5rem;">Descripción</label>
                    <textarea id="description" name="description" rows="3" style="width: 100%; padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">{{ old('description', $feed->description) }}</textarea>
                </div>
            </div>
            <div style="margin-top: 1.5rem; text-align: right;">
                <a href="{{ route('feeds.index') }}" style="color: #4b5563; text-decoration: none; margin-right: 1rem;">Cancelar</a>
                <button type="submit" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">Actualizar Alimento</button>
            </div>
        </form>
    </div>
@endsection
