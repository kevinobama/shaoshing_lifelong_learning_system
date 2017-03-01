<li class="{{ Utility::classActiveSegment(2, 'logs') }}">
   <a href="/backend/logs"><i class="fa fa-edit"></i><span>{{ Lang::get('menu.logs') }}</span></a></li>
</li>
{{--<li class="{{ Utility::classActiveSegment(2, 'roles') }}">--}}
    {{--<a href="{!! route('backend.roles.index') !!}"><i class="fa fa-edit"></i><span>{{ Lang::get('menu.roles') }}</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Utility::classActiveSegment(2, 'userCheckins') }}">--}}
    {{--<a href="{!! route('backend.userCheckins.index') !!}"><i class="fa fa-edit"></i><span>{{ Lang::get('menu.userCheckins') }}</span></a>--}}
{{--</li>--}}


{{--<li class="{{ Utility::classActiveSegment(2, 'social-shares') }}">--}}
    {{--<a href="{!! route('backend.socialShares.index') !!}"><i class="fa fa-edit"></i><span>social shares</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Utility::classActiveSegment(2, 'fileApilogs') }}">--}}
    {{--<a href="/backend/fileApilogs"><i class="fa fa-edit"></i><span>File Api logs</span></a>--}}
{{--</li>--}}

<li class="{{ Utility::classActiveSegment(2, 'subjects') }}">
    <a href="{!! route('subjects.index') !!}"><i class="fa fa-edit"></i><span>科目</span></a>
</li>
<li class="{{ Utility::classActiveSegment(2, 'advertisements') }}">
    <a href="{!! route('backend.advertisements.index') !!}"><i class="fa fa-edit"></i><span>{{ Lang::get('menu.advertisements') }}</span></a>
</li>