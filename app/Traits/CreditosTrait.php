<?php

namespace App\Traits;
use App\Models\User;

trait CreditosTrait
{
    public function DescontarCreditos($user, $cantidad)
    {
        $user = User::find($user);
        $user->creditos = $user->creditos - $cantidad;
        $user->save();
    }
    
}