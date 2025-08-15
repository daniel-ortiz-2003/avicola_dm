<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FlockController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --- Rutas Públicas y para todos los usuarios autenticados ---
// (Asumiendo que se implementará 'auth' middleware de Laravel)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('flocks', FlockController::class);


// --- Rutas Protegidas solo para Administradores ---
Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {

    // Ruta para la gestión de empleados
    // Accedido vía /admin/employees
    // Nombres de ruta como 'admin.employees.index'
    Route::resource('employees', EmployeeController::class);

    // Aquí se pueden añadir otras rutas exclusivas para el administrador
});

use App\Http\Controllers\ReportController;

// --- Rutas de funcionalidades específicas ---
Route::get('sales/{salesOrder}/download-invoice', [SalesOrderController::class, 'downloadInvoice'])->name('sales.downloadInvoice');
Route::get('reports/export-sales', [ReportController::class, 'exportSales'])->name('reports.exportSales');


// Nota: Para que el middleware 'role:admin' funcione, debe registrarse en app/Http/Kernel.php
// 'role' => \App\Http\Middleware\CheckRole::class,
