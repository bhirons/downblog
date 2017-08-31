@extends(config('downblog.layout_parent'))

@section('content')
    @include('downblog::partials.msg')

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                {!! Form::open(['method' => 'GET', 'url' => '/articles', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(is_null($articles))
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>nothing to see here...</p>
                    </div>
                </div>
            @else
                @foreach($articles as $article)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <article class="compact">
                                <h1><a href="{{ route('downblog.presentation.show', ['slug' => $article->slug]) }}" style="">{{ $article->title }}</a></h1>
                                <p>{{ $article->blurb }}</p>
                                <div class="attribution pull-right">published on {{ $article->published_on->toDayDateTimeString() }}
                                </div>
                            </article>
                        </div>
                    </div>
                @endforeach
            @endif
            <div>
                <div class="pagination-wrapper"> {!! $articles->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
