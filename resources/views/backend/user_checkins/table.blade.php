<table class="table table-responsive" id="userCheckins-table">
    <thead>
        <th>User Id</th>
        <th>Signed Date Time</th>
        <th>Signed Days</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($userCheckins as $userCheckins)
        <tr>
            <td>{!! $userCheckins->user_id !!}</td>
            <td>{!! $userCheckins->signed_date_time !!}</td>
            <td>{!! $userCheckins->signed_days !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.userCheckins.destroy', $userCheckins->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.userCheckins.show', [$userCheckins->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.userCheckins.edit', [$userCheckins->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>