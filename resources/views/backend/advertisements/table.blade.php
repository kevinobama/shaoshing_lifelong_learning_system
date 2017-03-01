<table class="table table-responsive" id="advertisements-table">
    <thead>
        <th>ID</th>
        <th>名称</th>
        <th>排序</th>
        <th>图像</th>
        <th>链接</th>
        <th>点击次数</th>
        <th></th>
        <th>区块</th>
        <th>模块</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($advertisements as $advertisements)
        <tr>
            <td>{!! $advertisements->id !!}</td>
            <td>{!! $advertisements->name !!}</td>
            <td>{!! $advertisements->priority !!}</td>

            <td>

                @if ($advertisements->image_link)
                    <p>
                        <a href="{!! Config::get('shaoshing_lifelong_learning_system.media_host').$advertisements->image_link !!}" target="_blank">
                            <img src="{!! Config::get('shaoshing_lifelong_learning_system.media_host').$advertisements->image_link !!}" style="width: 150px;height: 80px;">
                        </a>
                    </p>
                @endif
            </td>

            <td>{!! $advertisements->redirect_link !!}</td>
            <td>{!! $advertisements->click_count !!}</td>
            <td>{!! $advertisements->is_active !!}</td>
            <td>{!! $advertisements->block !!}</td>
            <td>{!! $advertisements->module !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.advertisements.destroy', $advertisements->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.advertisements.edit', [$advertisements->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>