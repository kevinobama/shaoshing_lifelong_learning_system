@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            User Course Bookmarks
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'backend.userCourseBookmarks.store']) !!}

                        @include('backend.user_course_bookmarks.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
