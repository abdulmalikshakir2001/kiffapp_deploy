<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (View::hasSection('title'))
            @yield('title')
        @else
            Dashboard
        @endif
    </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/flag-icon-css/css/flag-icon.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('dashboard_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->

    <link rel="stylesheet" href="{{ asset('dashboard_assets/dist/css/adminlte.min.css?v=3.2.0') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('dashboard_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('dashboard_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @stack('header-scripts-and-styles')
    <!-- Notifications Dropdown Menu -->
    @stack('header-scripts-and-styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dashboard_assets/dist/img/mono_s.png') }}" alt="Zaratica"
                height="60" width="60">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/')}}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/')}}/contact" class="nav-link">Contact</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Messages Dropdown Menu -->
                @stack('header-messages')
                <!-- Notifications Dropdown Menu -->
                @stack('header-notifications')
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="flag-icon flag-icon-us"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-0" style="left: inherit; right: 0px;">
                        <a href="#" class="dropdown-item active">
                            <i class="flag-icon flag-icon-us mr-2"></i> English
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="flag-icon flag-icon-sa mr-2"></i> Arabic
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/dashboard" class="brand-link">
                <img src="{{ asset('dashboard_assets/dist/img/mono_s.png') }}" alt=""
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span
                    class="brand-text font-weight-light">{{ env('APP_NAME') !== null ? env('APP_NAME') : 'Zaratica' }}</span>
            </a>

            <!-- Sidebar -->
            @stack('sidebar-menu')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@lang('dashboard.dashboard_title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                @stack('breadcrumb')
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @stack('main-content')
            </section>
            <!-- /.Main content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2000-2022 &nbsp;<a href="http://zorkif.com">Zorkif.com</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> {{ env('APP_VERSION') }}
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('dashboard_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('dashboard_assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dashboard_assets/dist/js/adminlte.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dashboard_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="{{ asset('dashboard_assets/plugins/select2/js/select2.full.min.js') }}"></script>


    <script src="{{ asset('dashboard_assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- scripts and styles -->
    @stack('footer-scripts-and-styles')
</body>

</html>
