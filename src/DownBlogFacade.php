<?php
/**
 * Created by PhpStorm.
 * User: buddhironsjr
 * Date: 8/25/17
 * Time: 12:51 PM
 */

namespace bhirons\DownBlog;

use Illuminate\Support\Facades\Facade;

class DownBlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'down-blog';
    }
}