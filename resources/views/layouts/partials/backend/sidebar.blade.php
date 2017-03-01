<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="/images/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{Session("userName")}}</p>
        </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">&nbsp;</li>
        <li class="treeview {{ Utility::classActiveSegment(2, array('users','userProfiles')) }}">
            <a href="#">
                <i class="fa fa-table"></i> <span>{{ Lang::get('menu.users') }}</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                @include('layouts.partials.backend.menus')
            </ul>
        </li>

        <li class="treeview {{ Utility::classActivePath('courses') }} {{ Utility::classActivePath('home') }} {{ Utility::classActiveSegment(2, array('courses','courseChapters','userCourseBookmarks','courseFiles')) }}">
            <a href="#">
                <i class="fa fa-table"></i> <span>{{ Lang::get('menu.courses') }}</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                @include('layouts.partials.backend.menusCourses')
            </ul>
        </li>

        <li class="treeview {{ Utility::classActiveSegment(2, array('books')) }}">
            <a href="#">
                <i class="fa fa-table"></i> <span>{{ Lang::get('menu.books') }}</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                @include('layouts.partials.backend.menusBooks')
            </ul>
        </li>


        <li class="treeview {{ Utility::classActiveSegment(2, array('forums', 'forumPosts', 'forumComments')) }}">
            <a href="#">
                <i class="fa fa-bullseye"></i> <span>{{ Lang::get('menu.forums') }}</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                @include('layouts.partials.backend.menusForums')
            </ul>
        </li>

        <li class="treeview {{ Utility::classActiveSegment(2, array('messages')) }}">
            <a href="#">
                <i class="fa fa-newspaper-o"></i> <span>{{ Lang::get('menu.messages') }}</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                @include('layouts.partials.backend.menusMessages')
            </ul>
        </li>
　
        <li class="treeview {{ Utility::classActiveSegment(2, array('logs','roles','userCheckins','advertisements','fileApilogs')) }}">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>{{ Lang::get('menu.miscellaneous') }}</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                @include('layouts.partials.backend.menusMiscellaneous')
            </ul>
        </li>
    </ul>
</section>
