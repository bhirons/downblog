@extends(config('downblog.layout_parent'))

@section('content')
        <div class="row">

            <div class="col-md-12">
                @include('downblog::partials.msg')

                <div class="panel panel-default">
                    <div class="panel-heading">Article {{ $article->id }}</div>
                    <div class="panel-body">

                        <a href="{{ route('downblog.admin.index') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <div class="pull-right">
                            {{-- the arg must be an instance of the class, not a string descriptor --}}
                            @can('update', $article)
                                <a href="{{ route('downblog.admin.edit', ['slug' => $article->slug]) }}" title="Edit Article"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                            @endcan
                            @can('delete', $article)
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' =>route('downblog.admin.delete', ['slug' => $article->slug]),
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Article',
                                        'onclick'=>'return confirm("Deleting is reversible but currently requires direct DB access. Confirm delete?")'
                                ))!!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                        <br/>
                        <br/>


                        <div class="col-md-12">
                            <dl>
                                <dt>Label</dt>
                                <dd>{{ $article->title }}</dd>

                                <dt>Subtitle</dt>
                                <dd>{{ $article->subtitle }}&nbsp</dd>

                                <dt>Blurb</dt>
                                <dd>{{ $article->blurb }}&nbsp</dd>

                                <dt>Slug</dt>
                                <dd>{{ $article->slug }}</dd>

                                <dt>Content</dt>
                                <dd>{!! Markdown::convertToHtml($article->content) !!}&nbsp</dd>

                                <dt>Created</dt>
                                <dd>{{ $article->created_at->toFormattedDateString() }}</dd>

                                <dt>Updated</dt>
                                <dd>{{ $article->updated_at->toFormattedDateString() }}</dd>

                                <dt>Published</dt>
                                <dd>{{ $article->published_on->toFormattedDateString() }}</dd>

                                @if($article->deleted_at != null)
                                    <dt>Deleted</dt>
                                    <dd>{{ $article->deleted_at->toFormattedDateString() }}</dd>
                                @endif
                            </dl>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
