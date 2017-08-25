<?php

namespace bhirons\DownBlog;

use Illuminate\Support\ServiceProvider;

class DownBlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DownBlog::class, function () {
            return new DownBlog();
        });
        $this->app->alias(DownBlog::class, 'down-blog');
    }
}