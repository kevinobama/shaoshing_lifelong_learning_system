@extends('layouts.share')

@section('content')
    <div class="col-md-12 text-center" style="padding-top: 158px;">
    <p>
    <img src="/images/appIcon.png" style="width: 20%">
    </p>

    <p style="padding-top: 58px;">
    <img src="/images/share_text.png" style="width: 79%">
    </p>
    <p style="padding-top: 33px;">
    <a href="{{$downloadUrl}}" target="_blank">
    <img src="/images/share_button_normal.png" style="width:55%">
    </a></p>

    </div>
@endsection
