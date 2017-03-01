<!-- Id Field -->
<div class="form-group">
    <p><span style="color: #3d62f5">url</span>: &nbsp;{!! $fileApilog['url'] !!}</p>
    <p><span style="color: #3d62f5">method</span>: &nbsp;{!! $fileApilog['method'] !!}</p>
    <p><span style="color: #3d62f5">request</span>:<br>

        @if(isset($fileApilog['request']))
{!! '<pre>'.var_export($fileApilog['request'],true).'</pre>' !!}
        @endif

    </p>
    <table class="table table-responsive" id="redisApilogs-table">
        <thead>
        <th>ID</th>
        <th>userName</th>
        <th>userID</th>
        <th>method</th>
        <th>ip</th>
        <th width="170">time</th>
        <th>statusCode</th>
        </thead>
        <tbody>
            <tr>
                <td>{!! $fileApilog['id'] !!}</td>
                <td>{!! $fileApilog['userName'] !!}</td>
                <td>{!! $fileApilog['userID'] !!}</td>
                <td style="color:orangered;">{!! $fileApilog['method'] !!}</td>
                <td>{!! $fileApilog['ip'] !!}</td>
                <td>{!! date('Y-m-d H:i:s',$fileApilog['time']) !!}</td>
                <td>{!! $fileApilog['statusCode'] !!}</td>
            </tr>
            <tr>
                <td colspan="8">
                    <pre>{!! var_export($fileApilog['response'],true) !!}</pre>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <pre>{!! isset($fileApilog['userAgent'])? $fileApilog['userAgent']:null !!}</pre>
                </td>
            </tr>
        </tbody>
    </table>
</div>

