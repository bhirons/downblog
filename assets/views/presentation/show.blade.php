@extends(config('downblog.layout_parent'))

@section('content')
        @include('downblog::partials.msg')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <article class="full">
                            <h1>{{ $article->title }}</h1>
                            <h2>{{ $article->subtitle }}</h2>
                            <div class="attribution">
                                {{ $article->author->name }}, {{ $article->published_on->toDayDateTimeString() }}
                            </div>
                            @include('downblog::partials.content')
                        </article>
                    </div>
                </div>
            </div>
        </div>
@endsection
