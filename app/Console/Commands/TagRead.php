<?php
namespace App\Console\Commands;

use League\CLImate\CLImate;

use Illuminate\Console\Command;

use App\Tag;

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
        
        $this->line("Name: {$tag->name}");
        $this->line("Description: {$tag->description}");
        $this->line("Created at: {$tag->created_at}");
        $this->line("Updated at: {$tag->updated_at}");
    }
}
