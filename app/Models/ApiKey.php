<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;

     //se definen las constantes
     const ACTIVA  = 1;
     const DESACTIVADA = 2;
     const BLOQUEADA = 3;

     //campos que se pueden enviar por asignacion masiva
     protected $fillable = [
         'api_key',
         'nombre_api',
         'user_id'
     ];

     //campos protegidos
     protected $guarded = [
         'id',
         'status'
     ];
 

    //relacion uno a muchos con el modelo User

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
