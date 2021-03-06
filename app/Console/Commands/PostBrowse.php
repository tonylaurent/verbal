<?php
namespace App\Console\Commands;

use App\Post;
use League\CLImate\CLImate;
use Illuminate\Console\Command;

/**
 * Class PostBrowse.
 * 
 * @author Tony Laurent <contact@tony-laurent.com>
 */
class PostBrowse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:browse
        {--show=* : Show the specified column}
        {--hide=* : Hide the specified column}
        {--sort= : Sort by the specified column}
        {--reverse : Reverse sort order}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Browse all posts';
    
    /** @var League\CLImate\CLImate $climate The climate instance. */
    private $climate;    

    /**
     * Create a new command instance.
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
        $sort = $this->option('sort');
        $reverse = $this->option('reverse');
        $show = $this->option('show');
        $hide = $this->option('hide');

        $columns = [
            'id',
            'title',
            'created_at',
            'updated_at'
        ];

        if ($show) {
            $columns = $show;
        }

        if ($hide) {
            $columns = array_diff($columns, $hide);
        }

        if (!$columns) {
            return $this->comment('No column to show.');
        }

        $posts = Post::select($columns)
            ->when($sort,
                function ($query) use ($sort) {
                    $query->orderBy($sort);
                }
            )
            ->get();

        if ($reverse) {
            $posts = $posts->reverse();
        }

        $this->table($columns, $posts);
    }
}
