<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('subtitle') ? 'has-error' : ''}}">
    {!! Form::label('subtitle', 'Subtitle', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
        {!! $errors->first('subtitle', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('blurb') ? 'has-error' : ''}}">
    {!! Form::label('blurb', 'Blurb', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('blurb', null, ['class' => 'form-control', 'rows' => 4]) !!}
        {!! $errors->first('blurb', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug', 'Slug', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('slug', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'Author', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('user_id', $authors, null, ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('published_on') ? 'has-error' : ''}}">
    {!! Form::label('published_on', 'Publish Date', ['class' => 'col-md-2 control-label', 'required' => 'required']) !!}
    <div class="col-md-10">
        {!! Form::date('published_on', null, ['class' => 'form-control']) !!}
        {!! $errors->first('published_on', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-2 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
