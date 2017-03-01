<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $forumBulletins->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $forumBulletins->title !!}</p>
</div>

<!-- Forum Id Field -->
<div class="form-group">
    {!! Form::label('forum_id', 'Forum Id:') !!}
    <p>{!! $forumBulletins->forum_id !!}</p>
</div>

<!-- Forum Name Field -->
<div class="form-group">
    {!! Form::label('forum_name', 'Forum Name:') !!}
    <p>{!! $forumBulletins->forum_name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $forumBulletins->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $forumBulletins->updated_at !!}</p>
</div>

