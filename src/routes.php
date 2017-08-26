<?php

Route::prefix(config('downblog.admin_route_prefix'))->group(function () {
    Route::get('posts', 'Admin\PostsController@index')
        ->name('downblog.admin.index');

    Route::get('posts/{slug}', 'Admin\PostsController@show')
        ->name('downblog.admin.show');

    Route::get('posts/{slug}/edit', 'Admin\PostsController@edit')
        ->name('downblog.admin.edit');

    Route::patch('posts/{id}', 'Admin\PostsController@update')
        ->name('downblog.admin.update');

    Route::get('posts/create/{level}', 'Admin\PostsController@create')
        ->name('downblog.admin.create');

    Route::post('posts', 'Admin\PostsController@store')
        ->name('downblog.admin.store');

    Route::delete('posts/{id}', 'Admin\PostsController@destroy')
        ->name('downblog.admin.delete');
});

Route::get('posts', 'PostsController@index')
    ->name('downblog.presentation.index');

Route::get('/post/{slug}', 'PostsController@show')
    ->name('downblog.presentation.show');
