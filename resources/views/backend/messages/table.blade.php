<table class="table table-responsive" id="messages-table">
	<thead>
	<th>广告图片</th>
	<th>标题</th>
	<th>内容类型</th>
	<th>内容</th>
	<th colspan="3">操作</th>
	</thead>
	<tbody>
	@foreach($messages as $message)
		<tr>
			<td>{!! ['', '是'][$message->is_banner] !!}</td>
			<td>{!! $message->title !!}</td>
			<td>{!! $message->content_type !!}</td>
			<td>{!! $message->content !!}</td>
			<td>
				{!! Form::open(['route' => ['backend.messages.destroy', $message->id], 'method' => 'delete']) !!}
				<div class='btn-group'>
					<a href="{!! route('backend.messages.show', [$message->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
					<a href="{!! route('backend.messages.edit', [$message->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
					{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
				</div>
				{!! Form::close() !!}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
