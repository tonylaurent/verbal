<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\CLImate\CLImate;

use App\Tag;

/**
 * Class TagEdit.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class TagEdit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:edit
        {id : The ID of the tag}
        {--name= : The name of the tag}
        {--description= : The description of the tag}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit an existing tag';
    
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
                ->comment('Tag not found.');
        }        
        
        $inputs = array_filter($this->option(), function ($input) {
            return $input;
        });
        
        if (!$inputs) {
            return $this
                ->climate
                ->comment('Tag not updated.');
        }          

        $tag->fill($inputs);
        $tag->save();
        
        return $this
            ->climate
            ->green('Tag updated.');   
    }
}
