@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            Course Chapters
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($courseChapters, ['route' => ['backend.courseChapters.update', $courseChapters->id], 'method' => 'patch']) !!}

                        @include('backend.course_chapters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection