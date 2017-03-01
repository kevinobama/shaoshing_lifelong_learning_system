@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            Reports
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($reports, ['route' => ['backend.reports.update', $reports->id], 'method' => 'patch']) !!}

                        @include('backend.reports.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection