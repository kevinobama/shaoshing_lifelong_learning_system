<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Name En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_en', '英文名称:') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control']) !!}
</div>

<!-- Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('position', '位置:') !!}
    {!! Form::number('position', null, ['class' => 'form-control']) !!}
</div>

<!-- Module Field -->
<div class="form-group col-sm-6">
    {!! Form::label('module', '模块:') !!}
    {!! Form::text('module', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('menu.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('subjects.index') !!}" class="btn btn-default">{{Lang::get('menu.cancel')}}</a>
</div>
