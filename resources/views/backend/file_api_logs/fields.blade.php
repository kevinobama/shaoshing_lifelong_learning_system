<!-- Log Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('log_content', 'Log Content:') !!}
    {!! Form::textarea('log_content', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.redisApilogs.index') !!}" class="btn btn-default">Cancel</a>
</div>
