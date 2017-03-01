<table class="table table-responsive" id="courseFiles-table">
    <thead>
        <th>Course Chapter Id</th>
        <th>Lesson Name</th>
        <th>Url</th>
        <th>Type</th>
        <th>Duration</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($courseFiles as $courseFiles)
        <tr>
            <td>{!! $courseFiles->course_chapter_id !!}</td>
            <td>{!! $courseFiles->lesson_name !!}</td>
            <td>{!! $courseFiles->url !!}</td>
            <td>{!! $courseFiles->type !!}</td>
            <td>{!! $courseFiles->duration !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.courseFiles.destroy', $courseFiles->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.courseFiles.show', [$courseFiles->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.courseFiles.edit', [$courseFiles->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>