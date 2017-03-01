
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $courses->name !!}</p>
</div>

<!-- Introduction Field -->
<div class="form-group">
    {!! Form::label('introduction', 'Introduction:') !!}
    <p>{!! $courses->introduction !!}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{!! $courses->type !!}</p>
</div>


<!-- Cover Image Field -->
<div class="form-group">
    {!! Form::label('cover_image', 'Cover Image:') !!}
    <p>
        <a href="{!! $courses->cover_image !!}" target="_blank">
            <img src="{!! $courses->cover_image !!}" style="width: 150px;height: 80px;">
        </a>
    </p>
</div>

<!-- Comment Count Field -->
<div class="form-group">
    {!! Form::label('bookmark_count', 'bookmark  Count:') !!}
    <p>{!! $courses->bookmark_count !!}</p>
</div>

<div class="form-group">
    {!! Form::label('Chapters', 'Chapters:') !!}
    <!-- --------------------------------------------- -->
    @if (isset($courseChapters) && $courseChapters)
    @foreach($courseChapters as $key=>$courseChapter)

    <p>
        {!! Form::label('chapter_name', '章名称'.($key+1).':&nbsp;&nbsp;'.$courseChapter->chapter_name) !!}
    </p>

    <div class="form-group col-sm-12">
        <div style="padding-left: 50px;">
            <span style="float: left">节名称: </span>
            <p>&nbsp;&nbsp;{{ $courseChapter->files[0]->lesson_name }}</p>
            <p>&nbsp;&nbsp;
             <embed src="/flash/mediaplayer.swf?file={{$courseChapter->files[0]->url }}" width="325" height="230" allowfullscreen="true" />
            </p>
            <p>
               <a href="{{$courseChapter->files[0]->url }}" target="_blank">Play</a>
            </p>
        </div>
    </div>
    @endforeach
    @endif
</div>





<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $courses->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $courses->updated_at !!}</p>
</div>

 {{----}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('course_chapters', 'course_chapters:') !!}--}}
    {{--<p>{!! json_encode($courseChapters[0]->chapter_name) !!}</p>--}}
    {{--<p>{!! json_encode($courseChapters) !!}</p>--}}
{{--</div>--}}
