<!-- Course Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Id:') !!}
    {!! Form::number('course_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Chapter Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('chapter_name', 'Chapter Name:') !!}
    {!! Form::text('chapter_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.courseChapters.index') !!}" class="btn btn-default">Cancel</a>
</div>
