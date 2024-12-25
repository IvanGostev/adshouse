<?php

namespace App\Console\Commands;

use App\Models\Language;
use Illuminate\Console\Command;

class StartBD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:bd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            ['English', 'en'],
            ['Русский', 'ru']
        ];
        foreach ($data as $item) {
            Language::firstOrCreate(['title' => $item[0], 'local' => $item[1]]);
        }
    }
}
