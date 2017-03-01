<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Forum Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('forum_id', 'Forum Id:') !!}
    {!! Form::number('forum_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Report Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('report_id', 'Report Id:') !!}
    {!! Form::number('report_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Report Module Field -->
<div class="form-group col-sm-6">
    {!! Form::label('report_module', 'Report Module:') !!}
    {!! Form::text('report_module', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.reports.index') !!}" class="btn btn-default">Cancel</a>
</div>
