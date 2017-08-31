@extends(config('downblog.layout_parent'))

@section('cssaddons')
    <link href="{{ asset('css/simplemde.min.css') }}" rel="stylesheet">
@endsection

@section('content')
        <div class="row">

            <div class="col-md-12">
                @include('downblog::partials.msg')

                <div class="panel panel-default">
                    <div class="panel-heading">Editing "{{ $article->title }}" ({{ $article->id }})</div>
                    <div class="panel-body">
                        <a href="{{ route('downblog.admin.show', ['slug' => $article->slug]) }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($article, [
                            'method' => 'PATCH',
                            'url' => route('downblog.admin.update', ['id' => $article->id]),
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        {!! Form::hidden('user_id', $article->user_id) !!}

                        @include ('downblog::admin.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('jsaddons')
    <script src="{{ asset('js/simplemde.min.js') }}"></script>
    <script>
        var simplemde = new SimpleMDE({
            element: $("#content")[0],
            toolbarTips: true,
            promptURLs: true,
            autoDownloadFontAwesome: false
        });
    </script>
@endsection
