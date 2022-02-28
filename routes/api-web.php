<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controladores 
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ApiKeyController;



//registrar usuario
Route::post('registrar_usuario', [UsuariosController::class,'RegistrarUsuario'])->name('Registrar Usuario');


//autenticar usuario
Route::post('autenticar_usuario', [UsuariosController::class,'AutenticarUsuario'])->name('Autenticar Usuario');

//solicitar api key se requiere token de usuario para consumirlo
Route::post('crear_apikey', [ApiKeyController::class,'GenerarApiKey'])->name('Crear ApiKey')->middleware('auth:sanctum');
