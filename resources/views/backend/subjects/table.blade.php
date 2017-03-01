<table class="table table-responsive" id="subjects-table">
    <thead>
        <th>名称</th>
        <th>英文名称</th>
        <th>位置</th>
        <th>模块</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($subjects as $subjects)
        <tr>
            <td>
                @if ($subjects->module == 'course')

                    <img src="{{Config::get('shaoshing_lifelong_learning_system.media_host')}}{!! $subjects->icon !!}" width="40">
                @endif
                {!! $subjects->name !!}
            </td>
            <td>{!! $subjects->name_en !!}</td>
            <td>{!! $subjects->position !!}</td>
            <td>{!! $subjects->module !!}</td>

            <td>
                {{--{!! Form::open(['route' => ['subjects.destroy', $subjects->id], 'method' => 'delete']) !!}--}}
                <div class='btn-group'>
                    <a href="{!! route('subjects.edit', [$subjects->id]) !!}" class='btn btn-default btn-xs'>{{ Lang::get('menu.edit') }}</a>
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                </div>
                {{--{!! Form::close() !!}--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>