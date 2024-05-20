@extends('layouts.dashboard-master')

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Countries')

@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

{{-- Add Dashboard breadcrumb Links --}}
@push('breadcrumb')
   <li class="breadcrumb-item ative">Countries</a></li>
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
                    <h3 class="card-title">@lang('dashboard.countries_grid_title')</h3>
                                            <a href="{{ url('/') }}/countries/create">
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
                                    <th data-priority="1">@lang('dashboard.country')</th>
                                    <th data-priority="2">@lang('dashboard.currency')</th>
                                    <th>@lang('dashboard.currency_code')</th>
                                    <th>@lang('dashboard.currency_symbol')</th>
                                    <th>@lang('dashboard.thousand_separator')</th>
                                    <th>@lang('dashboard.decimal_separator')</th>
                                    <th data-priority="3">@lang('dashboard.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $country->country }}</td>
                                        <td>{{ $country->currency }}</td>
                                        <td>{{ $country->currency_code }}</td>
                                        <td>{{ $country->currency_symbol }}</td>
                                        <td>{{ $country->thousand_separator }}</td>
                                        <td>{{ $country->decimal_separator }}</td>
                                        <td>
                                            <div class="float-left">
                                                <a href="{{ url('/countries' . '/' . $country->country_id) }}/edit" class="btn btn-sm bg-warning">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="float-right">
                                            <form method="POST"
                                                action="{{ url('/countries' . '/' .$country->country_id) }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $country->country_id }}">
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
                                    <th>@lang('dashboard.country')</th>
                                    <th>@lang('dashboard.currency')</th>
                                    <th>@lang('dashboard.currency_code')</th>
                                    <th>@lang('dashboard.currency_symbol')</th>
                                    <th>@lang('dashboard.thousand_separator')</th>
                                    <th>@lang('dashboard.decimal_separator')</th>
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
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 6,
                        "className": "text-center",
                    } //Make Action column always visible
                ],
                "buttons": ["copy", "csv", "excel", "pdf", "print"],


            }).buttons().container().appendTo('#data_grid_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
