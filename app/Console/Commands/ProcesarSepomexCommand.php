<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\SepomexTrait;
use Illuminate\Support\Facades\DB;

class ProcesarSepomexCommand extends Command
{
    use SepomexTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sepomex:procesar';

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
        $this->info('Procesando base de datos de sepomex');
        $this->info('Limpieamos la tabla de sepomex');
        DB::table('codigos_postales')->truncate();
        $this->info('llenamos la base de datos de sepomex');
        $this->ProcesarSepomexTrait();
        return 0;
    }
}
