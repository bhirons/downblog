<?php

namespace Bhirons\DownBlog\Test;

use Bhirons\DownBlog\DownBlogFacade;
use Bhirons\DownBlog\DownBlogServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return DownBlogServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [DownBlogServiceProvider::class];
    }

    /**
     * Load package alias
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'DownBlog' => DownBlogFacade::class,
        ];
    }
}