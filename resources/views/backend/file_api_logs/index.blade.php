@extends('layouts.backend')

@section('content')
    <meta http-equiv="refresh" content="30" >
    <div class="api-logs-search">

        {!! Form::open(['route' => 'fileApilogs.index', 'method' => 'get']) !!}

        <div class="form-group col-sm-12">
        {!! Form::select('field', $fields, $field, ['class' => ' ']) !!}
        {!! Form::text('keyword', $keyword, ['class' => '']) !!}

         {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>
    <section class="content-header">
        <h1 class="pull-left">Api logs---file storage(total:{{ $total }})</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('backend.file_api_logs.table')
            </div>
        </div>
    </div>
@endsection

