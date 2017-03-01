<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $advertisements->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $advertisements->name !!}</p>
</div>

<!-- Priority Field -->
<div class="form-group">
    {!! Form::label('priority', 'Priority:') !!}
    <p>{!! $advertisements->priority !!}</p>
</div>

<!-- Image Link Field -->
<div class="form-group">
    {!! Form::label('image_link', 'Image Link:') !!}
    <p>{!! $advertisements->image_link !!}</p>
</div>

<!-- Redirect Link Field -->
<div class="form-group">
    {!! Form::label('redirect_link', 'Redirect Link:') !!}
    <p>{!! $advertisements->redirect_link !!}</p>
</div>

<!-- Click Count Field -->
<div class="form-group">
    {!! Form::label('click_count', 'Click Count:') !!}
    <p>{!! $advertisements->click_count !!}</p>
</div>

<!-- Is Active Field -->
<div class="form-group">
    {!! Form::label('is_active', 'Is Active:') !!}
    <p>{!! $advertisements->is_active !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $advertisements->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $advertisements->updated_at !!}</p>
</div>

