<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\File;
use League\CommonMark\Converter;
use League\CLImate\CLImate;

use App\Tag;
use App\Post;

use Illuminate\Support\Facades\Storage;

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
        {--datetime= : Set the post datetime}
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
            'datetime' => $this->option('datetime'),
            'tags' => $this->option('tag')
        ];
        
        if ($imagePath = $this->option('image')) {
            if (!file_exists($imagePath)) {
                $this->error('Image not found.');
                
                return;                
            }
            
            $inputs['image'] = Storage::disk('public')->putFile(
                'posts', 
                new File($imagePath)
            );
        }        
        
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
}
