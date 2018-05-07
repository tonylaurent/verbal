<?php
namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use League\CommonMark\Converter;
use League\CLImate\CLImate;

use Carbon\Carbon;

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
        {title : Set the post title}
        {--summary= : Set the post summary}
        {--content= : Set the post content}
        {--image= : Set the post image}
        {--date= : Set the post date}
        {--tag=* : Categorize post with tags}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new post';

    /** @var League\CLImate\CLImate $climate The climate instance. */
    private $climate;

    /**
     * Create a new command instance.
     *
     * @param League\CLImate\CLImate $climate The climate instance.
     */
    public function __construct(Climate $climate)
    {
        parent::__construct();

        $this->climate = $climate;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $inputs = [
            'title' => $this->argument('title'),
            'summary' => $this->option('summary'),
            'content' => $this->option('content'),
            'date' => $this->option('date'),
            'image' => $this->option('image'),
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
        $path = $options['image'];
        
        if (!$path || !file_exists($path)) {
            return null;
        }

        return Storage::disk('public')
            ->putFile(null, new File($path));
    }
}
