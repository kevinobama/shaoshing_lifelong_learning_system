<table class="table table-responsive" id="forumPosts-table">
    <thead>
    <th colspan="4"><h4>{!! $forum->name !!}</h4><br>
        {{ Lang::get('forum.members') . Lang::get('forum.count') }}:
        {!! $forum->members_count !!}
        {{ Lang::get('forum.posts') . Lang::get('forum.count') }}:
        {!! $forum->posts_count !!}
        {{ Lang::get('forum.comments') . Lang::get('forum.count') }}:
        {!! $forum->comments_count !!}
    </th>
    </thead>
    <tbody>
    @foreach($forumPosts as $forumPost)
        <tr>
            <td rowspan="2" style="width: 70px">
                <img style="width: 60px;" src="{!! $forumPost->user->profile->avatar !!}" alt=""></td>
            <td colspan="3">{!! $forumPost->user->name !!}</td>
        </tr>
        <tr>
            <td>{!! $forumPost->created_at !!}</td>

            <td>
                <a href="{!! route('backend.forumComments.index', [$forumPost->id]) !!}">{!! $forumPost->comments_count !!}</a>
            </td>
            <td style="width: 90px">
                {!! Form::open(['route' => ['backend.forumPosts.destroy', $forumPost->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.forumPosts.show', [$forumPost->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.forumPosts.edit', [$forumPost->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        <tr>
            <td colspan="3">{!! $forumPost->content !!}
                <p>
                    @foreach ($forumPost->attachments as $attachment)
                        <img style="height: 90px;" src="{!! $attachment->filename !!}:h90">
                    @endforeach
                </p>
            </td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
