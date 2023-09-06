<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LongRunningTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:long-running-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando responsavel por executar por um período de tempo longo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i = 0; $i < 300; $i++) {
            Log::channel('app:long-running-task')->info('Iniciando o comando...');
            $this->info('Contador: ' . $i);
            Log::channel('app:long-running-task')->info('Contador: ' . $i);
            sleep(1);
        }
        Log::channel('app:long-running-task')->info('Comando finalizado...');
        $this->info('Comando concluído.');
    }
}
