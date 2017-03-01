@extends('layouts.backend')

@section('content')
	<section class="content-header">
		<h1>
			圈子
		</h1>
	</section>
	<div class="content">
		@include('adminlte-templates::common.errors')
		<div class="box box-primary">

			<div class="box-body">
				<div class="row">
					{!! Form::open(['route' => 'backend.forums.store', 'files' => true]) !!}

					@include('backend.forums.fields')

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
