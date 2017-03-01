<table class="table table-responsive" id="forumBulletins-table">
    <thead>
        <th>Title</th>
        <th>Forum Id</th>
        <th>Forum Name</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($forumBulletins as $forumBulletins)
        <tr>
            <td>{!! $forumBulletins->title !!}</td>
            <td>{!! $forumBulletins->forum_id !!}</td>
            <td>{!! $forumBulletins->forum_name !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.forumBulletins.destroy', $forumBulletins->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.forumBulletins.show', [$forumBulletins->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.forumBulletins.edit', [$forumBulletins->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>