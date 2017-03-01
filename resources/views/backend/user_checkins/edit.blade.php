@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            User Checkins
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userCheckins, ['route' => ['backend.userCheckins.update', $userCheckins->id], 'method' => 'patch']) !!}

                        @include('backend.user_checkins.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection