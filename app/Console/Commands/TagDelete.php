<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Tag;

class TagDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:delete
        {id : The ID of the tag}
        {--f|force : Skip confirmation}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a tag';

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
        $id = $this->argument('id');

        if (!$this->option('force')) {
            if (!$this->confirm('Are you sure to delete?')) {
                return $this->comment('Tag not deleted.');
            }
        }

        Tag::destroy($id);

        $this->info('Tag delete!');
    }
}