<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\ODSController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\ProyectoController;

Route::resource('entidades', EntidadController::class);


Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Redireccion sea al inicio
Route::get('/home', function () {
    return redirect()->route('inicio');
});
//Ruta para la funcion de Entidades 
route::resource('entidades',EntidadController::class);
route::resource('ods',ODSController::class);
route::resource('programa',ProgramaController::class);
route::resource('proyecto',ProyectoController::class);


