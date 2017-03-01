@extends('layouts.backend')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">电子书管理
            {!! Form::select('subject_id', $subjects, session('subject_id'),['id' => 'subject_id']) !!}
        </h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('backend.books.create') !!}">添加</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('backend.books.table')
            </div>
        </div>
        {!! $books->links() !!}
    </div>

    <script language="javascript">
    $(function () {
        $("#subject_id").on('change', function (e) {
            location.href='/backend/books?search=subject_id:'+this.value;
        });
    });
    </script>
@endsection


