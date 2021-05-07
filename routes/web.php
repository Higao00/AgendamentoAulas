<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::resource('/', HomeController::class)->middleware('auth');

Route::get('/usuarios', function () {
    return view('usuarios');
})->middleware('auth')->name('usuarios');


Route::get('/materias', function () {
    return view('materias');
})->middleware('auth')->name('materias');

Route::get('/horarioAula', function () {
    return view('horarioAulas');
})->middleware('auth')->name('horarioAula');

Route::get('/aulasAlunos', function () {
    return view('alunosAula');
})->middleware('auth')->name('aulasAlunos');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
