<table class="table table-responsive" id="courses-table">
    <thead>
        <th>ID</th>
        <th>课程名称</th>
        <th>介绍</th>
        <td>科目</td>
        <th width="100">选课用户数</th>
        <th width="100">圈子Id</th>
        <th colspan="3" width="200">操作</th>
    </thead>
    <tbody>
    @foreach($courses as $courses)
        <tr>
            <td>{!! $courses->id !!}</td>
            <td>{!! $courses->name !!}
                @if ($courses->cover_image)
                <p>
                <a href="{!! Config::get('shaoshing_lifelong_learning_system.media_host').$courses->cover_image !!}" target="_blank">
                    <img src="{!! Config::get('shaoshing_lifelong_learning_system.media_host').$courses->cover_image !!}" style="width: 150px;height: 80px;">
                </a>
                </p>
                @endif
            </td>
            <td>{!! $courses->introduction !!}</td>
            <td>{!! $courses->subject_name !!}</td>
            <td>{!! $courses->bookmark_count !!}
                {{--{!! json_encode($courses->users) !!}--}}
            </td>
            <td>{!! $courses->forum_id !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.courses.destroy', $courses->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.courses.edit', [$courses->id]) !!}" class='btn btn-default btn-xs'>{{ Lang::get('menu.edit') }}</a>
                    {!! Form::button(Lang::get('menu.delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>