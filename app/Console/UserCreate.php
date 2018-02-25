<?php

namespace App\Console\Commands;

use Validator;
use Illuminate\Console\Command;

use App\User;

class UserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--i|interactive}
        {--name=}
        {--email=}
        {--password=}
        {--password_confirmation=}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

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
            $data = [
                'name' => $this->ask('Name?'),
                'email' => $this->ask('Email?'),
                'password' => $this->secret('Password?'),
                'password_confirmation' => $this->secret('Confirm password')
            ];
        } else {
            $data = [
                'name' => $this->option('name'),
                'email' => $this->option('email'),
                'password' => $this->option('password'),
                'password_confirmation' => $this->option('password_confirmation')
            ];
        }

        $validator = Validator::make(
            $data,
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|confirmed'
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $this->error($message);
            }

            exit;
        }

        $data['password'] = bcrypt($data['password']);

        $user = new User;
        $user->fill($data);
        $user->save();

        $this->comment('User created!');
    }
}
