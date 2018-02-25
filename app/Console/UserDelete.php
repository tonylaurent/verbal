<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;

class UserDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {--i|interactive}
        {--id=}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a user';

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
        if ($this->option('interactive')) {
            $users = User::get()
                ->pluck('name')
                ->toArray();

            $user = $this->anticipate('Name of the user to delete?', $users);
        } else {
            $user = User::find($this->option('id'));
        }

        if (!$user) {
            $this->error('User not found');

            exit;
        }

        if ($this->confirm("Are you sure to delete “{$user->name} <{$user->email}>”?")) {
            $user->delete();

            $this->comment('User delete!');
        }
    }
}
