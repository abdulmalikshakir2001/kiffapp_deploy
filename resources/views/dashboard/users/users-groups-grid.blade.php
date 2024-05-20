@extends('layouts.dashboard-master')

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - User Groups')

@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

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

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.group_grid_title')</h3>
                                            <a href="{{ url('/') }}/usersgroups/create">
                            <button type="button" class="btn btn-primary btn-sm float-right" id="btn_view_all"><i
                                    class="fa fa-plus"></i> @lang('dashboard.create_new')</button>
                        </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="data_grid_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <table id="data-grid" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-priority="1">@lang('dashboard.group_name')</th>
                                    <th>@lang('dashboard.permissions')</th>
                                    <th data-priority="2">@lang('dashboard.company_name')</th>
                                    <th data-priority="3">@lang('dashboard.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersgroups as $usersgroup)
                                    <tr>
                                        <td>{{ $usersgroup->group_name }}
                                        @php
                                            if ($usersgroup->is_global == 1) {
                                                echo '<span class="badge badge-danger right">Global</span>';
                                            }
                                        @endphp
                                        </td>
                                        <td>{{ $usersgroup->permissions }}</td>
                                        <td>{{ $usersgroup->company_name }}</td>
                                        <td>
                                            <div class="float-left">
                                                <a href="{{ url('/usersgroups' . '/' . $usersgroup->group_id) }}/edit" class="btn btn-sm bg-warning">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="float-right">
                                            <form method="POST"
                                                action="{{ url('/usersgroups' . '/' . $usersgroup->group_id) }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $usersgroup->group_id }}">
                                                <button type="submit" title="Delete"
                                                    class="btn btn-sm bg-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                            </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th data-priority="1">@lang('dashboard.group_name')</th>
                                    <th>@lang('dashboard.permissions')</th>
                                    <th data-priority="2">@lang('dashboard.company_name')</th>
                                    <th data-priority="3">@lang('dashboard.action')</th>
                                </tr>
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
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 3,
                        "className": "text-center",
                    } //Make Action column always visible
                ],
                "buttons": ["copy", "csv", "excel", "pdf", "print"],


            }).buttons().container().appendTo('#data_grid_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
