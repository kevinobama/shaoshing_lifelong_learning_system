<table class="table table-responsive" id="userCourseBookmarks-table">
    <thead>
        <th>Course Id</th>
        <th>User Id</th>
        <th>User Name</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userCourseBookmarks as $userCourseBookmarks)
        <tr>
            <td>{!! $userCourseBookmarks->course_id !!}</td>
            <td>{!! $userCourseBookmarks->user_id !!}</td>
            <td>{!! $userCourseBookmarks->user_name !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.userCourseBookmarks.destroy', $userCourseBookmarks->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.userCourseBookmarks.show', [$userCourseBookmarks->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.userCourseBookmarks.edit', [$userCourseBookmarks->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>