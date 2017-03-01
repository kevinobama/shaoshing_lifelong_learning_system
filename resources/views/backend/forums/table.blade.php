<table class="table table-responsive" id="forums-table">
	<thead>
	<th>{{ Lang::get('menu.forums') . Lang::get('forum.name') }}</th>
	<th style="text-align: right;">{{ Lang::get('forum.members') . Lang::get('forum.count') }}</th>
	<th style="text-align: right;">{{ Lang::get('forum.posts') . Lang::get('forum.count') }}</th>
	<th style="text-align: right;">{{ Lang::get('forum.comments') . Lang::get('forum.count') }}</th>
	<th style="text-align: center;">{{ Lang::get('forum.update') . Lang::get('forum.time') }}</th>
	<th colspan="3">操作</th>
	</thead>
	<tbody>
	@foreach($forums as $forum)
		<tr>
			<td>
				<a href="{!! route('backend.forumPosts.index', [$forum->id]) !!}" class='btn btn-default btn-xs'>{!! $forum->name !!}</a>
				<img src="{!! $mediaHost . $forum->cover !!}:h30" style="height: 30px;" alt="">
			</td>
			<td style="text-align: right;">{!! $forum->members_count !!}</td>
			<td style="text-align: right;">{!! $forum->posts_count !!}</td>
			<td style="text-align: right;">{!! $forum->comments_count !!}</td>
			<td style="text-align: center;">{!! $forum->updated_at !!}</td>
			<td>
				{!! Form::open(['route' => ['backend.forums.destroy', $forum->id], 'method' => 'delete']) !!}
				<div class='btn-group'>
					<a href="{!! route('backend.forums.show', [$forum->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
					<a href="{!! route('backend.forums.edit', [$forum->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
					{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
				</div>
				{!! Form::close() !!}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
