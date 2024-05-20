@extends('layouts.dashboard-master')


{{-- *** Add styles and scripts to the header of the master layout for this form *** --}}
@push('header-scripts-and-styles')
     <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/summernote/summernote-bs4.min.css') }}">

@endpush
{{-- Set Dashboard Title --}}
@section('title', 'Zaratica Dashboard')


{{-- Add Dashboard Header Messages --}}
@push('header-messages')
    @include('dashboard.header-messages')
@endpush

{{-- *** Add Notifications to Dashboard Header  *** --}}
@push('header-notifications')
    @include('dashboard.header-notifications')
@endpush

{{-- *** Add Dashboard Sidebar Menu *** --}}
@push('sidebar-menu')
    @include('dashboard.sidebar-menu')
@endpush

{{-- *** Add Dashboard Main Content *** --}}
@push('main-content')
    @include('dashboard.info-graphs-and-charts')
@endpush

{{-- *** Add Dashboard Info Graphis and Charts JS and CSS Content *** --}}
@push('footer-scripts-and-styles')
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dashboard_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('dashboard_assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('dashboard_assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('dashboard_assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('dashboard_assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('dashboard_assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('dashboard_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>

    <script src="{{ asset('dashboard_assets/dist/js/pages/dashboard.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('dashboard_assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('dashboard_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
@endpush
