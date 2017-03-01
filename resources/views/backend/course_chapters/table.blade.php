<table class="table table-responsive" id="courseChapters-table">
    <thead>
        <th>Course Id</th>
        <th>Chapter Name</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($courseChapters as $courseChapters)
        <tr>
            <td>{!! $courseChapters->course_id !!}</td>
            <td>{!! $courseChapters->chapter_name !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.courseChapters.destroy', $courseChapters->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.courseChapters.show', [$courseChapters->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.courseChapters.edit', [$courseChapters->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>