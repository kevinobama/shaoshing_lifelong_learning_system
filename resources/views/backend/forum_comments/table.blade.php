<table class="table table-responsive" id="forumComments-table">
	<thead>
	<th colspan="3">
		<a href="{!! route('backend.forumPosts.index', [$forum->id]) !!}" class='btn btn-default btn-xs'>{!! $forum->name !!}</a>
		> {!! $post->user->name !!}: {!! $post->content !!}</th>
	</thead>
	<tbody>
	@foreach($forumComments as $forumComment)
		<tr>
			<td><strong>{!! $forumComment->user->name !!}</strong><br>{!! $forumComment->created_at !!}</td>
			<td style="width: 60%">{!! $forumComment->content !!}</td>
			<td>
				{!! Form::open(['route' => ['backend.forumComments.destroy', $forumComment->id], 'method' => 'delete']) !!}
				<div class='btn-group'>
					<a href="{!! route('backend.forumComments.show', [$forumComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
					<a href="{!! route('backend.forumComments.edit', [$forumComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
					{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
				</div>
				{!! Form::close() !!}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
