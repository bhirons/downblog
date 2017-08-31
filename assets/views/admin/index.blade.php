@extends(config('downblog.layout_parent'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('downblog::partials.msg')

            <div class="panel panel-default">
                <div class="panel-heading">Articles</div>
                <div class="panel-body">
                    @can('create', \Bhirons\DownBlog\Article::class)
                        <a href="{{ route('downblog.admin.create') }}" class="btn btn-success btn-sm"
                           title="Add New Article">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    @endcan

                    {!! Form::open(['method' => 'GET', 'url' => route('downblog.admin.index'), 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    {!! Form::close() !!}

                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Blurb</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $item)
                                <tr>
                                    <td>{!! $item->isUnpublished() ? '<em>' : '' !!}{{ $item->title }}{!! $item->isUnpublished() ? '</em>' : '' !!}</td>
                                    <td>{!! $item->isUnpublished() ? '<em>' : '' !!}{{ $item->subtitle }}{!! $item->isUnpublished() ? '</em>' : '' !!}</td>
                                    <td>{!! $item->isUnpublished() ? '<em>' : '' !!}{{ $item->blurb }}{!! $item->isUnpublished() ? '</em>' : '' !!}</td>
                                    <td>
                                        @can('view', $item)
                                            <a href="{{ route('downblog.admin.show', ['slug' => $item->slug]) }}"
                                               title="View Article">
                                                <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                        @endcan
                                        @can('update', $item)
                                            <a href="{{ route('downblog.admin.edit', ['slug' => $item->slug]) }}"
                                               title="Edit Article">
                                                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                        @endcan
                                        @can('delete', $item)
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => route('downblog.admin.delete', ['id' => $item->id]),
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete Article',
                                                    'onclick'=>'return confirm("Deleting is reversible but currently requires direct DB access. Confirm delete?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $posts->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
