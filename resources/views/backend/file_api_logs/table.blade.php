<table class="table table-responsive" id="redisApilogs-table">
    <thead>
        <th>ID</th>
        <th>userName</th>
        <th>userID</th>
        <th>url</th>
        <th>method</th>
        <th >request</th>
        <th>ip</th>
        <th width="170">time</th>
        <th>statusCode</th>
    </thead>
    <tbody>
    @foreach($redisApilogs as $redisApilog)
        <tr>
            <td><a href="{!! route('fileApilogs.show', [$redisApilog['id']]) !!}" class='btn btn-default btn-xs'>
                {!! $redisApilog['id'] !!}
                </a>
            </td>
            <td>{!! $redisApilog['userName'] !!}</td>
            <td>{!! $redisApilog['userID'] !!}</td>
            <td style='max-width: 300px;'>
                <p style="word-wrap: break-word;max-width: 300px;width: 300px;float: left;text-align: left;">
                    {!! $redisApilog['url'] !!}
                </p>
            </td>
            <td style="color:orangered;">{!! $redisApilog['method'] !!}</td>
            <td style='max-width: 800px;word-wrap: break-word;' >
                @if (isset($redisApilog['request']))
                    {!! '<pre>'.var_export($redisApilog['request'],true).'</pre>' !!}
                @endif
            </td>
            <td>{!! $redisApilog['ip'] !!}</td>
            <td>{!! date('Y-m-d H:i:s',$redisApilog['time']) !!}</td>
            <td>{!! $redisApilog['statusCode'] !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>