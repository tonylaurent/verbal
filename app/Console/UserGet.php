<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;

class UserGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get users';

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
        $headers = [
            '#',
            'Name',
            'Email',
            'Created at',
            'Updated at'
        ];

        $users = User::select(
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'
        )
        ->get();

        $this->table($headers, $users);
    }
}
