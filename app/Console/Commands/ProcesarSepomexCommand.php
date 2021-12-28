<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SepomexController;


class ProcesarSepomexCommand extends Command
{
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
        SepomexController::ProcesarSepomex();
        return 0;
    }
}
