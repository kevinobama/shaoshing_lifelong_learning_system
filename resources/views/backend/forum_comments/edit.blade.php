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
                   {!! Form::model($forumComment, ['route' => ['backend.forumComments.update', $forumComment->id], 'method' => 'patch']) !!}

                        @include('backend.forum_comments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
