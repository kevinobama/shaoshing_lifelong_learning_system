@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            电子书
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($books, ['files' => true,'route' => ['backend.books.update', $books->id], 'method' => 'patch']) !!}

                        @include('backend.books.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection