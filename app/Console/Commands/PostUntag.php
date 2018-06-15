<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\File;
use League\CLImate\CLImate;

use App\Tag;
use App\Post;

use Illuminate\Support\Facades\Storage;

/**
 * Class PostUntag.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class PostUntag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:untag
        {id : The ID of the post to tag}
        {--tag=* : The tag’s name to remove}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Untag an existing post';

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
        $post = Post::with('tags')->find($this->argument('id'));
        $tags = Tag::whereIn('name', $this->option('tag'))->get();        
        
        $post
            ->tags()
            ->detach($tags);
            
        $updatedPost = Post::with('tags')->find($post->id);

        $this
            ->climate
            ->json($updatedPost);
    }
}
