<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use App\Models\Customer;
use App\Http\Requests\StoreSalesOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesOrders = SalesOrder::with('customer')->latest()->paginate(15);
        return view('sales.index', compact('salesOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::where('is_active', true)->orderBy('name')->get();
        return view('sales.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesOrderRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated, $request) {
                $totalAmount = 0;
                foreach ($validated['items'] as $item) {
                    $totalAmount += $item['quantity'] * $item['unit_price'];
                }

                $salesOrder = SalesOrder::create([
                    'customer_id' => $validated['customer_id'],
                    'user_id' => auth()->id(),
                    'order_date' => $validated['order_date'],
                    'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                    'total_amount' => $totalAmount,
                    'status' => $validated['status'],
                    'notes' => $validated['notes'],
                ]);

                foreach ($validated['items'] as $item) {
                    $salesOrder->items()->create([
                        'product_name' => $item['product_name'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'total_price' => $item['quantity'] * $item['unit_price'],
                    ]);
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear la orden de venta: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('sales.index')->with('success', 'Orden de venta creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesOrder $salesOrder)
    {
        $salesOrder->load('customer', 'user', 'items');
        return view('sales.show', compact('salesOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesOrder $salesOrder)
    {
        // Generalmente las órdenes no se editan, se cancelan y se crean nuevas.
        // Se puede implementar si el negocio lo requiere.
        return response('Vista de edición de venta pendiente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        // Lógica de actualización
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesOrder $salesOrder)
    {
        // Lógica de cancelación/eliminación
    }

    /**
     * Generate and download a PDF invoice for the sales order.
     */
    public function downloadInvoice(SalesOrder $salesOrder)
    {
        // Cargar todas las relaciones necesarias para la factura
        $salesOrder->load('customer', 'user', 'items');

        // Simulación de la generación de PDF con una librería como laravel-dompdf
        // En un proyecto real, se instalaría con `composer require barryvdh/laravel-dompdf`
        // y el código sería algo así:
        /*
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('sales.invoice_pdf', compact('salesOrder'));
        return $pdf->download('invoice-' . $salesOrder->order_number . '.pdf');
        */

        // Para este ejemplo, simplemente mostraremos la vista de la factura
        return view('sales.invoice_pdf', compact('salesOrder'));
    }
}
