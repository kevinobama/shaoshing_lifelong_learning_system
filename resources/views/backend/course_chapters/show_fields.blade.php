<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $courseChapters->id !!}</p>
</div>

<!-- Course Id Field -->
<div class="form-group">
    {!! Form::label('course_id', 'Course Id:') !!}
    <p>{!! $courseChapters->course_id !!}</p>
</div>

<!-- Chapter Name Field -->
<div class="form-group">
    {!! Form::label('chapter_name', 'Chapter Name:') !!}
    <p>{!! $courseChapters->chapter_name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $courseChapters->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $courseChapters->updated_at !!}</p>
</div>

