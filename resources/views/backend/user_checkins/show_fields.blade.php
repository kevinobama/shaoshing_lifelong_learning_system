<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $userCheckins->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $userCheckins->user_id !!}</p>
</div>

<!-- Signed Date Time Field -->
<div class="form-group">
    {!! Form::label('signed_date_time', 'Signed Date Time:') !!}
    <p>{!! $userCheckins->signed_date_time !!}</p>
</div>

<!-- Signed Days Field -->
<div class="form-group">
    {!! Form::label('signed_days', 'Signed Days:') !!}
    <p>{!! $userCheckins->signed_days !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $userCheckins->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $userCheckins->updated_at !!}</p>
</div>

