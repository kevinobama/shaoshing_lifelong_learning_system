@extends('layouts.backend')

@section('content')
	<section class="content-header">
		<h1>
			资讯
		</h1>
	</section>
	<div class="content">
		@include('adminlte-templates::common.errors')
		<div class="box box-primary">

			<div class="box-body">
				<div class="row">
					{!! Form::open(['route' => 'backend.messages.store', 'files' => true]) !!}

					@include('backend.messages.fields')

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
