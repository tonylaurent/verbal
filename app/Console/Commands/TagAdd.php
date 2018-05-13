<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use League\CLImate\CLImate as Climate;

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
    public function __construct(Climate $climate)
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
