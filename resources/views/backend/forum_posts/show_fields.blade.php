<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', '帖子编号:') !!}
    <p>{!! $forumPost->id !!}</p>
</div>

<!-- Forum Id Field -->
<div class="form-group">
    {!! Form::label('forum_id', '圈子编号:') !!}
    <p>{!! $forumPost->forum_id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', '用户编号:') !!}
    <p>{!! $forumPost->user_id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', '标题:') !!}
    <p>{!! $forumPost->title !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', '内容:') !!}
    <p>{!! $forumPost->content !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', '创建于:') !!}
    <p>{!! $forumPost->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', '更新于:') !!}
    <p>{!! $forumPost->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', '删除于:') !!}
    <p>{!! $forumPost->deleted_at !!}</p>
</div>

