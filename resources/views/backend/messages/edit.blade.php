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
					{!! Form::model($message, ['route' => ['backend.messages.update', $message->id], 'method' => 'patch', 'files' => true]) !!}

					@include('backend.messages.fields')

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
