<?php

namespace Bhirons\DownBlog\Test;

use DownBlog;

class DownBlogFunctionTest extends TestCase
{
    public function testSaysHello()
    {
        $this->assertSame(DownBlog::helloWorld(), "hello from down blog");
    }
}