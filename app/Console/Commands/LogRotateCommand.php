<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class LogRotateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = glob(storage_path('logs/laravel-*.log'));

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        $date = Carbon::now()->format('Y-m-d');
        $path = storage_path("logs/laravel-{$date}.log");

        if (!file_exists($path)) {
            touch($path);
        }
    }
}
