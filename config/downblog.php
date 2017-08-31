<?php

//$value = config('downblog.admin_route_prefix');

return [
    'user_model' => \App\User::class,
    'user_name' => 'name',
    'user_id' => 'id',

    'layout_parent' => 'downblog::master',

    'admin_route_prefix' => 'admin/posts',
    'presentation_route_prefix' => 'posts',

    'table_name' => 'downblog_articles',

    'policy' => Bhirons\DownBlog\Policies\ArticlePolicy::class,
];