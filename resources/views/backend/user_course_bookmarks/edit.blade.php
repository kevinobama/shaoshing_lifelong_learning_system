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
                   {!! Form::model($userCourseBookmarks, ['route' => ['backend.userCourseBookmarks.update', $userCourseBookmarks->id], 'method' => 'patch']) !!}

                        @include('backend.user_course_bookmarks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection