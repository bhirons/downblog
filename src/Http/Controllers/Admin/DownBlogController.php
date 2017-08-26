<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use bhirons\DownBlog\Article;
//use Session;

class DownBlogController
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
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

        return view('downblog::admin.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $authors = User::authors()->select('id', 'name')->get();

        return view('downblog::admin.create')
            ->with('authors', $authors->mapWithKeys( function($item) {
                return [$item['id'] => $item['name']];
            }));
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|string',
            'subtitle' => 'string|nullable|max:255',
            'blurb' => 'string|nullable|max:1000',
            'user_id' => 'required|numeric',
            'published_on' => 'required|date',
        ]);
        $requestData = $request->all();

        //dd($requestData);

        $requestData['slug'] = $this->slugify($requestData['title']);
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
        $post = Article::where('slug', '=', $slug)->firstOrFail();

        return view('downblog::admin.show', compact('post'));
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
        $post = Article::where('slug', '=', $slug)->with('author')->firstOrFail();

        $authors = User::authors()->select('id', 'name')->get();

        return view('downblog::admin.edit')
            ->with('article', $post)
            ->with('authors', $authors->mapWithKeys( function($item) {
                return [$item['id'] => $item['name']];
            }));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $slug
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($slug, Request $request)
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

        $post = Article::where('slug', '=', $slug)->firstOrFail();

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
    public function destroy($slug)
    {
        Article::where('slug', '=', $slug)->delete();

        //Session::flash('alert-info', 'Article deleted!');

        return redirect('downblog::admin.index');
    }

    /*
     * helpers
     *
     */
    private function slugify($words) {
        return snake_case(preg_replace("#[[:punct:]]#", "", ucwords($words)));
    }
}
