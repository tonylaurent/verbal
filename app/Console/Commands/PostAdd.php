<?php
namespace App\Console\Commands;

use Illuminate\{
    Http\File,
    Console\Command,
    Support\Facades\Storage
};

use Validator;
use Carbon\Carbon;
use League\CLImate\CLImate;

use App\{Tag, Post};

/**
 * Class PostAdd.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
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
        {--datetime= : Set the post datetime}
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
            'title' => $this->argument('title'),
            'summary' => $this->option('summary'),
            'content' => $this->option('content'),
            'datetime' => $this->option('datetime'),
            'tags' => $this->option('tag')
        ];

        $validator = Validator::make($inputs, [
            'datetime' => 'nullable|date_format:Y-m-d H:i:s'
        ], [
            'datetime.date_format' => 'The datetime does not match the format yyyy-mm-dd hh:mm:ss.'
        ]);      
        
        if ($validator->fails()) {
           $errors = $validator->errors();
           
            foreach ($errors->all() as $error) {
                $this
                    ->climate
                    ->red($error);
            }
            
            return null;
        }
        
        if ($imagePath = $this->option('image')) {
            if (!file_exists($imagePath)) {
                return $this
                    ->climate
                    ->error('Image not found.');
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

        return $this
            ->climate
            ->green('Post added.');
    }
}
