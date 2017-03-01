@extends('layouts.backend')

@section('content')
<!--
    <link href="/css/plugins/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/plugins/fileinput.js" type="text/javascript"></script>
    -->

    <section class="content-header">
        <h1>
            课程
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'backend.courses.store','files' => true]) !!}

                        @include('backend.courses.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
