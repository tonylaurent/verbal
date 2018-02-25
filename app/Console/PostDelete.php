<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Post;

class PostDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a post';

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
        $posts = Post::all()
            ->pluck('title')
            ->toArray();

        $selectedPost = $this->anticipate('What is the name of the post?', $posts);

        if ($this->confirm('Are you sure to delete?')) {
            $post = Post::where('title', $selectedPost)->first();
            $post->delete();

            $this->info('Post delete!');
        }
    }
}
