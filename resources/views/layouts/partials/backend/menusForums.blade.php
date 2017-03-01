<li class="{{ Request::is('forums*') ? 'active' : '' }}">
	<a href="{!! route('backend.forums.index') !!}"><i class="fa fa-edit"></i><span>{{ Lang::get('menu.forums') }}</span></a>
</li>

<li class="{{ Utility::classActiveSegment(2, 'forumBulletins') }}">
	<a href="{!! route('backend.forumBulletins.index') !!}"><i class="fa fa-edit"></i><span>{{ Lang::get('menu.forumBulletins') }}</span></a>
</li>
