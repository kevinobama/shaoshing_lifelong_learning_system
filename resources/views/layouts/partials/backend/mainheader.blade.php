<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>绍兴终身学习</b>后台</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>绍兴终身学习后台</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <!-- Control Sidebar Toggle Button -->
                <li class="{{ Utility::classActiveSegment(2, 'books') }}">
                    <a href="{!! route('backend.books.index') !!}"><i class="fa fa-book"></i><span>{{ Lang::get('menu.books') }}</span></a>
                </li>
                <li class="{{ Utility::classActiveSegment(2, 'courses') }}">
                    <a href="{!! route('backend.courses.index') !!}"><i class="fa fa-video-camera"></i><span>{{ Lang::get('menu.courses') }}</span></a>
                </li>
                <li class="{{ Request::is('forums*') ? 'active' : '' }}">
                    <a href="{!! route('backend.forums.index') !!}"><i class="fa fa-bullseye"></i><span>{{ Lang::get('menu.forums') }}</span></a>
                </li>
                <li class="{{ Utility::classActiveSegment(2, 'advertisements') }}">
                    <a href="{!! route('backend.advertisements.index') !!}"><i class="fa fa-globe"></i><span>{{ Lang::get('menu.advertisements') }}</span></a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>退出
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
