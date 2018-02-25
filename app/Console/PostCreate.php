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

class PostCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:create
        {--title= : The title of the post}
        {--content= : The content of the post}
        {--category= : The category of the post}
        {--image= : The image of the post}
        {--i|interactive : Enable interactive mode}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a post';

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
            $categories = Category::get()
                ->pluck('name')
                ->toArray();

            $inputs = [
                'title' => $title = $this->ask('Title?'),
                'content' => $this->ask('Content?'),
                'category' => $this->choice('Category?', $categories),
                'image' => $this->ask('Image path?')
            ];
        } else {
            $inputs = [
                'title' => $this->option('title'),
                'content' => $this->option('content'),
                'category' => $this->option('category'),
                'image' => $this->option('image')
            ];
        }

        $validator = Validator::make(
            $inputs,
            [
                'title' => 'required',
                'content' => 'required',
                'category' => 'required'
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $this->error($message);
            }

            exit;
        }

        $categories = Category::where('name', $inputs['category'])->get();

        if ($inputs['image']) {
            $inputs['image_path'] = Storage::disk('public')
                ->putFile(null, new File($inputs['image']));
        }

        $post = new Post;
        $post->fill($inputs);
        $post->save();

        $post
            ->categories()
            ->attach($categories);

        $this->info('Post created!');
    }
}
