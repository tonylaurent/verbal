<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\CLImate\CLImate;

use App\Post;

/**
 * Class PostDelete.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class PostDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:delete
        {id : The ID of the post}
        {--force : Skip confirmation}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a post';
    
    /** @var League\CLImate\CLImate $climate The climate instance. */
    private $climate;    

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
        $post = Post::find(
            $this->argument('id')
        );
        
        if (!$post) {
            return $this
                ->climate
                ->error('Post not found.');
        }

        if (!$this->option('force')) {
            if (!$this->confirm('Are you sure to delete?')) {
                return $this
                    ->climate
                    ->comment('Post not deleted.');
            }
        }

        $post->delete();

        return $this
            ->climate
            ->green('Post deleted.');
    }
}
