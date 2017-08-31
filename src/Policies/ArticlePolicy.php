<?php

namespace Bhirons\DownBlog\Policies;

use Bhirons\DownBlog\Article;

class ArticlePolicy
{
    /**
     * Determine whether the user can read articles.
     *
     * @param  object $user
     * @param  \Bhirons\DownBlog\Article $article
     * @return bool
     */
    public function read($user, Article $article)
    {
        return true;
    }

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

    /**
     * Determine whether the user can view the article.
     *
     * @param  object $user
     * @param  \Bhirons\DownBlog\Article  $article
     * @return bool
     */
    public function view($user, Article $article)
    {
        return true;
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  object $user
     * @return bool
     */
    public function create($user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  object $user
     * @param  \Bhirons\DownBlog\Article  $article
     * @return bool
     */
    public function update($user, Article $article)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  object $user
     * @param  \Bhirons\DownBlog\Article  $article
     * @return bool
     */
    public function delete($user, Article $article)
    {
        return true;
    }
}
