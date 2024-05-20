@extends('layouts.dashboard-master')

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Users Permissions')

{{-- Add Dashboard breadcrumb Links --}}
@push('breadcrumb')
   <li class="breadcrumb-item ative">Users Permissions</a></li>
@endpush

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
    <!-- form start -->
    @php
    //{{ url('/') }}/companies
    $action_url = url('/userspermissions');
    //reset submit url if edit form is loaded
    if (!empty($userspermission->permission_id)) {
        $action_url = url('/userspermissions').'/'.$userspermission->permission_id;
    }
    @endphp

    <form action="{{$action_url}}" method="POST">
        @csrf
        @php
            if (!empty($userspermission->permission_name)) {
                echo method_field('PUT');
            }
        @endphp
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang('dashboard.group_form_title')</h3>
                        <a href="{{ url('/userspermissions') }}">
                            <button type="button" class="btn btn-primary btn-xs float-right" id="btn_view_all"><i
                                    class="fa fa-list "></i> View All</button>
                        </a>
                    </div>

                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="app_module_name">@lang('dashboard.app_module_name')</label>
                                    <input type="text" class="form-control" name="app_module_name" id="app_module_name"
                                        value="{{ !empty($userspermission->app_module_name)?$userspermission->app_module_name:old('app_module_name',"") }}"
                                        placeholder="@lang('dashboard.app_module_name_ph')">
                                    <span class="text-danger">
                                        @error('app_module_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="permission_name">@lang('dashboard.permission_name')</label>
                                    <input type="text" class="form-control" name="permission_name" id="permission_name"
                                        value="{{ !empty($userspermission->permission_name)?$userspermission->permission_name:old('permission_name',"") }}"
                                        placeholder="@lang('dashboard.permission_name_ph')">
                                    <span class="text-danger">
                                        @error('permission_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-primary">@lang('dashboard.submit_button')</button>
                    </div>
                </div>
            </div>
        </div><!-- ./row -->




    </form>
@endpush
