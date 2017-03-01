@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            User Course Bookmarks
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('backend.user_course_bookmarks.show_fields')
                    <a href="{!! route('backend.userCourseBookmarks.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
