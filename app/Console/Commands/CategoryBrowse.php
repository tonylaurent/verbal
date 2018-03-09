<?php
namespace App\Console\Commands;

use Validator;

use Illuminate\Http\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Post;
use App\Category;
use App\Events\PostCreatedEvent;
use App\Notifications\PostCreatedNotification;

class CategoryBrowse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:browse
        {--show=* : The columns to show}
        {--hide=* : The columns to hide}
        {--sort= : The column name for sorting}
        {--reverse : Sort in reverse order}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Browse categories';

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

        $headers = [
            '#',
            'Name',
            'Description',
            'Created at',
            'Updated at'
        ];

        $categories = Category::select(
            'id',
            'name',
            'description',
            'created_at',
            'updated_at'
        )
        ->when($sort,
            function ($query) use ($sort) {
                $query->orderBy($sort);
            }
        )
        ->get();

        if ($reverse) {
            $categories = $categories->reverse();
        }

        $this->table($headers, $categories);
    }
}
