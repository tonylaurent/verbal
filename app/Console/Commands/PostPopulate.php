<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\PopulatePostJob;

class PostPopulate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate posts';

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
        PopulatePostJob::dispatch();
    }
}
