<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\TipoMonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Cuenta

Route::get("/ListaCuenta/",[CuentaController::class,'index'])->name('index');
Route::post('/registerCuenta/', [CuentaController::class, 'store'])->name('create');
Route::match(['PUT','PATCH'],"/updateCuenta/{id}",[CuentaController::class,'update'])->name('update');
Route::get("/Cuenta/{id}",[CuentaController::class,'show'])->name('show');
Route::delete("/EliminarCuenta/{id}",[CuentaController::class,'destroy'])->name('destroy');
Route::get("/Saldototal/",[CuentaController::class,'Saldo'])->name('Saldo');

//Categoria

Route::get("/ListaCategoria/",[CategoriaController::class,'index'])->name('index');
Route::post('/registerCategoria/', [CategoriaController::class, 'store'])->name('create');
Route::match(['PUT','PATCH'],"/updateCategoria/{id}",[CategoriaController::class,'update'])->name('update');
Route::get("/Categoria/{id}",[CategoriaController::class,'show'])->name('show');
Route::delete("/EliminarCategoria/{id}",[CategoriaController::class,'destroy'])->name('destroy');

//Movimiento

Route::get("/ListaMovimiento/",[MovimientoController::class,'index'])->name('index');
Route::post('/registerMovimiento/', [MovimientoController::class, 'store'])->name('create');
Route::match(['PUT','PATCH'],"/updateMovimiento/{id}",[MovimientoController::class,'update'])->name('update');
Route::get("/Movimiento/{id}",[MovimientoController::class,'show'])->name('show');
Route::delete("/EliminarMovimiento/{id}",[MovimientoController::class,'destroy'])->name('destroy');

Route::get("/DetalleMovimiento/",[MovimientoController::class,'DetalleMovimiento'])->name('DetalleMovimiento');
Route::post("/DetalleCuenta/",[MovimientoController::class,'DetalleCuenta'])->name('DetalleCuenta');

//TipoMon

Route::get("/ListaTipo/",[TipoMonController::class,'index'])->name('index');
Route::post('/registerListaTipo/', [TipoMonController::class, 'store'])->name('create');
Route::match(['PUT','PATCH'],"/updateListaTipo/{id}",[TipoMonController::class,'update'])->name('update');
Route::get("/ListaTipo/{id}",[TipoMonController::class,'show'])->name('show');
Route::delete("/EliminarListaTipo/{id}",[TipoMonController::class,'destroy'])->name('destroy');
