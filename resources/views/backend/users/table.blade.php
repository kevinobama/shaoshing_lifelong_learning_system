<table class="table table-responsive" id="users-table">
    <thead>
    　　<th>ID</th>
        <th>名称</th>

        <th colspan="3">{{ Lang::get('menu.Action') }}</th>
    </thead>
    <tbody>
    @foreach($users as $users)
        <tr>
            <td>{!! $users->id !!}</td>
            <td>{!! $users->name !!}</td>

            <td>
                {!! Form::open(['route' => ['backend.users.destroy', $users->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.users.show', [$users->id]) !!}" class='btn btn-default btn-xs'>{{ Lang::get('menu.view') }}</a>
                    {{--<a href="{!! route('backend.users.edit', [$users->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                    {!! Form::button(Lang::get('menu.delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>