@extends('layouts.dashboard-master')

{{-- *** Add Header Scripts and Styles here *** --}}
@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Subscriptions')

{{-- Add Dashboard breadcrumb Links --}}
@push('breadcrumb')
    <li class="breadcrumb-item ative">Subscriptions</a></li>
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
                    <h3 class="card-title">@lang('dashboard.subscribed_packages')</h3>
                    <a href="{{ url('/') }}/subscriptions/create">
                        <button type="button" class="btn btn-primary btn-sm float-right" id="btn_view_all"><i
                                class="fa fa-plus"></i> @lang('dashboard.create_new')</button>
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="data_grid_wrapper" class="dataTables_wrapper dt-bootstrap4" style="white-space:nowrap;">

                        <table id="data-grid" class="table table-bordered table-hover dataTable dtr-inline" >
                            <thead>
                                <tr>
                                    <th data-priority="1">@lang('dashboard.package_name')</th>
                                    <th data-priority="2">@lang('dashboard.company_name')</th>
                                    <th data-priority="3">@lang('dashboard.start_date')</th>
                                    <th data-priority="4">@lang('dashboard.end_date')</th>
                                    <th>@lang('dashboard.trial_ends_date')</th>
                                    <th data-priority="5">@lang('dashboard.price')</th>
                                    <th>@lang('dashboard.status')</th>
                                    <th data-priority="6">@lang('dashboard.is_active')</th>
                                    <th>@lang('dashboard.deleted_at')</th>
                                    <th>@lang('dashboard.created_at')</th>
                                    <th>@lang('dashboard.updated_at')</th>
                                    <th data-priority="7">@lang('dashboard.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->package_name }}</td>
                                        <td>{{ $subscription->company_name }}</td>
                                        <td>{{ $subscription->start_date }}</td>
                                        <td>{{ $subscription->end_date }}</td>
                                        <td>{{ $subscription->trial_ends_date }}</td>
                                        <td>{{ $subscription->price }}</td>
                                        <td>{{ $subscription->status }}</td>
                                        <td>{{ $subscription->is_active == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $subscription->deleted_at }}</td>
                                        <td>{{ $subscription->created_at }}</td>
                                        <td>{{ $subscription->updated_at }}</td>
                                        <td>
                                            <div class="float-left">
                                                <a href="{{ url('/subscriptions' . '/' . $subscription->subscription_id) }}/edit" class="btn btn-sm bg-warning">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="float-right">
                                            <form method="POST"
                                                action="{{ url('/subscriptions' . '/' . $subscription->subscription_id) }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $subscription->subscription_id }}">
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
                        "width":"100px"


                    } //Make Action column always visible
                ],
            }).buttons().container().appendTo('#data_grid_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
