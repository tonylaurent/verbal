<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Tag;

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
    protected $description = 'Edit a tag';

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
        $tag = Tag::find(
            $this->argument('id')
        );
        
        if (!$tag) {
            return $this->comment("Tag not found.");
        }        
        
        $inputs = array_filter($this->option(), function ($input) {
            return $input;
        });
        
        if (!$inputs) {
            return $this->comment("Tag “{$tag->name}” not updated.");
        }          

        $tag->fill($inputs);
        $tag->save();

        $this->info("Tag “{$tag->name}” updated.");
    }
}
