@extends('layouts.dashboard-master')

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Subscription Packages')

{{-- *** Add styles and scripts to the header of the master layout for this form *** --}}
@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.subscription_packages_form_title')</h3>
                    <a href="{{ url('/') }}/subscriptionpackages">
                        <button type="button" class="btn btn-primary btn-xs float-right" id="btn_view_all"><i
                                class="fa fa-list "></i> View All</button>
                    </a>
                </div>

                <!-- /.card-header -->
                <!-- form start -->
                @php
                    $action_url = url('/subscriptionpackages');
                    //reset submit url if edit form is loaded
                    if (!empty($package->package_id)) {
                        $action_url = url('/subscriptionpackages') . '/' . $package->package_id;
                    }
                @endphp
                <form action="{{ $action_url }}" method="POST">
                    @csrf
                    @php
                        if (!empty($package->package_id)) {
                            echo method_field('PUT');
                        }
                    @endphp
                    <div class="card-body">
                        <!-- ------------------------------------------------------------------------------------------------ -->
                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="package_name">@lang('dashboard.package_name')</label>
                                    <input type="text" class="form-control" name="package_name" id="package_name"
                                        value="{{ !empty($package->package_name) ? $package->package_name : old('package_name', '') }}"
                                        placeholder="@lang('dashboard.package_name_ph')">
                                    <span class="text-danger">
                                        @error('package_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="package_description">@lang('dashboard.package_description')</label>
                                    <input type="text" class="form-control" name="package_description"
                                        id="package_description"
                                        value="{{ !empty($package->package_description) ? $package->package_description : old('package_description', '') }}"
                                        placeholder="@lang('dashboard.package_description_ph')">
                                    <span class="text-danger">
                                        @error('package_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="price">@lang('dashboard.price')</label>
                                    <input type="text" class="form-control" name="price" id="price"
                                        value="{{ !empty($package->price)&& $package->price!=0.00 ? $package->price : old('price', '0.00') }}"
                                        placeholder="@lang('dashboard.price_ph')">
                                    <span class="text-danger">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="duration">@lang('dashboard.duration')</label>
                                    <input type="text" class="form-control" name="duration" id="duration"
                                        value="{{ !empty($package->duration) ? $package->duration : old('duration', '') }}"
                                        placeholder="@lang('dashboard.duration_ph')">
                                    <span class="text-danger">
                                        @error('duration')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="duration_type">@lang('dashboard.duration_type')</label>

                                    <select name="duration_type">
                                        <option value="Days" {{ !empty($package->duration_type) && $package->duration_type=='Days' ? 'selected' : '' }}>Days</option>
                                        <option value="Months" {{ !empty($package->duration_type) && $package->duration_type=='Months' ? 'selected' : '' }}>Months</option>
                                        <option value="Years" {{ !empty($package->duration_type) && $package->duration_type=='Years' ? 'selected' : '' }}>Years</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('duration_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="trail_period_in_days">@lang('dashboard.trail_period_in_days')</label>
                                    <input type="text" class="form-control" name="trail_period_in_days" id="trail_period_in_days"
                                        value="{{ !empty($package->trail_period_in_days) ? $package->trail_period_in_days : old('trail_period_in_days', '') }}"
                                        placeholder="@lang('dashboard.trail_period_in_days_ph')">
                                    <span class="text-danger">
                                        @error('trail_period_in_days')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="sort_order">@lang('dashboard.sort_order')</label>
                                    <input type="text" class="form-control" name="sort_order" id="sort_order"
                                        value="{{ !empty($package->sort_order) ? $package->sort_order : old('sort_order', '') }}"
                                        placeholder="@lang('dashboard.sort_order_ph')">
                                    <span class="text-danger">
                                        @error('sort_order')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="allowed_users">@lang('dashboard.allowed_users')</label>
                                    <input type="text" class="form-control" name="allowed_users" id="allowed_users"
                                        value="{{ !empty($package->allowed_users) ? $package->allowed_users : old('allowed_users', '') }}"
                                        placeholder="@lang('dashboard.allowed_users_ph')"><i> -1 = unlimited</i>
                                    <span class="text-danger">
                                        @error('allowed_users')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="allowed_products">@lang('dashboard.allowed_products')</label>
                                    <input type="text" class="form-control" name="allowed_products" id="allowed_products"
                                        value="{{ !empty($package->allowed_products) ? $package->allowed_products : old('allowed_products', '') }}"
                                        placeholder="@lang('dashboard.allowed_products_ph')"><i> -1 = unlimited</i>
                                    <span class="text-danger">
                                        @error('allowed_products')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="allowed_customers">@lang('dashboard.allowed_customers')</label>
                                    <input type="text" class="form-control" name="allowed_customers" id="allowed_customers"
                                        value="{{ !empty($package->allowed_customers) ? $package->allowed_customers : old('allowed_customers', '') }}"
                                        placeholder="@lang('dashboard.allowed_customers_ph')"><i> -1 = unlimited</i>
                                    <span class="text-danger">
                                        @error('allowed_customers')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="allowed_suppliers">@lang('dashboard.allowed_suppliers')</label>
                                    <input type="text" class="form-control" name="allowed_suppliers" id="allowed_suppliers"
                                        value="{{ !empty($package->allowed_suppliers) ? $package->allowed_suppliers : old('allowed_suppliers', '') }}"
                                        placeholder="@lang('dashboard.allowed_suppliers_ph')"><i> -1 = unlimited</i>
                                    <span class="text-danger">
                                        @error('allowed_suppliers')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="allowed_purchaseorders">@lang('dashboard.allowed_purchaseorders')</label>
                                    <input type="text" class="form-control" name="allowed_purchaseorders" id="allowed_purchaseorders"
                                        value="{{ !empty($package->allowed_purchaseorders) ? $package->allowed_purchaseorders : old('allowed_purchaseorders', '') }}"
                                        placeholder="@lang('dashboard.allowed_purchaseorders_ph')"><i> -1 = unlimited</i>
                                    <span class="text-danger">
                                        @error('allowed_purchaseorders')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="allowed_salesinvoices">@lang('dashboard.allowed_salesinvoices')</label>
                                    <input type="text" class="form-control" name="allowed_salesinvoices" id="allowed_salesinvoices"
                                        value="{{ !empty($package->allowed_salesinvoices) ? $package->allowed_salesinvoices : old('allowed_salesinvoices', '') }}"
                                        placeholder="@lang('dashboard.allowed_salesinvoices_ph')"><i> -1 = unlimited</i>
                                    <span class="text-danger">
                                        @error('allowed_salesinvoices')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <label for="allowed_accounts">@lang('dashboard.allowed_accounts')</label>
                                    <input type="text" class="form-control" name="allowed_accounts" id="allowed_accounts"
                                        value="{{ !empty($package->allowed_accounts) ? $package->allowed_accounts : old('allowed_accounts', '') }}"
                                        placeholder="@lang('dashboard.allowed_accounts_ph')"><i> -1 = unlimited</i>
                                    <span class="text-danger">
                                        @error('allowed_accounts')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>



                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="is_active" id="is_active"
                                            value="1"
                                            {{
                                        !empty($package->is_active)?
                                         ' checked ':
                                        old('is_active',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="is_active">@lang('dashboard.is_active')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('is_active')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="module_hrm" id="module_hrm"
                                            value="1"
                                            {{
                                        !empty($package->module_hrm)?
                                         ' checked ':
                                        old('module_hrm',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="module_hrm">@lang('dashboard.module_hrm')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('module_hrm')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="module_crm" id="module_crm"
                                            value="1"
                                            {{
                                        !empty($package->module_crm)?
                                         ' checked ':
                                        old('module_crm',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="module_crm">@lang('dashboard.module_crm')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('module_crm')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="module_products" id="module_products"
                                            value="1"
                                            {{
                                        !empty($package->module_products)?
                                         ' checked ':
                                        old('module_products',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="module_products">@lang('dashboard.module_products')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('module_products')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="module_purchase" id="module_purchase"
                                            value="1"
                                            {{
                                        !empty($package->module_purchase)?
                                         ' checked ':
                                        old('module_purchase',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="module_purchase">@lang('dashboard.module_purchase')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('module_purchase')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="module_inventroy" id="module_inventroy"
                                            value="1"
                                            {{
                                        !empty($package->module_inventroy)?
                                         ' checked ':
                                        old('module_inventroy',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="module_inventroy">@lang('dashboard.module_inventroy')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('module_inventroy')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="module_sales" id="module_sales"
                                            value="1"
                                            {{
                                        !empty($package->module_sales)?
                                         ' checked ':
                                        old('module_sales',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="module_sales">@lang('dashboard.module_sales')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('module_sales')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="module_accounts" id="module_accounts"
                                            value="1"
                                            {{
                                        !empty($package->module_accounts)?
                                         ' checked ':
                                        old('module_accounts',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="module_accounts">@lang('dashboard.module_accounts')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('module_accounts')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>




<!-- ------------------------------------------------ -->


                            </div>

                        </div><!-- ./row -->
                        <!-- ------------------------------------------------------------------------------------------------ -->
                    </div><!-- ./card-body -->

                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-primary">@lang('dashboard.submit_button')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        });
    </script>
@endpush
