@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">举报</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('backend.reports.table')
            </div>
        </div>
    </div>
@endsection

