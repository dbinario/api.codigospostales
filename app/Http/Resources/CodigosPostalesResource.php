<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CodigosPostalesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'codigo_postal' => $this->d_codigo,
            'asentamiento' => $this->d_asenta,
            'tipo_asentamiento' => $this->d_tipo_asenta,
            'municipio' => $this->d_mnpio,
            'estado' => $this->d_estado,
            'ciudad' => $this->d_ciudad,

        ];
    }
}
