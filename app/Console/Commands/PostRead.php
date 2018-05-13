<?php
namespace App\Console\Commands;

use League\CLImate\CLImate;

use Illuminate\Console\Command;

use App\Post;

class PostRead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:read
        {id : The ID of the post}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read an existing post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CLImate $climate)
    {
        parent::__construct();
        
        $this->climate = $climate;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->argument('id');
        
        $post = Post::find($id);
        
        if (!$post) {
            return $this
                ->climate
                ->red('Post not found.');
        }        

        foreach ($post->toArray() as $name => $value) {
            $this
                ->climate
                ->out("<green>{$name}:</green> {$value}");            
        }
        
        if ($post->tags->count()) {
            $tagNames = $post
                ->tags
                ->pluck('name')
                ->toArray();
            
            $tags = implode(', ', $tagNames);

            $this
                ->climate
                ->out("<green>Tags:</green> {$tags}");  
        }
    }
}
