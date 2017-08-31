<?php

/*
 * the middleware is fine here, and it forces a login, who on earth would allow a guest to manage data, know what I mean?
 *
 * I kind of wanted to have the package make it an easy option to restrict reading based on login,
 *  but that isnt quite what I thought, see below
 *
 */
Route::group([
    'prefix' => config('downblog.admin_route_prefix'),
    'namespace' => 'Bhirons\DownBlog\Http\Controllers\Admin',
    'middleware' => ['web'],
    ],function () {
        Route::get('/', 'DownBlogController@index')
            ->name('downblog.admin.index');
            //->middleware('can:view,\Bhirons\DownBlog\Article');

        Route::get('/create', 'DownBlogController@create')
            ->name('downblog.admin.create');
            //->middleware('can:create,\Bhirons\DownBlog\Article');

        Route::get('/{slug}', 'DownBlogController@show')
            ->name('downblog.admin.show');
            //->middleware('can:view',\Bhirons\DownBlog\Article::class);

        Route::post('/', 'DownBlogController@store')
            ->name('downblog.admin.store');
            //->middleware('can:create,\Bhirons\DownBlog\Article');

        Route::get('/{slug}/edit', 'DownBlogController@edit')
            ->name('downblog.admin.edit');
            //->middleware('can:update,\Bhirons\DownBlog\Article');

        Route::patch('/{id}', 'DownBlogController@update')
            ->name('downblog.admin.update');
            //->middleware('can:update,\Bhirons\DownBlog\Article');

        Route::delete('/{id}', 'DownBlogController@destroy')
            ->name('downblog.admin.delete');
            //->middleware('can:delete,\Bhirons\DownBlog\Article');
    });

Route::group([
    /*
     * I thought it was useful if the package could allow publi, or guest, access or not, and ontrollable by the consuming app,
     *  but if the user is guest, or null, then this policy method never gets here.
     *
     * if the user is not logged in, i.e. user is null here in the Policy call for "can read", i.e. a guest, then this always fails
     *
     * to get around this, you either have to subclass the AuthServiceProvider
     *  or do some other thing to alter the way Gate resolves the user...
     *
     * ... out of scope for this package, if you want to restrict access to reading posts
     *         then do it at the app level, not the package
     */
    'prefix' => config('downblog.presentation_route_prefix'),
    'namespace' => 'Bhirons\DownBlog\Http\Controllers',
    'middleware' => ['web'],
    //'middleware' => ['can:read,\Bhirons\DownBlog\Article'],  //<-- turn on if you want to restrict articles to logged in users only
    ], function () {
        Route::get('/', 'ArticleController@index')
            ->name('downblog.presentation.index');

        Route::get('/{slug}', 'ArticleController@show')
            ->name('downblog.presentation.show');
    });
