@extends('layouts.backend')

@section('content')
	<section class="content-header">
		<h1 class="pull-left">资讯</h1>
		<h1 class="pull-right">
			<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('backend.messages.create') !!}">新增</a>
		</h1>
	</section>
	<div class="content">
		<div class="clearfix"></div>

		@include('flash::message')

		<div class="clearfix"></div>
		<div class="box box-primary">
			<div class="box-body">
				@include('backend.messages.table')
			</div>
			<div class="box-footer">
				{{ $messages->links() }}
			</div>
		</div>
	</div>
@endsection

