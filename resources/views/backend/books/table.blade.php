<table class="table table-responsive" id="books-table">
    <thead>
        <th width="10">ID</th>
        <th>电子书名称</th>
        <th>科目</th>
        <th>下载次数</th>
        <th>电子书文件</th>
        <th>圈子Id</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($books as $books)
        <tr>
            <td>{!! $books->id !!}</td>
            <td>
                <a href="{!! $books->download_url !!}" target="_blank">
                {!! $books->title !!}
                </a>
                @if ($books->cover_image_url)
                    <p>
                        <a href="{!! Config::get('shaoshing_lifelong_learning_system.media_host').$books->cover_image_url !!}" target="_blank">
                            <img src="{!! Config::get('shaoshing_lifelong_learning_system.media_host').$books->cover_image_url !!}" style="width: 150px;height: 50px;">
                        </a>
                    </p>
                @endif
            </td>
            <td>{!! $books->subject['name'] !!}</td>
            <td>{!! $books->download_count !!}</td>
            <td>
                <p>
                <a href="{!! $books->download_url !!}" target="_blank">
                    下载电子书
                </a></p>
            </td>

            <td>{!! $books->forum_id !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.books.destroy', $books->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.books.edit', [$books->id]) !!}?page={{$page}}" class='btn btn-default btn-xs'>{{ Lang::get('menu.edit') }}</a>
                    {!! Form::button(Lang::get('menu.delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>