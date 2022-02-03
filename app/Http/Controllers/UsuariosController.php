<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Models\Configuraciones;

use App\Http\Resources\ArrayResource;

class UsuariosController extends Controller
{
    //

    public function RegistrarUsuario(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user=User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'creditos'=>Configuraciones::where('nombre_configuracion','creditos_iniciales')->first()->valor_configuracion,
            'password' => Hash::make($request->input('password')),
        ]);
        
        $token=$user->createToken('Laravel Password Grant Client')->plainTextToken;
        
        return response()->json(['user'=>$user,'token'=>$token],201);
        
    }

    public function CreditosUsuario(Request $request)
    {
        //localizamos al usuario y regresamos la cantidad de creditos que tiene
        $user = User::find($request->id);

        $creditos = ['creditos' => $user->creditos];

        return new ArrayResource($creditos);
        
    }


}
