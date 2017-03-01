<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $users->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', '名称:') !!}
    <p>{!! $users->name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('创建于', 'Created At:') !!}
    <p>{!! $users->created_at !!}</p>
</div>