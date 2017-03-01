<!-- Name Field -->
<div class="form-group col-sm-6">
	{!! Form::label('name', '圈子名称:') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Cover Field -->
<div class="form-group col-sm-12">
	{!! Form::label('cover', '圈子封面:') !!}
	{!! Form::file('cover', null, ['class' => 'form-control']) !!}
</div>

<!-- Desc Field -->
<div class="form-group col-sm-12">
	{!! Form::label('desc', '圈子描述:') !!}
	{!! Form::textarea('desc', null, ['class' => 'form-control', 'maxlength' => 150]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
	{!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
	<a href="{!! route('backend.forums.index') !!}" class="btn btn-default">取消</a>
</div>
