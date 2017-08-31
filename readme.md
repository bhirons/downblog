# DownBlog

[![Latest Version on Packagist][ico-version]][link-packagist]
[Software License](LICENSE)

Simple blog article management package to manage blog posts authored in markdown and built to match the default Laravel way of doing things.

This is a simple package, it's sole purpose is to provide a basic article writing mechanism and uses markdown because storing HTML in a DB annoys me.

## Dependencies

This package was developed against and used with Laravel 5.4 applications. Your mileage my vary with other versions.

DownBlog uses the SimpleMDE editor, and the basic views included are setup to work under Bootstrap and use Font-Awesome.

Markdown is rendered using the 
 
### SimpleMDE

This package uses the delightful [SimpleMDE Markdown Editor](https://simplemde.com/) and includes a minified release build. You can publish it from the package (see below) or include it yourself.

Install using npm
``` bash
npm install simplemde --save
```

Add these lines to webpack.mix.js, changing the target path to fit your needs
``` javascript
mix.copy('node_modules/simplemde/dist/simplemde.min.css', 'public/css/simplemde.min.css');
mix.copy('node_modules/simplemde/dist/simplemde.min.js', 'public/js/simplemde.min.js');
```

And build
``` bash
npm run dev
```

### Fonts

This package will use Font Awesome in the included views, but it is not included in this package.  You can always nstall it using npm as SimpleMDE above:

``` bash
npm install font-awesome --save
```
then mix, and build.

See the source for more info : Font Awesome by Dave Gandy - http://fontawesome.io


## Install

Require the package with composer
``` bash
$ composer require bhirons/downblog
```

After updating composer, add the ServiceProvider to the providers array in config/app.php
``` php
Bhirons\DownBlog\DownBlogServiceProvider::class,
```

If you want to use the facade, add this to your facades in app.php:
``` php
'DownBlog' => Bhirons\DownBlog\DownBlogFacade::class,
```

### Things you can publish

Publish the config file to change the referenced User model, route prefixes, etc.

``` bash
php artisan vendor:publish --tag=config
```

Here are other available tags:
 * views  : a set of admin views as well as a basic public index page and a show page
 * public : included js and css assets including the simplemde
 

## Usage

``` php

```

### Authorization

By default, the user may do all the things including managing the articles. To alter this behavior and account for your own roles or whatever your particular setup may be, a regular policy classes is included.

 * ArticlePolicy
 
Override this class with your own App\Policies implementation to integrate authorization.
``` php

namespace App\Policies;

use Bhirons\DownBlog\Article;
use Bhirons\DownBlog\ArticleAdminPolicy;

class ArticleAdminPolicy extends \Bhirons\DownBlog\Policies\AdminArticlePolicy
{
    /**
     * Determine if user can do all the things
     *
     * @param object $user
     * @param \Bhirons\DownBlog\Article $article
     * @return bool
     */
    public function manage($user, Article $article)
    {
        return $this->view($user, $article) ||
            $this->create($user) ||
            $this->update($user, $article) ||
            $this->delete($user, $article);
    }

...
```

And then change the policy value in the published conifg file to list your version;
``` php
'policy' => App\Policies\ArticlePolicy::class,
```
## Roadmap

 * consider handling images or other attachments
 * 

## Change log

Please see [CHANGELOG](changelog.md) for more information on what has changed recently.

## Testing

After checking out this package from github, you may run the included tests by

``` bash
$ vendor/bin/phpunit
```

## Security

If you discover any security related issues, please email buddhironsjr@gmail.com instead of using the issue tracker.

## Credits and Attributions

- [Budd Hirons Jr](https://github.com/bhirons)
- see [SimpleMDE](https://github.com/sparksuite/simplemde-markdown-editor) for source and license

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-packagist]: https://packagist.org/packages/bhirons/DownBlog
[link-travis]: https://travis-ci.org/bhirons/DownBlog
[link-scrutinizer]: https://scrutinizer-ci.com/g/bhirons/DownBlog/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/bhirons/DownBlog
[link-downloads]: https://packagist.org/packages/bhirons/DownBlog
[link-author]: https://github.com/bhirons
[link-contributors]: ../../contributors