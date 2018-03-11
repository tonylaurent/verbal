<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Post;

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
