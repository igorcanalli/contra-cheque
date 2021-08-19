<?php

use App\Http\Controllers\FuncionarioController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('funcionario/{id}/show',  [App\Http\Controllers\FuncionarioController::class, 'show'])->name('funcionario.show'); 

Route::post('funcionario/store', [App\Http\Controllers\FuncionarioController::class, 'store'])->name('funcionario.store'); 

Route::get('contra-cheque/{funcionario_id}/show', [App\Http\Controllers\ContraChequeController::class, 'show'])->name('contra-cheque.show'); 