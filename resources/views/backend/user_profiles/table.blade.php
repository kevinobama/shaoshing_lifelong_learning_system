<table class="table table-responsive" id="userProfiles-table">
    <thead>
        <th>Id</th>
        <th>名称</th>
        <th>性别</th>
        <th>头像</th>
        <th>真实姓名</th>
        <th>昵称</th>
        <th>钱币</th>
        <th>级别</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($userProfiles as $userProfiles)
        <tr>
            <td>{!! $userProfiles->user_id !!}</td>
            <td>{!! $userProfiles->user['name'] !!}</td>
            <td>{!! $userProfiles->gender !!}</td>
            <td>{!! $userProfiles->avatar !!}</td>
            <td>{!! $userProfiles->real_name !!}</td>
            <td>{!! $userProfiles->nick_name !!}</td>
            <td>{!! $userProfiles->coin !!}</td>
            <td>{!! $userProfiles->level !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.userProfiles.destroy', $userProfiles->user_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.userProfiles.edit', [$userProfiles->user_id]) !!}" class='btn btn-default btn-xs'>{{ Lang::get('menu.edit') }}</a>
                    {!! Form::button(Lang::get('menu.delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>