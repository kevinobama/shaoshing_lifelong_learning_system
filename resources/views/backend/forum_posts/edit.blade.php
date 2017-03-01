@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            帖子
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($forumPost, ['route' => ['backend.forumPosts.update', $forumPost->id], 'method' => 'patch']) !!}

                        @include('backend.forum_posts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
