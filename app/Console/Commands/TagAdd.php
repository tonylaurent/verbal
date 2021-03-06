<?php
namespace App\Console\Commands;

use App\Tag;
use League\CLImate\CLImate;
use Illuminate\Console\Command;

/**
 * Class TagAdd.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class TagAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:add
        {name : The name of the tag}
        {--description= : The description of the tag}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new tag';
    
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
        $inputs = [
            'name' => $this->argument('name'),
            'description' => $this->option('description')
        ];

        $tag = new Tag;
        $tag->fill($inputs);
        $tag->save();

        return $this
            ->climate
            ->green('Tag added.');
    }
}
