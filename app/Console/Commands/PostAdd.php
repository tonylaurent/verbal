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

use Validator;

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
                $this->error($error);
            }
            
            return;
        }
        
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
