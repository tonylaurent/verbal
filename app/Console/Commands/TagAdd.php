<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Tag;

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
        $inputs = [
            'name' => $this->argument('name'),
            'description' => $this->option('description')
        ];

        $tag = new Tag;
        $tag->fill($inputs);
        $tag->save();

        $this->info("Tag “{$tag->name}” added.");
    }
}
