<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ContraChequeController;
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

// get funcionario
Route::get('funcionario/{funcionario}/show',  [FuncionarioController::class, 'show'])->name('funcionario.show');

// post funcionario
Route::post('funcionario/store', [FuncionarioController::class, 'store'])->name('funcionario.store'); 

//get contracheque
Route::get('contra-cheque/{funcionario}/show', [ContraChequeController::class, 'show'])->name('contra-cheque.show'); 