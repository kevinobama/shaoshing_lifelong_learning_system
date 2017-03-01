@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            Course Files
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'backend.courseFiles.store']) !!}

                        @include('backend.course_files.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
