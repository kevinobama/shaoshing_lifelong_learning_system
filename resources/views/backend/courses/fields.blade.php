<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Cover Image Field -->
<div class="form-group col-sm-4">
    {!! Form::label('cover_image', '封面图片:') !!}
    {!! Form::file('cover_image', null, ['class' => 'form-control']) !!}
    @if(isset($courses) && $courses->cover_image)
    <a href="{!! $courses->cover_image !!}" target="_blank">
        <img src="{!! $courses->cover_image !!}" style="width: 150px;height: 80px;">
    </a>
    @endif
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-2">
    {!! Form::label('subject_id', '科目:') !!}
    @if (session('subject_id'))
        {!! Form::select('subject_id', $subjects, session('subject_id')) !!}
    @else
        {!! Form::select('subject_id', $subjects, isset($books)? $books->subject_id:null) !!}
    @endif
</div>

<!-- Introduction Field -->
<div class="form-group col-sm-12">
    {!! Form::label('introduction', '介绍:') !!}
    {!! Form::textarea('introduction', null, ['class' => 'form-control']) !!}
</div>

<!-- --------------------------------------------- -->
@if (isset($courseChapters) && $courseChapters)
@foreach($courseChapters as $key=>$courseChapter)
<div class="form-group col-sm-12">
    {!! Form::label('chapter_name', '章名称'.($key+1).':') !!}
    {!! Form::text('chapter_name'.$courseChapter->id, $courseChapter->chapter_name, ['class' => '','size' => 50]) !!}
    @if($key == 0)
    <input class="btn btn-primary" type="button" id="addChapter" size="50" value="＋增加章">
    @endif
</div>
<div class="form-group col-sm-12">
    <div style="padding-left: 50px;"><span style="float: left">节名称: </span>
    <input  name="lesson_name{{$courseChapter->files[0]->id}}" type="text" value="{{ $courseChapter->files[0]->lesson_name }}" size="50" id="lesson_name" style="float: left">
    &nbsp;<input  name="text_lesson_file{{ $key+1 }}1" id="text_lesson_file{{ $key+1 }}1" type="text" value="{{ $courseChapter->files[0]->url }}"   size="50" style="float: left">
    &nbsp;<a href="{{Config::get('shaoshing_lifelong_learning_system.media_host')}}{{$courseChapter->files[0]->url }}" target="_blank">播放</a>
    <input  name="lesson_file{{ $key+1 }}1" id="lesson_file{{ $key+1 }}1" type="file"  onchange="uploadVideo(this)" id="lesson_file"  class="file" style="float: left">
    </div>
</div>
@endforeach
@endif

<!-- add video -->
@while ($count <= 30)
<div id="course{{$count}}" style="display: @if($count >1) none  @endif">
<div class="form-group col-sm-12">
    {!! Form::label('chapter_name', '章名称'.$count.':') !!}
    {!! Form::text('chapter_name[]', null, ['class' => '']) !!}
    @if ($count == 1)
        <input class="btn btn-primary" type="button" id="addChapter" size="50" value="＋增加章">
    @endif
</div>
<div class="form-group col-sm-12">
    <div style="padding-left: 50px;"><span style="float: left">节名称: </span>
        <input  name="lesson_name[]" type="text" value="" id="lesson_name" size="50" style="float: left">
        <input  name="text_lesson_file{{$count}}1" type="text" value=""  id="text_lesson_file{{$count}}1" size="50" style="float: left">
        <input name="lesson_file{{$count}}1" type="file" onchange="uploadVideo(this)" id="lesson_file{{$count}}1"  class="file" style="float: left">
    </div>
</div>
</div>
<?php $count++ ?>
@endwhile


<div id="moreChapters"></div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('menu.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.courses.index') !!}" class="btn btn-default">{{Lang::get('menu.cancel')}}</a>
    {!! Form::hidden('created_at', $createdAt) !!}
    &nbsp;&nbsp;<span id="progressBar" style="color: red"></span>
</div>

<script language="javascript">
    function uploadVideo(videoFile) {
        var form = new FormData();
        form.append("file", videoFile.files[0]);
        form.append("createdAt", '{{$createdAt}}');
        form.append("inputName", videoFile.name);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/backend/courses/upload', true);
        xhr.upload.onprogress = function(e) {
            $("#progressBar").text('');
            if (e.lengthComputable) {
                var percentComplete = Math.floor((e.loaded / e.total) * 100);
                $("#progressBar").text('上传进度:'+percentComplete + '%');
            }
        };
        xhr.onload = function() {
            if (this.status == 200) {
                var response = JSON.parse(this.response);
                var currentInputName= response.inputName;
                $("#text_" + currentInputName).val(response.fileName);
                $("#" + currentInputName).val('');
            } else {
                $("#progressBar").text('上传失败');
            }
        };
        xhr.send(form);
    }

    var lesson_file_count = {{$lesson_file_count}};
    $("#addChapter").on('click', function () {
        console.log(lesson_file_count);

        if(lesson_file_count <=30) {
            $( "#course"+ lesson_file_count).show();
        } else {
            var moreChapters="<div class='form-group col-sm-12'><label for='chapter_name'>章名称"+lesson_file_count+":</label>" +
                    "<input class='' name='chapter_name[]' type='text'></div><div class='form-group col-sm-12'>" +
                    "<div style='padding-left: 50px;'><span style='float: left'>节名称: </span>" +
                    "<input name='lesson_name[]' type='text' value='' id='lesson_name' size='50' style='float: left'>" +
                    "<input name='text_lesson_file"+lesson_file_count+"1' type='text' value='' size='50'  id='text_lesson_file"+lesson_file_count+"1'  style='float: left'>" +
                    "<input name='lesson_file"+lesson_file_count+"1' type='file' onchange='uploadVideo(this)' id='lesson_file"+lesson_file_count+"1'  class='file' style='float: left'>" +
                    "</div></div>";

            $("#moreChapters").html($("#moreChapters").html() + moreChapters);
        }
        lesson_file_count ++;
    });
</script>