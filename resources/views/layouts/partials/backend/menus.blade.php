<li class="{{ Utility::classActiveSegment(2, 'users') }}">
    <a href="{!! route('backend.users.index') !!}"><i class="fa fa-edit"></i><span>{{ Lang::get('menu.users') }}</span></a>
</li>

<li class="{{ Utility::classActiveSegment(2, 'userProfiles') }}">
    <a href="{!! route('backend.userProfiles.index') !!}"><i class="fa fa-edit"></i><span>{{ Lang::get('menu.userProfiles') }}</span></a>
</li>

<li class="{{ Request::is('reports*') ? 'active' : '' }}">
    <a href="{!! route('backend.reports.index') !!}"><i class="fa fa-edit"></i><span>举报</span></a>
</li>

