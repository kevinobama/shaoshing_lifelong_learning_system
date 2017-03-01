<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $userProfiles->user_id !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{!! $userProfiles->gender !!}</p>
</div>

<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    <p>{!! $userProfiles->avatar !!}</p>
</div>

<!-- Real Name Field -->
<div class="form-group">
    {!! Form::label('real_name', 'Real Name:') !!}
    <p>{!! $userProfiles->real_name !!}</p>
</div>

<!-- Nick Name Field -->
<div class="form-group">
    {!! Form::label('nick_name', 'Nick Name:') !!}
    <p>{!! $userProfiles->nick_name !!}</p>
</div>

<!-- Coin Field -->
<div class="form-group">
    {!! Form::label('coin', 'Coin:') !!}
    <p>{!! $userProfiles->coin !!}</p>
</div>

<!-- Level Field -->
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    <p>{!! $userProfiles->level !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $userProfiles->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $userProfiles->updated_at !!}</p>
</div>

