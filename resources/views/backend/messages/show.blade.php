@extends('layouts.backend')

@section('content')
	<section class="content-header">
		<h1>
			资讯
		</h1>
	</section>
	<div class="content">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row" style="padding-left: 20px">
					@include('backend.messages.show_fields')
					<a href="{!! route('backend.messages.index') !!}" class="btn btn-default">返回</a>
				</div>
			</div>
		</div>
	</div>
@endsection
