@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.msg')

        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <article class="full">
                            <h1>{{ $article->title }}</h1>
                            <h2>{{ $article->subtitle }}</h2>
                            <div class="attribution">
                                {{ $article->author->name }}, {{ $article->published_on->toDayDateTimeString() }}
                                {{--<span class="pull-right"><a href="{{ Forum::route('category.show', $article->discussion->category) }}">discussion</a></span>--}}
                            </div>
                            @include('partials.content')
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
