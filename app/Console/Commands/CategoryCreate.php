<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Validator;

use App\User;
use App\Post;
use App\Category;
use App\Events\PostCreatedEvent;
use App\Notifications\PostCreatedNotification;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class CategoryCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create
        {--i|interactive : Enable interactive mode}
        {--name= : The name of the category}
        {--description= : The description of the category}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a category';

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

        $category = (new Category)
            ->fill($inputs)
            ->save();

        $this->info('Category created!');
    }
}
