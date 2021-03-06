<?php
namespace App\Console\Commands;

use League\CLImate\CLImate;

use Illuminate\Console\Command;

use App\Tag;

/**
 * Class TagRead.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class TagRead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:read
        {id : The ID of the tag}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read an existing tag';
    
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
        $id = $this->argument('id');

        $tag = Tag::find($id);
        
        if (!$tag) {
            return $this
                ->climate
                ->error('Tag not found.');
        }
        
        foreach ($tag->toArray() as $name => $value) {
            $this
                ->climate
                ->out("<green>{$name}:</green> {$value}");
        }
    }
}
