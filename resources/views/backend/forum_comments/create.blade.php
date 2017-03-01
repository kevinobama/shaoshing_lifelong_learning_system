@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            回帖
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'backend.forumComments.store']) !!}

                        @include('backend.forum_comments.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
