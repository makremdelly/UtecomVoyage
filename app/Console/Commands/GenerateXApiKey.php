<?php

namespace App\Console\Commands;

use Hash;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class GenerateXApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:x_api_key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a X_API_KEY for the application';

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
     * @return mixed
     */
    public function handle()
    {
        $key = Hash::make(Str::random(32));
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'PMS_X_API_KEY='.$this->laravel['config']['app.x_api_key'], 'PMS_X_API_KEY='.$key, file_get_contents($path)
            ));
        }
        $this->info('X_API_KEY Generated Successfully');
    }
}
