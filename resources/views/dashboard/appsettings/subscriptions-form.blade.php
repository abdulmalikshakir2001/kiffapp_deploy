@extends('layouts.dashboard-master')

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Subscriptions')

{{-- *** Add styles and scripts to the header of the master layout for this form *** --}}
@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

{{-- Add Dashboard breadcrumb Links --}}
@push('breadcrumb')
    <li class="breadcrumb-item ative">Subscribe Now</a></li>
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
                    <a href="{{ url('/') }}/subscriptions">
                        <button type="button" class="btn btn-primary btn-xs float-right" id="btn_view_all"><i
                                class="fa fa-list "></i> View All</button>
                    </a>
                </div>

                <!-- /.card-header -->
                <!-- form start -->
                @php
                    $action_url = url('/subscriptions');
                    //reset submit url if edit form is loaded
                    if (!empty($package->package_id)) {
                        $action_url = url('/subscriptions') . '/' . $package->package_id;
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



                                    <div class="form-group">
                                        <label for="package_id">@lang('dashboard.package_name')</label>
                                        <select name="package_id" id="package_id"
                                            class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->package_id }}"
                                                    @if(!empty($package->package_id) && $package->package_id==$package->package_id)
                                                    selected
                                                    @endif
                                                    data-select2-id="{{ $package->package_id }}">
                                                    {{ $package->package_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('package_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>




                                <div class="form-group">
                                    <label for="start_date">@lang('dashboard.start_date')</label>
                                    <input type="text" class="form-control" name="start_date" id="start_date"
                                        value="{{ !empty($package->start_date) ? $package->start_date : old('start_date', '') }}"
                                        placeholder="@lang('dashboard.start_date_ph')">
                                    <span class="text-danger">
                                        @error('start_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>



                                <div class="form-group">
                                    <label for="end_date">@lang('dashboard.end_date')</label>
                                    <input type="text" class="form-control" name="end_date" id="end_date"
                                        value="{{ !empty($package->end_date) ? $package->end_date : old('end_date', '') }}"
                                        placeholder="@lang('dashboard.end_date_ph')">
                                    <span class="text-danger">
                                        @error('end_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="trial_ends_date">@lang('dashboard.trial_ends_date')</label>
                                    <input type="text" class="form-control" name="trial_ends_date" id="trial_ends_date"
                                        value="{{ !empty($package->trial_ends_date) ? $package->trial_ends_date : old('trial_ends_date', '') }}"
                                        placeholder="@lang('dashboard.trial_ends_date_ph')">
                                    <span class="text-danger">
                                        @error('trial_ends_date')
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
                                    <label for="status">@lang('dashboard.status')</label>

                                    <select name="status">
                                        <option value="Pending" {{ !empty($package->status) && $package->status=='Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Declined" {{ !empty($package->status) && $package->status=='Declined' ? 'selected' : '' }}>Declined</option>
                                        <option value="Approved" {{ !empty($package->status) && $package->status=='Approved' ? 'selected' : '' }}>Approved</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>




                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="is_paid_offline" id="is_paid_offline"
                                            value="1"
                                            {{
                                        !empty($package->is_paid_offline)?
                                         ' checked ':
                                        old('is_paid_offline',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="is_paid_offline">@lang('dashboard.is_paid_offline')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('is_paid_offline')
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
