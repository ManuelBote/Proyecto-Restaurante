<?php

use App\Http\Controllers\AlergenoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioRecetaController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\DetalleCarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//USUARIO
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);

//PRODUCTO
Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'store']);
Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::put('/productos/{id}', [ProductoController::class, 'update']);
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
Route::put('/productos/{id}/actualizar-calificacion', [ProductoController::class, 'updateCalificacion']);

//CATEGORIA
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);


//CARRITO
Route::get('/carritos', [CarritoController::class, 'index']);
Route::post('/carritos', [CarritoController::class, 'store']);
Route::get('/carritos/{id}', [CarritoController::class, 'show']);
Route::delete('/carritos/{id}', [CarritoController::class, 'destroy']);
Route::put('/carritos/{id}/actualizar-total', [CarritoController::class, 'updateTotal']);

//DETALLE CARRITO
Route::post('/detalles-carrito', [DetalleCarritoController::class, 'store']);
Route::get('/carritos/{idCarrito}/detalles', [DetalleCarritoController::class, 'show']);
Route::put('/detalles-carrito/{id}', [DetalleCarritoController::class, 'update']);
Route::delete('/detalles-carrito/{id}', [DetalleCarritoController::class, 'destroy']);

//PEDIDO
Route::post('/pedidos', [PedidoController::class, 'store']);
Route::get('/usuarios/{idUsuario}/pedidos', [PedidoController::class, 'show']);

//COMENTARIOS
Route::post('/comentarios', [ComentariosController::class, 'store']);
Route::get('/productos/{idProducto}/comentarios', [ComentariosController::class, 'show']);
Route::put('/comentarios/{id}', [ComentariosController::class, 'update']);

//RECETA
Route::post('/recetas', [RecetaController::class, 'store']);
Route::get('/recetas', [RecetaController::class, 'index']);
Route::get('/recetas/{id}', [RecetaController::class, 'show']);
Route::put('/recetas/{id}', [RecetaController::class, 'update']);
Route::delete('/recetas/{id}', [RecetaController::class, 'destroy']);
Route::put('/recetas/{id}/actualizar-calificacion-receta', [RecetaController::class, 'updateCalificacionReceta']);

//ALERGENO
Route::get('/alergenos', [AlergenoController::class, 'index']);
Route::post('/alergenos', [AlergenoController::class, 'store']);
Route::delete('/alergenos/{id}', [AlergenoController::class, 'destroy']);