<?php
namespace App\Console\Commands;

use Validator;

use Illuminate\Http\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Post;
use App\Tag;
use App\Events\PostCreatedEvent;
use App\Notifications\PostCreatedNotification;

class TagBrowse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:browse
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

        $headers = [
            '#',
            'Name',
            'Description',
            'Created at',
            'Updated at'
        ];

        $categories = Tag::select(
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
            $tags = $tags->reverse();
        }

        $this->table($headers, $tags);
    }
}
