<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Models\Configuraciones;

use App\Http\Resources\ArrayResource;
use Illuminate\Support\Facades\Auth;

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
        ],[
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'password.required' => 'El password es requerido',
            'password.min' => 'El password debe tener al menos 8 caracteres',
        ]);

        $user=User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'creditos'=>Configuraciones::where('nombre_configuracion','creditos_iniciales')->first()->valor_configuracion,
            'password' => Hash::make($request->input('password')),
        ]);
        
        return response()->json(['message'=>'Usuario registrado correctamente'],201);
        
    }


    public function AutenticarUsuario(Request $request){
        //

        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ],[
            'email.required' => 'El email es requerido',
            'email.string' => 'El email debe ser una cadena de texto',
            'email.email' => 'El email debe ser un email valido',
            'email.max' => 'El email debe tener como maximo 255 caracteres',
            'password.required' => 'El password es requerido',
            'password.string' => 'El password debe ser una cadena de texto',
            'password.min' => 'El password debe tener como minimo 8 caracteres',
        ]);

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            $user=User::where('email',$request->input('email'))->firstorFail();

            $user->tokens()->delete();
    
            $token=$user->createToken('Laravel Password Grant Client')->plainTextToken;
    
            return response()->json(['user'=>$user,'token'=>$token],200);

        }else{

            return response()->json(['message'=>'El email o el password son incorrectos'],401);
        }

    }

    public function CreditosUsuario(Request $request)
    {
        //localizamos al usuario y regresamos la cantidad de creditos que tiene
        $user = User::find($request->id);

        $creditos = ['creditos' => $user->creditos];

        return new ArrayResource($creditos);
        
    }


}
