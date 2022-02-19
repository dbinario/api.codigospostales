<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\SepomexTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ActualizarSepomexCommand extends Command
{
    //el trait de separomex
    use SepomexTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sepomex:actualizar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza la base de datos de sepomex';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Empieza Proceso para actualizar la base de datos de sepomex');
        
        $this->info('Empieza la descarga de la base de datos de sepomex');

        Log::info('Se inicia la descarga de la base de datos de sepomex');

        //descarga la base de datos de sepomex
        
        if(!$this->descargarSepomex())
        {
            $this->error('No se pudo descargar la base de datos de sepomex');
            Log::error('No se pudo descargar la base de datos de sepomex');
            return;
        }

        $this->info('Se termino la descarga de la base de datos de sepomex');
        Log::info('Se descargo la base de datos de sepomex de manera correcta');

        if(!$this->DescomprimirSepomex())
        {
            $this->error('No se pudo descomprimir la base de datos de sepomex');
            Log::error('No se pudo descomprimir la base de datos de sepomex');
            return;
        }

        $this->info('Se descomprimio la base de datos de sepomex de manera correcta');
        Log::info('Se descomprimio la base de datos de sepomex de manera correcta');

        $this->info('Se inicia el proceso de procesar la base de datos de sepomex');
        Log::info('Se inicia el proceso de procesar la base de datos de sepomex');
        
        //verificamos si existe el archivo que buscamos
        if(!Storage::exists('CPdescarga.txt')){
            $this->error('No se encontro el archivo CPdescarga.txt');
            Log::error('No se encontro el archivo CPdescarga.txt');
            return;
        }
        
        //eliminamos la tabla
        $this->info('Se elimina la tabla sepomex');
        Log::info('Se elimina la tabla sepomex');
        DB::table('codigos_postales')->truncate();


        if(!$this->ProcesarSepomex())
        {
            $this->error('No se pudo procesar la base de datos de sepomex');
            Log::error('No se pudo procesar la base de datos de sepomex');
            return;
        }

        $this->info('Se termino el proceso de procesar la base de datos de sepomex');
        Log::info('Se termino el proceso de procesar la base de datos de sepomex');
        
        $this->info('Se termino el proceso de actualizar la base de datos de sepomex');
        Log::info('Se termino el proceso de actualizar la base de datos de sepomex');

        return 0;
    }
}
