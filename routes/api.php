<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodigosPostalesController;

//buscar por codigo postal
Route::post('codigo_postal', [CodigosPostalesController::class,'BuscarCodigoPostal'])->name('codigo_postal');

//obtener estados
Route::get('estados', [CodigosPostalesController::class,'ObtenerEstados'])->name('estados');