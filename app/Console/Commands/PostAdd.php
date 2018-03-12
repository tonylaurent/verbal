<?php
namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use League\CommonMark\Converter;

use App\Tag;
use App\Post;

class PostAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:add
        {title : The title of the post}
        {--summary= : The summary of the post}
        {--content= : The content of the post}
        {--content-file= : The path of the content file}
        {--image= : The path of the image file}
        {--tag=* : The tag of the post}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new post';

    /** @var League\CommonMark\Converter $convert The converter instance. */
    private $converter;

    /**
     * Create a new command instance.
     *
     * @param League\CommonMark\Converter $convert The converter instance.
     *
     * @return void
     */
    public function __construct(Converter $converter)
    {
        parent::__construct();

        $this->converter = $converter;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $inputs = [
            'title' => $this->argument('title'),
            'summary' => $this->option('summary'),
            'image' => $this->option('image')
        ];

        if ($contentString = $this->option('content')) {
            $content = $contentString;
        } elseif ($contentFile = $this->option('content-file')) {
            $content = file_get_contents($contentFile);
        }

        if ($content) {
            $inputs['content'] = $this
                ->converter
                ->convertToHtml($content);
        }

        $tags = Tag::whereIn('name', $this->option('tag'))->get();

        if ($inputs['image']) {
            $inputs['image_path'] = Storage::disk('public')
                ->putFile(null, new File($inputs['image']));
        }

        $post = new Post;
        $post->fill($inputs);
        $post->save();

        $post
            ->tags()
            ->attach($tags);

        $this->info("Post “{$post->title}” added.");
    }
}
