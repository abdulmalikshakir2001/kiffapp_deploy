@extends('layouts.dashboard-master')

{{-- *** Add Header Scripts and Styles here *** --}}
@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Subscription Packages')

{{-- Add Dashboard breadcrumb Links --}}
@push('breadcrumb')
    <li class="breadcrumb-item ative">Subscription Packages</a></li>
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
                    <h3 class="card-title">@lang('dashboard.subscription_packages')</h3>
                    <a href="{{ url('/') }}/subscriptionpackages/create">
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
                                    <th>@lang('dashboard.package_description')</th>
                                    <th data-priority="2">@lang('dashboard.price')</th>
                                    <th data-priority="3">@lang('dashboard.duration')</th>
                                    <th data-priority="4">@lang('dashboard.duration_type')</th>
                                    <th>@lang('dashboard.trail_period_in_days')</th>
                                    <th>@lang('dashboard.sort_order')</th>

                                    <th>@lang('dashboard.allowed_users')</th>
                                    <th>@lang('dashboard.allowed_products')</th>
                                    <th>@lang('dashboard.allowed_customers')</th>
                                    <th>@lang('dashboard.allowed_suppliers')</th>
                                    <th>@lang('dashboard.allowed_purchaseorders')</th>
                                    <th>@lang('dashboard.allowed_salesinvoices')</th>
                                    <th>@lang('dashboard.allowed_accounts')</th>

                                    <th>@lang('dashboard.module_hrm')</th>
                                    <th>@lang('dashboard.module_crm')</th>
                                    <th>@lang('dashboard.module_products')</th>
                                    <th>@lang('dashboard.module_purchase')</th>
                                    <th>@lang('dashboard.module_inventroy')</th>
                                    <th>@lang('dashboard.module_sales')</th>
                                    <th>@lang('dashboard.module_accounts')</th>

                                    <th data-priority="5">@lang('dashboard.is_active')</th>
                                    <th>@lang('dashboard.deleted_at')</th>
                                    <th>@lang('dashboard.created_at')</th>
                                    <th>@lang('dashboard.updated_at')</th>
                                    <th data-priority="6">@lang('dashboard.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptionpackages as $package)
                                    <tr>
                                        <td>{{ $package->package_name }}</td>
                                        <td>{{ $package->package_description }}</td>
                                        <td>{{ $package->price }}</td>
                                        <td>{{ $package->duration }}</td>
                                        <td>{{ $package->duration_type }}</td>
                                        <td>{{ $package->trail_period_in_days }}</td>
                                        <td>{{ $package->sort_order }}</td>

                                        <td>{{ $package->allowed_users== -1 ? 'Unlimited' : $package->allowed_users }}</td>
                                        <td>{{ $package->allowed_products== -1 ? 'Unlimited' : $package->allowed_products }}</td>
                                        <td>{{ $package->allowed_customers== -1 ? 'Unlimited' : $package->allowed_customers }}</td>
                                        <td>{{ $package->allowed_suppliers== -1 ? 'Unlimited' : $package->allowed_suppliers }}</td>
                                        <td>{{ $package->allowed_purchaseorders== -1 ? 'Unlimited' : $package->allowed_purchaseorders }}</td>
                                        <td>{{ $package->allowed_salesinvoices == -1 ? 'Unlimited' : $package->allowed_salesinvoices }}</td>
                                        <td>{{ $package->allowed_accounts == -1 ? 'Unlimited' : $package->allowed_accounts }}</td>

                                        <td>{{ $package->module_hrm == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $package->module_crm == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $package->module_products == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $package->module_purchase == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $package->module_inventroy == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $package->module_sales == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $package->module_accounts == 1 ? 'Yes' : 'No' }}</td>

                                        <td>{{ $package->is_active == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $package->deleted_at }}</td>
                                        <td>{{ $package->created_at }}</td>
                                        <td>{{ $package->updated_at }}</td>
                                        <td>
                                            <div class="float-left">
                                                <a href="{{ url('/subscriptionpackages' . '/' . $package->package_id) }}/edit" class="btn btn-sm bg-warning">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="float-right">
                                            <form method="POST"
                                                action="{{ url('/subscriptionpackages' . '/' . $package->package_id) }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $package->package_id }}">
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
