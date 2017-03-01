@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            科目
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($subjects, ['route' => ['subjects.update', $subjects->id], 'method' => 'patch']) !!}

                        @include('backend.subjects.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection