<?php

namespace App\Http\Controllers;

use App\Models\Shed;
use App\Models\Flock;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        // --- Recopilación de KPIs ---
        $totalSheds = Shed::count();
        $activeFlocksCount = Flock::where('status', 'activo')->count();
        $totalBirds = Flock::where('status', 'activo')->sum('current_bird_count');

        $viewData = [
            'totalSheds' => $totalSheds,
            'activeFlocksCount' => $activeFlocksCount,
            'totalBirds' => $totalBirds,
        ];

        // --- Datos solo para Administradores ---
        if (auth()->check() && auth()->user()->role === 'admin') {
            $viewData['employeeCount'] = \App\Models\User::count();
        }

        // --- Lógica de Alertas (Ejemplo) ---
        $recentHighMortalityFlocks = Flock::whereHas('dailyRecords', function ($query) {
            $query->where('record_date', '>=', now()->subDay())
                  ->where('mortality_count', '>', 5);
        })->with('shed')->get();

        // --- Datos para el Gráfico (Ejemplo) ---
        $eggProductionData = [
            'labels' => ['Día 1', 'Día 2', 'Día 3', 'Día 4', 'Día 5', 'Día 6', 'Día 7'],
            'data' => [150, 155, 160, 158, 162, 165, 163],
        ];

        $viewData['alerts'] = $recentHighMortalityFlocks;
        $viewData['eggProductionData'] = $eggProductionData;

        return view('dashboard', $viewData);
    }
}
