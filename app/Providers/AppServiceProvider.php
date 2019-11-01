<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\BlogPostObserver;
use App\Observers\BlogCategoryObserver;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BlogPost::observe(BlogPostObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
    }
}
