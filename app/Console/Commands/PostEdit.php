<?php
namespace App\Console\Commands;

use Illuminate\{
    Http\File,
    Console\Command,
    Support\Facades\Storage
};

use League\CLImate\CLImate;

use App\{Tag, Post};

/**
 * Class PostEdit.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
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
        $post = Post::find($this->argument('id'));
        
        if (!$post) {
            return $this
                ->climate
                ->error('Post not found.');
        }        
        $options = [
            'title' => $this->option('title'),
            'summary' => $this->option('summary'),
            'content' => $this->option('content'),
            'datetime' => $this->option('datetime'),
            'tags' => $this->option('tag')
        ];
        
        $inputs = array_filter($options, function ($option) {
            return !is_null($option);
        });
        
        if ($imagePath = $this->option('image')) {
            if (!file_exists($imagePath)) {
                $this
                    ->climate
                    ->error('Image not found.');
                
                return null;                
            }
            
            Storage::delete($post->image);
            
            $inputs['image'] = Storage::disk('public')->putFile(
                'posts', 
                new File($imagePath)
            );
        }        
        
        $post->fill($inputs);
        $post->save();
        
        $tags = Tag::whereIn('name', $inputs['tags'])->get();
        
        $post
            ->tags()
            ->syncWithoutDetaching($tags);

        return $this
            ->climate
            ->green('Post updated.');       
    }
}
