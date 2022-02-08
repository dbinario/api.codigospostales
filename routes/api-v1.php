<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controladores 
use App\Http\Controllers\CodigosPostalesController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ApiKeyController;


Route::middleware(['api_key'])->group(function () {

//buscar por codigo postal
Route::post('codigo_postal', [CodigosPostalesController::class,'BuscarCodigoPostal'])->name('codigo_postal');

//coincidencia de codigo postal
Route::post('buscar_cp', [CodigosPostalesController::class,'CoincidenciaCodigoPostal'])->name('buscar_cp');
Route::post('cp_municipio', [CodigosPostalesController::class,'CodigosPostalesMunicipio'])->name('cp_municipio');
Route::post('cp_colonia',[CodigosPostalesController::class,'ObtenerColoniasCP'])->name('cp_colonia');          

//obtener cp por estado            
Route::post('cp_estado',[CodigosPostalesController::class,'ObtenerCodigosPostalesEstado'])->name('cp_estado');     

//Busqueda avanzada
Route::post('busqueda_avanzada',[CodigosPostalesController::class,'BusquedaAvanzada'])->name('Busqueda Avanzada');

//obtener estados
Route::post('estados', [EstadosController::class,'ObtenerEstados'])->name('Estados');
//obtener municipios
Route::post('municipios', [EstadosController::class,'ObtenerMunicipios'])->name('Municipios');
//obtener colonias
Route::post('colonias',[CodigosPostalesController::class,'ObtenerColonias'])->name('Colonias');

//regresar creditos
Route::post('creditos_usuario', [UsuariosController::class,'CreditosUsuario'])->name('Creditos Usuario');


});


//registrar usuario
Route::post('registrar_usuario', [UsuariosController::class,'RegistrarUsuario'])->name('Registrar Usuario');


//autenticar usuario
Route::post('autenticar_usuario', [UsuariosController::class,'AutenticarUsuario'])->name('Autenticar Usuario');

//solicitar api key se requiere token de usuario para consumirlo
Route::post('crear_apikey', [ApiKeyController::class,'GenerarApiKey'])->name('Crear ApiKey')->middleware('auth:sanctum');
