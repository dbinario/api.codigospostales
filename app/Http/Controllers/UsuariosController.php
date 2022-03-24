<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use App\Models\Configuraciones;

use App\Http\Resources\ArrayResource;
use App\Http\Resources\ErrorResource;

use App\Traits\CreditosTrait;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    //

    use CreditosTrait;

    public function RegistrarUsuario(Request $request)
    {
        //
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];

        $messages=[
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser valido',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El password es requerido',
            'password.min' => 'El password debe tener al menos 8 caracteres',
        ];

        $data=$request->all();

        $validator = Validator::make($data, $rules,$messages);

        if ($validator->fails()) {

            return new ErrorResource(
                 [
                     'code'=>422, 
                     'validacion'=>$validator->errors() 
                 ]);

        }


        $user=User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'creditos'=>Configuraciones::where('nombre_configuracion','creditos_iniciales')->first()->valor_configuracion,
            'password' => Hash::make($request->input('password')),
        ]);
        

        return new ArrayResource($user);
    
        
    }


    public function AutenticarUsuario(Request $request){
        
        $rules=[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];

        $messages=[
            'email.required' => 'El email es requerido',
            'email.string' => 'El email debe ser una cadena de texto',
            'email.email' => 'El email debe ser un email valido',
            'email.max' => 'El email debe tener como maximo 255 caracteres',
            'password.required' => 'El password es requerido',
            'password.string' => 'El password debe ser una cadena de texto',
            'password.min' => 'El password debe tener como minimo 8 caracteres',
        ];

        $data=$request->all();

        $validator = Validator::make($data, $rules,$messages);

        if ($validator->fails()) {

            return new ErrorResource(
                 [
                     'code'=>422, 
                     'validacion'=>$validator->errors() 
                 ]);

        }

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            $user=User::where('email',$request->input('email'))->firstorFail();

            $user->tokens()->delete();
    
            $token=$user->createToken('token: '.$data['email'])->plainTextToken;

            return new ArrayResource([
                'user'=>$user,
                'token'=>$token
            ]);


        }else{

            return new ErrorResource(   
                    [
                        'code'=>401,
                        'message'=>'El email o el password son incorrectos'
                    ]);

        }

    }

    public function CreditosUsuario(Request $request)
    {
        //localizamos al usuario y regresamos la cantidad de creditos que tiene
        $user = json_decode(User::find($request->user()));

        $creditos = ['creditos' => $user[0]->creditos];

        return new ArrayResource($creditos);
    }


    public function SumarCreditos(Request $request)
    {
        
        $rules=[
            'creditos' => 'required|numeric',
        ];

        $messages=[

            'creditos.required'=>'creditos es requerido'
        ];

        $data=$request->all();

        $validator = Validator::make($data, $rules,$messages);

        if ($validator->fails()) {

            return new ErrorResource(
                 [
                     'code'=>422, 
                     'validacion'=>$validator->errors() 
                 ]);

        }

        CreditosTrait::SumarCreditos($request->user(), $request->creditos);

        return new ArrayResource(['message'=>'Creditos sumados correctamente']);
        
    }


}
