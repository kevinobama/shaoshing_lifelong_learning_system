<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Signed Date Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('signed_date_time', 'Signed Date Time:') !!}
    {!! Form::number('signed_date_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Signed Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('signed_days', 'Signed Days:') !!}
    {!! Form::number('signed_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.userCheckins.index') !!}" class="btn btn-default">Cancel</a>
</div>
