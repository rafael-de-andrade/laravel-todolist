<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ListaController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/lista', [ListaController::class, 'findAll']);
// Route::get('/lista/{lista_selecionada}', [ListaController::class, 'findById']);

Route::prefix('/lista')->group( function(){
    Route::get('/', [ListaController::class, 'findAll']);
    Route::get('/{lista_selecionada}', [ListaController::class, 'findById']);
    Route::post('/store', [ListaController::class, 'store']);
    Route::put('/{id}', [ListaController::class, 'update']);
    Route::delete('/{id}', [ListaController::class, 'destroy']);
});

Route::get('/items/{list_id}', [ItemController::class, 'index']);

Route::prefix('/item')->group( function(){
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});
