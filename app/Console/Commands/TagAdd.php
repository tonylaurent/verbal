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
        {--i|interactive : Enable interactive mode}
        {--name= : The name of the tag}
        {--description= : The description of the tag}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a tag';

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
        if ($this->option('interactive')) {
            $inputs = [
                'name' => $title = $this->ask('Name?'),
                'description' => $this->ask('Description?')
            ];
        } else {
            $inputs = [
                'name' => $this->option('name'),
                'description' => $this->option('description')
            ];
        }

        $validator = Validator::make(
            $inputs,
            [
                'name' => 'required',
                'description' => 'required',
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $this->error($message);
            }

            exit;
        }

        $tag = (new Tag)
            ->fill($inputs)
            ->save();

        $this->info('Tag created!');
    }
}
