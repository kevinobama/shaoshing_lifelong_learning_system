<!-- Id Field -->
<div class="form-group">
	{!! Form::label('id', '编号:') !!}
	<p>{!! $message->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
	{!! Form::label('title', '标题:') !!}
	<p>{!! $message->title !!}</p>
</div>

<!-- Content Type Field -->
<div class="form-group">
	{!! Form::label('content_type', '内容类型:') !!}
	<p>{!! $message->content_type !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
	{!! Form::label('content', '内容:') !!}
	<p>{!! $message->content !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
	{!! Form::label('created_at', '创建于:') !!}
	<p>{!! $message->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
	{!! Form::label('updated_at', '更新于:') !!}
	<p>{!! $message->updated_at !!}</p>
</div>

