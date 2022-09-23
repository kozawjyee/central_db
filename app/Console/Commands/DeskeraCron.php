<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\DeskeraJobs;

class DeskeraCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:deskeraCron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync process from deskera to onthego system';

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
        DeskeraJobs::dispatch();
        return 0;
    }
}
