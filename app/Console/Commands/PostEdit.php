<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use League\CommonMark\Converter;
use League\CLImate\CLImate;

use App\Tag;
use App\Post;

class PostEdit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:edit
        {id : The ID of the post to edit}
        {--title= : Set the post title}
        {--summary= : Set the post summary}
        {--content= : Set the post content}
        {--image= : Set image of the post}
        {--date= : Set the post date}
        {--tag=* : Categorize post with tags}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit an existing post';

    /** @var League\CLImate\CLImate $climate The climate instance. */
    private $climate;

    /**
     * Create a new command instance.
     *
     * @param League\CLImate\CLImate $climate The climate instance.
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
            'title' => $this->option('title'),
            'summary' => $this->option('summary'),
            'content' => $this->option('content'),
            'date' => $this->option('date'),
            'image_path' => $this->option('image'),
            'tags' => $this->option('tag')
        ];
        
        $tags = Tag::whereIn('name', $inputs['tags'])->get();

        $post = new Post;
        $post->fill($inputs);
        $post->save();
        
        $post
            ->tags()
            ->attach($tags);

        $this
            ->climate
            ->json($post);        
    }

    /**
     * Image.
     *
     * @param array $options
     *
     * @return null|string The image path.
     */
    private function image(array $options): ?string
    {
        $path = $options['image-path'];
        
        if (!$path || !file_exists($path)) {
            return null;
        }

        return Storage::disk('public')
            ->putFile(null, new File($path));
    }
}
