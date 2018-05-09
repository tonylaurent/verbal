<?php

namespace App\Providers;

use View;
use Schema;

use Illuminate\Support\ServiceProvider;

use App\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('tags')) {
            View::share('tags', Tag::has('posts')->get());
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
