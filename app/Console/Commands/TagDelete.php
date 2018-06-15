<?php
namespace App\Console\Commands;

use App\Tag;
use League\CLImate\CLImate;
use Illuminate\Console\Command;

/**
 * Class TagDelete.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class TagDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:delete
        {id : The ID of the tag}
        {--force : Skip confirmation}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an existing tag';
    
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
        $tag = Tag::find(
            $this->argument('id')
        );
        
        if (!$tag) {
            return $this
                ->climate
                ->error('Tag not found.');
        }

        if (!$this->option('force')) {
            if (!$this->confirm('Are you sure to delete?')) {
                return $this
                    ->climate
                    ->comment('Tag not deleted.');
            }
        }

        $tag->delete();

        return $this
            ->climate
            ->green('Tag deleted.');
    }
}
