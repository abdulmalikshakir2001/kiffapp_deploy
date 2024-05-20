@extends('layouts.dashboard-master')

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - User Groups')

{{-- Add Dashboard breadcrumb Links --}}
@push('breadcrumb')
    <li class="breadcrumb-item ative">Users Groups</a></li>
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
    $action_url = url('/usersgroups');
    //reset submit url if edit form is loaded
    if (!empty($usersgroup->group_name)) {
        $action_url = url('/usersgroups').'/'.$usersgroup->group_id;
    }
    @endphp
    <form action="{{ $action_url }}" method="POST">
            @csrf
            @php
                if (!empty($usersgroup->group_name)) {
                    echo method_field('PUT');
                }
            @endphp


            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.group_form_title')</h3>
                            <a href="{{ url('/') }}/usersgroups">
                                <button type="button" class="btn btn-primary btn-xs float-right" id="btn_view_all"><i
                                        class="fa fa-list "></i> View All</button>
                            </a>
                        </div>

                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group_name">@lang('dashboard.group_name')</label>
                                        <input type="text" class="form-control" name="group_name" id="group_name"
                                            value="{{ !empty($usersgroup->group_name)?$usersgroup->group_name:old('group_name',"") }}"
                                            placeholder="@lang('dashboard.group_name_ph')">
                                        <span class="text-danger">
                                            @error('group_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_global">@lang('dashboard.is_global')</label><br>
                                        <input type="checkbox" name="is_global" id="is_global" value="1"
                                         @if (!empty($usersgroup->is_global) && $usersgroup->is_global==1)
                                            checked
                                         @endif
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        <span>Note: If you make a group global it will be shown to all companies in the
                                            app</span>

                                    </div>
                                </div>
                            </div><!-- ./row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_name">@lang('dashboard.company_name')</label>
                                        <select name="company_id" id="company_id"
                                            class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->company_id }}"
                                                    @if(!empty($usersgroup->company_id) && $usersgroup->company_id==$company->company_id)
                                                    selected
                                                    @endif
                                                    data-select2-id="{{ $company->company_id }}">
                                                    {{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('company_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                </div>
                            </div><!-- ./row -->
                            <!-- /.card-body -->


                        </div>
                    </div>
                </div>
            </div><!-- ./row -->

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.permissions')</h3>
                        </div>

                        <div class="card-body p-0">
                            @error('permissions')
                                {{ $message }}
                            @enderror
                            <div class="card-footer clearfix">
                                <button type="submit" class="btn btn-primary">@lang('dashboard.submit_button')</button>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 15px">#</th>
                                        <th>@lang('dashboard.app_module_name')</th>
                                        <th>@lang('dashboard.permission_name')</th>
                                        <th>@lang('dashboard.view')</th>
                                        <th>@lang('dashboard.create')</th>
                                        <th>@lang('dashboard.update')</th>
                                        <th>@lang('dashboard.delete')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $index => $permission)
                                        <tr>
                                            <td>{{ $permission->permission_id }}</td>
                                            <td>{{ $permission->app_module_name }}</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="checkbox" name="permission{{ $index }}"
                                                        id="permission{{ $permission->permission_id }}"
                                                        @php
                                                         if(!empty($usersgroup->permissions) ){
                                                           if(str_contains( $usersgroup->permissions,$permission->permission_name)){
                                                           echo " checked ";
                                                           }}
                                                        @endphp
                                                        value="{{ $permission->permission_name }}" >
                                                    <strong>{{ $permission->permission_name }}</strong>


                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">

                                                    <input type="checkbox" name="{{$permission->permission_name}}View"
                                                       value="{{$permission->permission_name}}View"
                                                       @php
                                                        if(!empty($usersgroup->permissions) ){
                                                          if(str_contains( $usersgroup->permissions,$permission->permission_name."View")){
                                                            echo " checked ";
                                                           }}
                                                        @endphp
                                                        >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="checkbox" name="{{$permission->permission_name}}Create"
                                                        value="{{$permission->permission_name}}Create"
                                                       @php
                                                         if(!empty($usersgroup->permissions) ){
                                                          if(str_contains( $usersgroup->permissions,$permission->permission_name."Create")){
                                                            echo " checked ";}
                                                           }
                                                        @endphp
                                                        >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="checkbox" name="{{$permission->permission_name}}Update"
                                                        value="{{$permission->permission_name}}Update"
                                                       @php
                                                        if(!empty($usersgroup->permissions) ){
                                                          if(str_contains( $usersgroup->permissions,$permission->permission_name."Update")){
                                                            echo " checked ";}
                                                           }
                                                        @endphp
                                                        >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="checkbox" name="{{$permission->permission_name}}Delete"
                                                        value="{{$permission->permission_name}}Delete"
                                                       @php
                                                        if(!empty($usersgroup->permissions) ){
                                                          if(str_contains( $usersgroup->permissions,$permission->permission_name."Delete")){
                                                            echo " checked ";}
                                                           }
                                                        @endphp
                                                        >
                                                </div>
                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            <button type="submit" class="btn btn-primary">@lang('dashboard.submit_button')</button>
                        </div>

                    </div>


                </div><!-- ./col -->
            </div><!-- ./row -->



        </form>
    @endpush


    {{-- *** Add JS and CSS Content to main *** --}}
    @push('footer-scripts-and-styles')
        <!-- Page specific script -->


        <script>
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });

                $("input[data-bootstrap-switch]").each(function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                })
            });
        </script>
    @endpush
