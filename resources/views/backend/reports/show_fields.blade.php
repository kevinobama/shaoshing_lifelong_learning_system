<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $reports->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', '用户 Id:') !!}
    <p>{!! $reports->user_id !!}</p>
</div>

<!-- Forum Id Field -->
<div class="form-group">
    {!! Form::label('forum_id', '圈子 Id:') !!}
    <p>{!! $reports->forum_id !!}</p>
</div>

<!-- Report Id Field -->
<div class="form-group">
    {!! Form::label('report_id', '举报 Id:') !!}
    <p>{!! $reports->report_id !!}</p>
</div>

<!-- Report Module Field -->
<div class="form-group">
    {!! Form::label('report_module', '举报模块:') !!}
    <p>{!! $reports->report_module !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', '举报内容:') !!}
    <p>{!! $reports->content !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', '创建于:') !!}
    <p>{!! $reports->created_at !!}</p>
</div>

