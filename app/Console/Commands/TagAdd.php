<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Validator;

use App\User;
use App\Post;
use App\Tag;
use App\Events\PostCreatedEvent;
use App\Notifications\PostCreatedNotification;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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
    protected $description = 'Add a tag';

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

        $tag = (new Tag)
            ->fill($inputs)
            ->save();

        $this->info('Tag created!');
    }
}
