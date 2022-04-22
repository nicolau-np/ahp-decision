<?php

use App\Alternativa;
use App\Criterio;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::livewire('/', "home");

Route::group(['prefix' => "criterios"], function () {
    Route::livewire('/list', "criterios.listar");
    Route::livewire('/create-vs/{id_criterio}', "criterios.create-vs");
});

Route::group(['prefix' => "alternativas"], function () {
    Route::livewire('/list', "alternativas.listar");
    Route::livewire('/create-vs/{id_alternativa}', "criterios.alternativa-vs");
});

/*Route::get('/criterios', function () {
    $criterios = Criterio::all();
    return $criterios;
});

Route::get('/alternativas', function () {
    $alternativas = Alternativa::all();
    return $alternativas;
});*/