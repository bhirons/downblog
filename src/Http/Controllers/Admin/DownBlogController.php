<?php

namespace Bhirons\DownBlog\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Bhirons\DownBlog\Article;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//use Session;

/**
 *
 * Class DownBlogController
 * @package Bhirons\DownBlog\Http\Controllers\Admin
 */
class DownBlogController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
     * TODO settle on either slug or id, so I can consider switching to implicit model route binding so the policy application looks more efficient
     *
     * TODO turn on a messaging or notification service, whether flashed alerts or something else
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        //this authorize requires an instance
        $this->authorize('manage', Article::class);

        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $posts = Article::select('id', 'title', 'subtitle', 'blurb', 'slug', 'published_on', 'user_id')
                ->where('title', 'LIKE', "%$keyword%")
                ->orWhere('subtitle', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                //->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orderBy('published_on', 'ASC')
                ->paginate($perPage);
        } else {
            $posts = Article::orderBy('published_on', 'DESC')
                ->orderBy('published_on', 'ASC')
                ->paginate($perPage);
        }

        return view('downblog::admin.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     **
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Article::class);

        return view('downblog::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|string',
            'subtitle' => 'string|nullable|max:255',
            'blurb' => 'string|nullable|max:1000',
            'published_on' => 'required|date',
            //'user_id' => 'required|numeric',
        ]);
        $requestData = $request->all();

        $requestData['slug'] = $this->slugify($requestData['title']);
        $requestData['user_id'] = $request->user()->id;
        $post = Article::create($requestData);

        //Session::flash('alert-info', 'Article '.$post->title.' added!');

        return redirect()->route('downblog.admin.show', ['slug' => $post->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $article = Article::where('slug', '=', $slug)->firstOrFail();

        $this->authorize('view', $article);

        return view('downblog::admin.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string   $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $article = Article::where('slug', '=', $slug)
            ->with('author')
            ->firstOrFail();

        $this->authorize('update', $article);

        return view('downblog::admin.edit')
            ->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|string',
            'subtitle' => 'string|nullable|max:255',
            'blurb' => 'string|nullable|max:1000',
            'user_id' => 'required|numeric',
            'published_on' => 'required|date',
        ]);
        $requestData = $request->all();

        $post = Article::where('id', '=', $id)->firstOrFail();
        $this->authorize('update', $post);

        $requestData['slug'] = $this->slugify($requestData['title']);
        $post->update($requestData);

        //Session::flash('alert-info', 'Article '. $post->title .' updated!');

        return redirect()->route('downblog.admin.show', ['slug' => $post->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string   $slug
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $article = Article::where('id', '=', $id)->firstOrFail();

        $this->authorize('delete', $article);

        $article->delete();

        //Session::flash('alert-info', 'Article deleted!');

        return redirect()->route('downblog.admin.index');
    }

    /*
     * helpers
     *
     */
    private function slugify($words) {
        return snake_case(preg_replace("#[[:punct:]]#", "", ucwords($words)));
    }
}
