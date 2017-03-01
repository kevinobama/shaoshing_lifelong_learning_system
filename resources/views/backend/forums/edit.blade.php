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
					{!! Form::model($forum, ['route' => ['backend.forums.update', $forum->id], 'method' => 'patch', 'files' => true]) !!}

					@include('backend.forums.fields')

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
