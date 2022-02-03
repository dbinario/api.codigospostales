<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuraciones;

class ConfiguracionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $Configuraciones=new Configuraciones();

        // Creditos Iniciales
        $Configuraciones->nombre_configuracion='creditos_iniciales';
        $Configuraciones->valor_configuracion='500';
        $Configuraciones->save();

    }
}
