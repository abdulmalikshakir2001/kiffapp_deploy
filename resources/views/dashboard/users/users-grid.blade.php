@extends('layouts.dashboard-master')

{{-- *** Add Header Scripts and Styles here *** --}}
@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Users')

{{-- Add Dashboard breadcrumb Links --}}
@push('breadcrumb')
    <li class="breadcrumb-item ative">Users</a></li>
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

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.users_grid_title')</h3>
                    <a href="{{ url('/users/create') }}">
                        <button type="button" class="btn btn-primary btn-sm float-right" id="btn_view_all"><i
                                class="fa fa-plus"></i> @lang('dashboard.create_new')</button>
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="data_grid_wrapper" class="dataTables_wrapper dt-bootstrap4" style="white-space:nowrap;">

                        <table id="data-grid" class="table table-bordered table-hover dataTable dtr-inline">
                            <thead>
                                <tr>

                                    <th data-priority="1">@lang('dashboard.id')</th>
                                    <th data-priority="2">@lang('dashboard.username')</th>
                                    <th>@lang('dashboard.email')</th>
                                    <th>@lang('dashboard.first_name')</th>
                                    <th>@lang('dashboard.last_name')</th>
                                    <th>@lang('dashboard.mobile_number')</th>
                                    <th>@lang('dashboard.phone_number')</th>
                                    <th>@lang('dashboard.gender')</th>
                                    <th>@lang('dashboard.user_type')</th>
                                    <th>@lang('dashboard.allow_login')</th>
                                    <th>@lang('dashboard.country')</th>
                                    <th data-priority="3">@lang('dashboard.company_name')</th>
                                    <th>@lang('dashboard.is_active')</th>
                                    <th data-priority="4">@lang('dashboard.action')</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->username }} <span class="badge badge-danger right">{{ $user->user_type=='Owner'?'Owner':'' }}</span></td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->mobile_number }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->user_type }}</td>
                                        <td>{{ $user->allow_login==1?'Yes':'No' }}</td>
                                        <td>{{ $user->country }}</td>
                                        <td>{{ $user->company_name }}</td>
                                        <td>{{ $user->is_active==1?'Yes':'No' }}</td>


                                        <td>
                                            <div class="float-left">
                                                <a href="{{ url('/users' . '/' . $user->user_id) }}/edit"
                                                    class="btn btn-sm bg-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="float-right">
                                                <form method="POST"
                                                    action="{{ url('/users' . '/' . $user->user_id) }}">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $user->user_id }}">
                                                    <button type="submit" title="Delete" class="btn btn-sm bg-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endpush

{{-- *** Add JS and CSS Content to main *** --}}
@push('footer-scripts-and-styles')
    <!-- Page specific script -->

    @include('dashboard.datatables-footer-scripts-and-styles')
    <script>
        $(function() {
            $('#data-grid').DataTable({
                "order": [
                    [0, 'asc']
                ],
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
                "columnDefs": [{
                        "responsivePriority": 1,
                        "targets": -1,
                        "className": "text-center",
                        "width": "100px"


                    } //Make Action column always visible
                ],
            }).buttons().container().appendTo('#data_grid_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
