@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            圈子公告
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'backend.forumBulletins.store']) !!}

                        @include('backend.forum_bulletins.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
