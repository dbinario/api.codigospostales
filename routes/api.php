<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodigosPostalesController;


Route::get('/', function () {
    return 'hola';
});


Route::post('codigo_postal', [CodigosPostalesController::class,'BuscarCodigoPostal'])->name('codigo_postal');