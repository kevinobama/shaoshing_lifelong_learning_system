@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            圈子公告
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('backend.forum_bulletins.show_fields')
                    <a href="{!! route('backend.forumBulletins.index') !!}" class="btn btn-default">返回</a>
                </div>
            </div>
        </div>
    </div>
@endsection
