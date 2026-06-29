<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CategoriaMaterialController;

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Rutas protegidas
Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('proveedores', ProveedorController::class)
        ->parameters([
            'proveedores' => 'proveedor'
        ]);

    Route::resource('materiales', MaterialController::class)
        ->parameters([
            'materiales' => 'material'
        ]);

    Route::resource('presupuestos', PresupuestoController::class);

    Route::resource(
        'categorias-material',
        CategoriaMaterialController::class
    );

    Route::get(
        'reportes/presupuesto/{id}',
        [ReporteController::class, 'presupuesto']
    )->name('reportes.presupuesto');

    Route::get(
        'reportes/presupuesto/{id}/pdf',
        [ReporteController::class, 'descargarPdf']
    )->name('reportes.presupuesto.pdf');

    Route::get(
        'reportes',
        [ReporteController::class, 'index']
    )->name('reportes.index');

});