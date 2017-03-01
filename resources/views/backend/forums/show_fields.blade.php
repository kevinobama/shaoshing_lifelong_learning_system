<!-- Id Field -->
<div class="form-group">
	{!! Form::label('id', '编号:') !!}
	<p>{!! $forum->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
	{!! Form::label('name', '名称:') !!}
	<p>{!! $forum->name !!}</p>
</div>

<!-- Desc Field -->
<div class="form-group">
	{!! Form::label('desc', '描述:') !!}
	<p>{!! $forum->desc !!}</p>
</div>

<!-- Cover Field -->
<div class="form-group">
	{!! Form::label('cover', '封面:') !!}
	<p>{!! $forum->cover !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
	{!! Form::label('created_at', '创建于:') !!}
	<p>{!! $forum->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
	{!! Form::label('updated_at', '最后更新于:') !!}
	<p>{!! $forum->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
	{!! Form::label('deleted_at', '删除于:') !!}
	<p>{!! $forum->deleted_at !!}</p>
</div>

