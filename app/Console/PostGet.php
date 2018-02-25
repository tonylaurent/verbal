<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Post;

class PostGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:get {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get posts';

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
        if ($this->argument('email')) {
            $user = User::where('email', $this->argument('email'))->first();
        } else {
            $user = null;
        }

        $headers = [
            '#',
            'Title',
            'Created at',
            'Updated at'
        ];

        $posts = Post::select(
            'id',
            'title',
            'created_at',
            'updated_at'
        )
        ->when($user, function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->get();

        $this->table($headers, $posts);
    }
}
