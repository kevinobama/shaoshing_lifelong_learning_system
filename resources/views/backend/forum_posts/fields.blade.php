<!-- Forum Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('forum_id', '圈子编号:') !!}
    {!! Form::number('forum_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', '用户编号') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('title', '标题:') !!}
    {!! Form::textarea('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', '内容:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.forumPosts.index') !!}" class="btn btn-default">取消</a>
</div>
