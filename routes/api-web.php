<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controladores 
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ApiKeyController;

//registrar usuario
Route::post('registrar_usuario', [UsuariosController::class,'RegistrarUsuario'])->name('Registrar Usuario');

//autenticar usuario para recuperar token
Route::post('autenticar_usuario', [UsuariosController::class,'AutenticarUsuario'])->name('Autenticar Usuario');


//proteger rutas con token de sanctum
Route::middleware(['auth:sanctum'])->group(function () {

//solicitar api key se requiere token de usuario para consumirlo
Route::post('crear_apikey', [ApiKeyController::class,'GenerarApiKey'])->name('Crear ApiKey');

//sumar creditos
Route::post('sumar_creditos',[UsuariosController::class,'SumarCreditos'])->name('Sumar Creditos');

});