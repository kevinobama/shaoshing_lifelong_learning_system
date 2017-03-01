<!-- Title Field -->
<div class="form-group col-sm-12 col-lg-12">
	{!! Form::label('title', '标题:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- is Banner Field -->
<div class="form-group col-sm-6 col-lg-8">
	<div class="col-sm-2">{!! Form::label('is_banner', '是否图片广告:') !!}</div>
	<div class="col-sm-1">否{!! Form::radio('is_banner', '0', ['class' => 'form-control']) !!}</div>
	<div class="col-sm-1">是{!! Form::radio('is_banner', '1', ['class' => 'form-control']) !!}</div>
</div>

<!-- Type Field -->
<div class="form-group col-sm-6 col-lg-12" style="display: none;">
    {!! Form::label('type', '类型:') !!}
    {!! Form::select('type', $types, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6 col-lg-12">
	{!! Form::label('banner', '广告图片:') !!}
	{!! Form::file('banner', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Type Field -->
<div class="form-group col-sm-6 col-lg-12">
    {!! Form::label('content_type', '内容类型:') !!}
    {!! Form::select('content_type', ['url' => '链接', 'text' => '纯文本', 'html' => 'HTML网页'], ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
	{!! Form::label('content', '内容:') !!} <span id="note" style="display: none;">若需图片上传，请直接拖放图片文件到编辑框。</span>
	{!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
	{!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
	<a href="{!! route('backend.messages.index') !!}" class="btn btn-default">取消</a>
</div>
<script src="/ckeditor/ckeditor.js"></script>
<script>
    $('#content_type').on('change', function ()
    {
        if (this.value == 'html') {
            CKEDITOR.replace('content', {
                height: 500,
                language: 'zh-cn',
                extraPlugins: 'uploadimage,image2',
                imageUploadUrl: '/backend/messages/upload',
                toolbarGroups: [
                    {"name": "basicstyles", "groups": ["basicstyles"]},
                    {"name": "links", "groups": ["links"]},
                    {"name": "paragraph", "groups": ["list", "blocks"]},
                    {"name": "document", "groups": ["mode"]},
                    {"name": "insert", "groups": ["insert"]},
                    {"name": "styles", "groups": ["styles"]},
                    {"name": "about", "groups": ["about"]}
                ],
                removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Image,Save,Iframe,Flash,Print'
            });
			$('#note').show();
        } else {
            if (CKEDITOR.instances.content) CKEDITOR.instances.content.destroy();
            $('#note').hide();
        }
    });
    $('[name="is_banner"]').on('change', function ()
    {
	    if (parseInt(this.value) === 1) {
            $('#type').attr('disabled', 'disabled').parent().hide();
			$('#banner').removeAttr('disabled').parent().show();
	    } else {
            $('#banner').attr('disabled', 'disabled').parent().hide();
            $('#type').removeAttr('disabled').parent().show();
	    }
    });
</script>
