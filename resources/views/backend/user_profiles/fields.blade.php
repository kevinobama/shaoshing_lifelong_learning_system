<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', '性别:') !!}
    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', '头像:') !!}
    {!! Form::text('avatar', null, ['class' => 'form-control']) !!}
</div>

<!-- Real Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('real_name', '真实姓名:') !!}
    {!! Form::text('real_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Nick Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nick_name', '昵称:') !!}
    {!! Form::text('nick_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Coin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coin', '钱币:') !!}
    {!! Form::number('coin', null, ['class' => 'form-control']) !!}
</div>

<!-- Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', '级别:') !!}
    {!! Form::number('level', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('menu.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.userProfiles.index') !!}" class="btn btn-default">{{Lang::get('menu.cancel')}}</a>
</div>
