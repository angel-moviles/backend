<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\TipoProductoController;
use App\Http\Controllers\Api\PresentacionController;
use App\Http\Controllers\Api\LaboratorioController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\VentaController;
use App\Http\Controllers\Api\VentaDetalleController;
use App\Http\Controllers\Api\AuthController;

Route::middleware(['auth:sanctum', 'rol:1'])->apiResource('usuarios', UsuarioController::class);

Route::middleware(['auth:sanctum', 'rol:1,2'])->apiResource('ventas', VentaController::class);

Route::middleware(['auth:sanctum', 'rol:1,3'])->get('/reportes', [ReporteController::class, 'index']);

Route::middleware(['auth:sanctum', 'rol:1,2'])->get('/perfil', function (Request $request) {
    return $request->user()->load('rol');
});
Route::middleware(['auth:sanctum', 'rol:1'])->group(function () {
    Route::apiResource('usuarios', UsuarioController::class);
});
Route::middleware('auth:sanctum')->get('/perfil', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('usuarios', UsuarioController::class);

});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::apiResource('venta-detalles', VentaDetalleController::class);


Route::apiResource('ventas', VentaController::class);

Route::apiResource('productos', ProductoController::class);



Route::apiResource('usuarios', UsuarioController::class);


Route::apiResource('proveedores', ProveedorController::class);


Route::apiResource('laboratorios', LaboratorioController::class);

Route::apiResource('presentaciones', PresentacionController::class);


Route::apiResource('tipos-producto', TipoProductoController::class);

Route::apiResource('roles', RolController::class);

