<?php

namespace App\Console\Commands;

use App\Http\Controllers\SepomexController;
use App\Traits\SepomexTrait;
use Illuminate\Console\Command;

class DescargarSepomexCommand extends Command
{

    use SepomexTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sepomex:descargar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->info('Descargando base de datos de sepomex');

        //descarga la base de datos de sepomex

        $this->DescargarSepomexTrait();


        $this->info('Base de datos descargada');

        return 0;
    }
}
