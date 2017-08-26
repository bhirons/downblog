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
        $this->publishes([
            __DIR__.'/../config/downblog.php' => config_path('downblog.php'),
        ],'config');

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        //view('downblog::presentation.show')
        $this->loadViewsFrom(__DIR__.'/../assets/views', 'downblog');

        $this->publishes([
            __DIR__.'/../assets/views' => resource_path('views/vendor/downblog'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../assets/public' => public_path('vendor/downblog'),
        ], 'public');

        //$this->loadTranslationsFrom(__DIR__.'/path/to/translations', 'downblog');
        //
        //$this->publishes([
        //    __DIR__.'/../translations' => resource_path('lang/vendor/downblog'),
        //], 'translations');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/downblog.php', 'downblog'
        );

        $this->app->singleton(DownBlog::class, function () {
            return new DownBlog();
        });
        $this->app->alias(DownBlog::class, 'downblog');

        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\GrahamCampbell\Markdown\MarkdownServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
        $loader->alias('Markdown', \GrahamCampbell\Markdown\Facades\Markdown::class);
    }
}

/*
 * $this->app->register('LucaDegasperi\OAuth2Server\OAuth2ServerServiceProvider');
    /*
     * Create aliases for the dependency.
     *
$loader = \Illuminate\Foundation\AliasLoader::getInstance();
$loader->alias('AuthorizationServer', 'LucaDegasperi\OAuth2Server\Facades\AuthorizationServerFacade');
 */