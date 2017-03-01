<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Priority Field -->
<div class="form-group col-sm-6">
    {!! Form::label('priority', 'Priority:') !!}
    {!! Form::number('priority', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Link Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('image_link', 'Image Link:') !!}
    {!! Form::text('image_link', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Redirect Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('redirect_link', 'Redirect Link:') !!}
    {!! Form::text('redirect_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12">
    {!! Form::label('image_link', '图片:') !!}
    <input name="image_link" type="file" class="form-control" id="cover_image_url" accept = "image/jpeg,image/gif,image/png,image/x-eps">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('block', 'block:') !!}
    {!! Form::text('block', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('module', 'module:') !!}
    {!! Form::text('module', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.advertisements.index') !!}" class="btn btn-default">Cancel</a>
</div>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="{{asset('js/jquery/jquery-2.2.3.min.js')}}"></script>
<script>
//            CKEDITOR.replace('content', {
//                toolbarGroups: [
//                    {"name": "basicstyles", "groups": ["basicstyles"]},
//                    {"name": "links", "groups": ["links"]},
//                    {"name": "paragraph", "groups": ["list", "blocks"]},
//                    {"name": "document", "groups": ["mode"]},
//                    {"name": "insert", "groups": ["insert"]},
//                    {"name": "styles", "groups": ["styles"]},
//                    {"name": "about", "groups": ["about"]}
//                ],
//                removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Image'
//            });
</script>
