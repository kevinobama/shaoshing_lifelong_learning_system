<table class="table table-responsive" id="reports-table">
    <thead>
        <th>用户 Id</th>
        <th>圈子 Id</th>
        <th>举报 Id</th>
        <th>举报模块</th>
        <th>举报内容</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($reports as $reports)
        <tr>
            <td>{!! $reports->user_id !!}</td>
            <td>{!! $reports->forum_id !!}</td>
            <td>{!! $reports->report_id !!}</td>
            <td>{!! $reports->report_module !!}</td>
            <td>{!! $reports->content !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.reports.destroy', $reports->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.reports.show', [$reports->id]) !!}" class='btn btn-default btn-xs'>{{ Lang::get('menu.view') }}</a>
                    {!! Form::button(Lang::get('menu.delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>