<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:command';

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
     * @return mixed
     */
    public function handle()
    {
        // $question = Reservation::where('created_at', '<',Carbon::parse('-24 hours'))->get()->toArray();
        // dd($question);
        $reservation = DB::table('reservations')
        ->where('created_at', '<',Carbon::parse('-24 hours'))
        ->where('status','En attente')
        ->update(['status' => 'Expirée']);
        $this->info('All En attente reservations are updated successfully!');
    }
}
