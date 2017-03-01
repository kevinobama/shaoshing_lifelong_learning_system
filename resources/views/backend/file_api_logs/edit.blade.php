@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            Redis Apilogs
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($redisApilogs, ['route' => ['backend.redisApilogs.update', $redisApilogs->id], 'method' => 'patch']) !!}

                        @include('backend.redis_apilogs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection