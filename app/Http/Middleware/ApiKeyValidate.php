<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Traits\PeticionesTrait;

class ApiKeyValidate
{
    use PeticionesTrait;

    public function handle(Request $request, Closure $next)
    {
        PeticionesTrait::GuardarPeticiones($request);

        return $next($request);
    }
}
