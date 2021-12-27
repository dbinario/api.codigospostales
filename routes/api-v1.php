<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodigosPostalesController;
use App\Http\Controllers\EstadosController;

//buscar por codigo postal
Route::post('codigo_postal', 
            [CodigosPostalesController::class,'BuscarCodigoPostal'])
            ->name('codigo_postal');

            
//coincidencia de codigo postal
Route::post('buscar_cp', 
            [CodigosPostalesController::class,'CoincidenciaCodigoPostal'])
            ->name('buscar_cp');

Route::post('cp_municipio', 
            [CodigosPostalesController::class,'CodigosPostalesMunicipio'])
            ->name('cp_municipio');

Route::post('cp_colonia',
            [CodigosPostalesController::class,'ObtenerColoniasCP'])
            ->name('cp_colonia');            


//obtener estados
Route::get('estados', [EstadosController::class,'ObtenerEstados'])->name('estados');

Route::post('municipios', [EstadosController::class,'ObtenerMunicipios'])->name('municipios');