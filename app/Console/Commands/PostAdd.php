<?php
namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use League\CommonMark\Converter;
use League\CLImate\CLImate as Climate;

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
        {--content-path= : The path of the content file}
        {--image-path= : The path of the image file}
        {--tag=* : The tag of the post}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new post';

    /** @var League\CLImate\CLImate $climate The climate instance. */
    private $climate;

    /** @var League\CommonMark\Converter $convert The converter instance. */
    private $converter;

    /**
     * Create a new command instance.
     *
     * @param League\CLImate\CLImate $climate The climate instance.
     * @param League\CommonMark\Converter $convert The converter instance.
     *
     * @return void
     */
    public function __construct(Climate $climate, Converter $converter)
    {
        parent::__construct();

        $this->climate = $climate;
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
            'summary' => $this->option('summary')
        ];

        $inputs['content'] = $this->content($this->option());
        $inputs['image-path'] = $this->image($this->option());

        $tags = Tag::whereIn('name', $this->option('tag'))->get();

        $post = new Post;
        $post->fill($inputs);
        $post->save();

        $post
            ->tags()
            ->attach($tags);

        $this
            ->climate
            ->green()
            ->json($post);
    }

    /**
     * Content.
     *
     * @param array $options
     *
     * @return null|string The processed content.
     */
    private function content(array $options): ?string
    {
        if ($options['content']) {
            $content = $options['content'];
        } elseif ($options['content-path']) {
            $path = $options['content-path'];
            
            if (file_exists($path)) {
                $content = file_get_contents($path);
            } else {
                $content = null;
            }
        } else {
            $content = null;
        }

        if ($content) {
            $content = $this
                ->converter
                ->convertToHtml($content);
        }

        return $content;
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
