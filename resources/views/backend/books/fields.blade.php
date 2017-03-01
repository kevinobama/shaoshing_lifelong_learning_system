<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', '电子书名称:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Cover Image Url Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cover_image_url', '封面图片:') !!}
    <input name="cover_image_url" type="file" class="form-control" id="cover_image_url" accept = "image/jpeg,image/gif,image/png,image/x-eps">
</div>

<!-- Author Field -->
<div class="form-group col-sm-12">
    {!! Form::label('author', '作者:') !!}
    {!! Form::text('author', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('subject_id', '科目:') !!}
    @if (session('subject_id'))
        {!! Form::select('subject_id', $subjects, session('subject_id')) !!}
    @else
        {!! Form::select('subject_id', $subjects, isset($books)? $books->subject_id:null) !!}
    @endif
</div>


<!-- Download Url Field -->
<div class="form-group col-sm-12">
    {!! Form::label('download_url', '上传电子书文件:') !!}
    <input name="download_url" type="file" class="form-control" id="download_url" accept = "*">
</div>


{{--<!-- Forum Id Field -->--}}
{{--<div class="form-group col-sm-12">--}}
    {{--{!! Form::label('forum_id', 'Forum Id:') !!}--}}
    {{--{!! Form::number('forum_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('menu.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.books.index') !!}" class="btn btn-default">{{Lang::get('menu.cancel')}}</a>

    {!! Form::hidden('page', isset($page)?$page:null) !!}
</div>
