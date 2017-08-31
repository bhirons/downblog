@extends(config('downblog.layout_parent'))

@section('cssaddons')
    <link href="{{asset('vendor/downblog/css/simplemde.min.css') }}" rel="stylesheet">
@endsection

@section('content')
        <div class="row">
            <div class="col-md-12">
                @include('downblog::partials.msg')

                <div class="panel panel-default">
                    <div class="panel-heading">Create New Article</div>
                    <div class="panel-body">
                        <a href="{{ route('downblog.admin.index') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => route('downblog.admin.store'), 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('downblog::admin.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('jsaddons')
    <script src="{{ asset('vendor/downblog/js/simplemde.min.js') }}"></script>
    <script>
        var simplemde = new SimpleMDE({
            element: $("#content")[0],
            toolbarTips: true,
            promptURLs: true,
            autoDownloadFontAwesome: false
        });
    </script>
@endsection
