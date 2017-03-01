@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1>
            Advertisements
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('backend.advertisements.show_fields')
                    <a href="{!! route('backend.advertisements.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
