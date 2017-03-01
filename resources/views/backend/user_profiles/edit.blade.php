@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            User Profiles
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userProfiles, ['route' => ['backend.userProfiles.update', $userProfiles->id], 'method' => 'patch']) !!}

                        @include('backend.user_profiles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection