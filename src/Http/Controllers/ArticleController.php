<?php

namespace Bhirons\DownBlog\Http\Controllers;

use Illuminate\Http\Request;
use Bhirons\DownBlog\Article;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $articles = Article::published()
                ->where('title', 'LIKE', "%$keyword%")
                ->orWhere('slug', 'LIKE', "%$keyword%")
                ->orWhere('subtitle', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orderBy('published_on', 'ASC')
                ->select('title', 'blurb', 'slug', 'published_on')
                //->with('discussion')
                ->paginate($perPage);
        } else {
            $articles = Article::published()
                ->orderBy('published_on', 'ASC')
                ->select('title', 'blurb', 'slug', 'published_on')
                //->with('discussion')
                ->paginate($perPage);
        }

        //dd($articles);
        return view('downblog::presentation.index')
            ->with('articles', $articles);
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->with('author')
            ->first();

        //dd($post);

        if(!$article) {
            abort(404);
        }

        return view('downblog::presentation.show', compact('article'));
    }
}