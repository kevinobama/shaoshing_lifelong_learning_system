@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            Advertisements
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'backend.advertisements.store', 'enctype' => 'multipart/form-data']) !!}

                        @include('backend.advertisements.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
