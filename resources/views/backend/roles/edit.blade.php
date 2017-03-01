@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            Roles
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($roles, ['route' => ['backend.roles.update', $roles->id], 'method' => 'patch']) !!}

                        @include('backend.roles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection