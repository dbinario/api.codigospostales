<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
use App\Models\User;

trait CreditosTrait
{
    public static function DescontarCreditos($user, $cantidad)
    {

        //descontamos creditos
        $user = User::find($user);
        $user->creditos = $user->creditos - $cantidad;
        $user->save();


    }

    public static function SumarCreditos($user, $cantidad)
    {
        
        //sumar creditos
        DB::table('users')->where('id', $user->id)->increment('creditos', $cantidad);
        
    }
    
}