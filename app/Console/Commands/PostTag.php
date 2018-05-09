<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\File;
use League\CLImate\CLImate;

use App\Tag;
use App\Post;

use Illuminate\Support\Facades\Storage;

class PostTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:tag
        {id : The ID of the post to tag}
        {--tag=* : The tag’s name to add}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tag an existing post';

    /** @var League\CLImate\CLImate $climate The climate instance. */
    private $climate;

    /**
     * Create a new command instance.
     *
     * @param League\CLImate\CLImate $climate The climate instance.
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
        $postId = $this->argument('id');
        
        $post = Post::with('tags')->find($postId);
        $tags = Tag::whereIn('name', $this->option('tag'))->get();        
        
        $post
            ->tags()
            ->syncWithoutDetaching($tags);
            
        $updatedPost = Post::with('tags')->find($postId);

        $this
            ->climate
            ->json($updatedPost);
    }
}
