<!-- Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::textarea('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Forum Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('forum_id', 'Forum Id:') !!}
    {!! Form::number('forum_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Forum Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('forum_name', 'Forum Name:') !!}
    {!! Form::text('forum_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.forumBulletins.index') !!}" class="btn btn-default">Cancel</a>
</div>
