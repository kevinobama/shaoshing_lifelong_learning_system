<!DOCTYPE html>
<html>
@include('layouts.partials.backend.head')
<body class="hold-transition skin-blue sidebar-collapse  sidebar-mini">
<div class="wrapper">
    @include('layouts.partials.backend.mainheader')
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
    @include('layouts.partials.backend.sidebar')
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        @yield('content')
    </div>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@include('layouts.partials.backend.footerjs')
</body>
</html>