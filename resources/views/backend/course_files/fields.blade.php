<!-- Course Chapter Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course_chapter_id', 'Course Chapter Id:') !!}
    {!! Form::number('course_chapter_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Lesson Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lesson_name', 'Lesson Name:') !!}
    {!! Form::text('lesson_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
    {!! Form::number('duration', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.courseFiles.index') !!}" class="btn btn-default">Cancel</a>
</div>
