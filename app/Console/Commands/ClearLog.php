<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpia el archivo de log de Laravel (laravel.log)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logPath = storage_path('logs/laravel.log');

        if (File::exists($logPath)) {
            File::put($logPath, ''); // Esto sobrescribe el contenido con vacío
            $this->info('✅ Log limpiado correctamente.');
        } else {
            $this->warn('⚠️ No se encontró el archivo de log.');
        }
    }
}
