<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Tag;

class TagBrowse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:browse
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
    protected $description = 'Browse tags';

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
            'name',
            'description',
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

        $tags = Tag::select($columns)
            ->when($sort,
                function ($query) use ($sort) {
                    $query->orderBy($sort);
                }
            )
            ->get();

        if ($reverse) {
            $tags = $tags->reverse();
        }

        $this->table($columns, $tags);
    }
}
