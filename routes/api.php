<?php

use App\Http\Controllers\AlunosAulaController;
use App\Http\Controllers\HorarioAulasController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\PermissaoController;
use App\Http\Controllers\RegistroController;

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

Route::resource('/registro', RegistroController::class);
Route::resource('/materia', MateriasController::class);
Route::resource('/permissao', PermissaoController::class);
Route::resource('/horarioAula', HorarioAulasController::class);
Route::resource('/alunosAula', AlunosAulaController::class);
