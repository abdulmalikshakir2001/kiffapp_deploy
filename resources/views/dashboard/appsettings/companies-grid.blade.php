@extends('layouts.dashboard-master')

{{-- *** Add Header Scripts and Styles here *** --}}
@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - companies')

{{-- Add Dashboard breadcrumb Links --}}
@push('breadcrumb')
    <li class="breadcrumb-item ative">Companies</a></li>
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
                    <h3 class="card-title">@lang('dashboard.companies')</h3>
                    <a href="{{ url('/') }}/companies/create">
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

                                    <th data-priority="1">@lang('dashboard.company_name')</th>
                                    <th data-priority="2">@lang('dashboard.registration_number')</th>
                                    <th>@lang('dashboard.address')</th>
                                    <th>@lang('dashboard.city')</th>
                                    <th>@lang('dashboard.state')</th>
                                    <th>@lang('dashboard.landmark')</th>
                                    <th>@lang('dashboard.zip_code')</th>
                                    <th data-priority="3">@lang('dashboard.country')</th>
                                    <th>@lang('dashboard.tax1_name')</th>
                                    <th>@lang('dashboard.tax1_number')</th>
                                    <th>@lang('dashboard.tax2_name')</th>
                                    <th>@lang('dashboard.tax2_number')</th>
                                    <th>@lang('dashboard.phone_number')</th>
                                    <th>@lang('dashboard.contact_number')</th>
                                    <th>@lang('dashboard.email')</th>
                                    <th>@lang('dashboard.sku_prefix')</th>
                                    <th>@lang('dashboard.time_zone')</th>
                                    <th>@lang('dashboard.date_format')</th>
                                    <th>@lang('dashboard.time_format')</th>
                                    <th>@lang('dashboard.fy_start_month')</th>
                                    <th>@lang('dashboard.default_profit_percent')</th>
                                    <th>@lang('dashboard.default_sales_discount_percent')</th>
                                    <th>@lang('dashboard.default_sales_tax_percent')</th>
                                    <th>@lang('dashboard.default_barcode_type')</th>
                                    <th>@lang('dashboard.pos_settings')</th>
                                    <th>@lang('dashboard.email_settings')</th>
                                    <th>@lang('dashboard.sms_settings')</th>
                                    <th>@lang('dashboard.common_settings')</th>
                                    <th>@lang('dashboard.website')</th>
                                    <th>@lang('dashboard.webfront_theme')</th>
                                    <th>@lang('dashboard.webfront_public_code')</th>
                                    <th>@lang('dashboard.currency_symbol_placement')</th>
                                    <th>@lang('dashboard.stock_accounting_method')</th>
                                    <th>@lang('dashboard.enable_purchase')</th>
                                    <th>@lang('dashboard.enable_product_expiry')</th>
                                    <th>@lang('dashboard.enable_category')</th>
                                    <th>@lang('dashboard.enable_sub_category')</th>
                                    <th>@lang('dashboard.enable_price_tax')</th>
                                    <th>@lang('dashboard.enable_brand')</th>
                                    <th>@lang('dashboard.is_active')</th>
                                    <th>@lang('dashboard.deleted_at')</th>
                                    <th>@lang('dashboard.created_at')</th>
                                    <th>@lang('dashboard.updated_at')</th>
                                    <th>@lang('dashboard.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->company_name }}</td>
                                        <td>{{ $company->registration_number }}</td>
                                        <td>{{ $company->address }}</td>
                                        <td>{{ $company->city }}</td>
                                        <td>{{ $company->state }}</td>
                                        <td>{{ $company->landmark }}</td>
                                        <td>{{ $company->zip_code }}</td>
                                        <td>{{ $company->country }}</td>
                                        <td>{{ $company->tax1_name }}</td>
                                        <td>{{ $company->tax1_number }}</td>
                                        <td>{{ $company->tax2_name }}</td>
                                        <td>{{ $company->tax2_number }}</td>
                                        <td>{{ $company->phone_number }}</td>
                                        <td>{{ $company->contact_number }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->sku_prefix }}</td>
                                        <td>{{ $company->time_zone }}</td>
                                        <td>{{ $company->date_format }}</td>
                                        <td>{{ $company->time_format }}</td>
                                        <td>{{ $company->fy_start_month }}</td>
                                        <td>{{ $company->default_profit_percent }}</td>
                                        <td>{{ $company->default_sales_discount_percent }}</td>
                                        <td>{{ $company->default_sales_tax_percent }}</td>
                                        <td>{{ $company->default_barcode_type }}</td>
                                        <td>{{ $company->pos_settings }}</td>
                                        <td>{{ $company->email_settings }}</td>
                                        <td>{{ $company->sms_settings }}</td>
                                        <td>{{ $company->common_settings }}</td>
                                        <td>{{ $company->website }}</td>
                                        <td>{{ $company->webfront_theme }}</td>
                                        <td>{{ $company->webfront_public_code }}</td>
                                        <td>{{ strtoupper($company->currency_symbol_placement) }}</td>
                                        <td>{{ strtoupper($company->stock_accounting_method) }}</td>
                                        <td>{{ $company->enable_purchase == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $company->enable_product_expiry == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $company->enable_price_tax == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $company->enable_category == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $company->enable_sub_category == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $company->enable_brand == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $company->is_active == 1 ? 'Yes' : 'No' }}</td>
                                        <td>{{ $company->deleted_at }}</td>
                                        <td>{{ $company->created_at }}</td>
                                        <td>{{ $company->updated_at }}</td>
                                        <td>
                                            <div class="float-left">
                                                <a href="{{ url('/companies' . '/' . $company->company_id) }}/edit" class="btn btn-sm bg-warning">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="float-right">
                                            <form method="POST"
                                                action="{{ url('/companies' . '/' . $company->company_id) }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $company->company_id }}">
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

                                    <th>@lang('dashboard.company_name')</th>
                                    <th>@lang('dashboard.registration_number')</th>
                                    <th>@lang('dashboard.address')</th>
                                    <th>@lang('dashboard.city')</th>
                                    <th>@lang('dashboard.state')</th>
                                    <th>@lang('dashboard.landmark')</th>
                                    <th>@lang('dashboard.zip_code')</th>
                                    <th>@lang('dashboard.country')</th>
                                    <th>@lang('dashboard.tax1_name')</th>
                                    <th>@lang('dashboard.tax1_number')</th>
                                    <th>@lang('dashboard.tax2_name')</th>
                                    <th>@lang('dashboard.tax2_number')</th>
                                    <th>@lang('dashboard.phone_number')</th>
                                    <th>@lang('dashboard.contact_number')</th>
                                    <th>@lang('dashboard.email')</th>
                                    <th>@lang('dashboard.sku_prefix')</th>
                                    <th>@lang('dashboard.time_zone')</th>
                                    <th>@lang('dashboard.date_format')</th>
                                    <th>@lang('dashboard.time_format')</th>
                                    <th>@lang('dashboard.fy_start_month')</th>
                                    <th>@lang('dashboard.default_profit_percent')</th>
                                    <th>@lang('dashboard.default_sales_discount_percent')</th>
                                    <th>@lang('dashboard.default_sales_tax_percent')</th>
                                    <th>@lang('dashboard.default_barcode_type')</th>
                                    <th>@lang('dashboard.pos_settings')</th>
                                    <th>@lang('dashboard.email_settings')</th>
                                    <th>@lang('dashboard.sms_settings')</th>
                                    <th>@lang('dashboard.common_settings')</th>
                                    <th>@lang('dashboard.website')</th>
                                    <th>@lang('dashboard.webfront_theme')</th>
                                    <th>@lang('dashboard.webfront_public_code')</th>
                                    <th>@lang('dashboard.currency_symbol_placement')</th>
                                    <th>@lang('dashboard.stock_accounting_method')</th>
                                    <th>@lang('dashboard.enable_purchase')</th>
                                    <th>@lang('dashboard.enable_product_expiry')</th>
                                    <th>@lang('dashboard.enable_category')</th>
                                    <th>@lang('dashboard.enable_sub_category')</th>
                                    <th>@lang('dashboard.enable_price_tax')</th>
                                    <th>@lang('dashboard.enable_brand')</th>
                                    <th>@lang('dashboard.is_active')</th>
                                    <th>@lang('dashboard.deleted_at')</th>
                                    <th>@lang('dashboard.created_at')</th>
                                    <th>@lang('dashboard.updated_at')</th>
                                    <th>@lang('dashboard.action')</th>
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
