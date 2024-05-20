@extends('layouts.dashboard-master')

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Users')

{{-- *** Add styles and scripts to the header of the master layout for this form *** --}}
@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.users_form_title')</h3>
                    <a href="{{ url('/') }}/users">
                        <button type="button" class="btn btn-primary btn-xs float-right" id="btn_view_all"><i
                                class="fa fa-list "></i> View All</button>
                    </a>
                </div>

                <!-- /.card-header -->
                <!-- form start -->
                @php
                    $action_url = url('/users');
                    //reset submit url if edit form is loaded
                    if (!empty($users->user_id)) {
                        $action_url = url('/users') . '/' . $users->user_id;
                    }
                @endphp
                <form action="{{ $action_url }}" method="POST">
                    @csrf
                    @php
                        if (!empty($users->user_id)) {
                            echo method_field('PUT');
                        }
                    @endphp
                    <div class="card-body">

                        <!-- --------------------------------------------------------------------------------------- -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="username">@lang('dashboard.username')</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="{{ !empty($users->username) ? $users->username : old('username', '') }}"
                                        placeholder="@lang('dashboard.username_ph')">
                                    <span class="text-danger">
                                        @error('username')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="email">@lang('dashboard.email')</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ !empty($users->email) ? $users->email : old('email', '') }}"
                                        placeholder="@lang('dashboard.email_ph')">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="password">@lang('dashboard.password')</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="{{ old('password', '') }}"
                                        placeholder="@lang('dashboard.password_ph')">
                                        @if ( !empty($users->password) )
                                            <span class="text-info">
                                                Leave empty if you do not want to change passowrd<br>
                                            </span>
                                        @endif

                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="password_confirmation">@lang('dashboard.password_confirmation')</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation"
                                        value="{{ !empty($users->password_confirmation) ? $users->password_confirmation : old('password_confirmation', '') }}"
                                        placeholder="@lang('dashboard.password_confirmation_ph')">
                                    @if ( !empty($users->password))

                                            <span class="text-info">
                                                Leave empty if you do not want to change passowrd<br>
                                            </span>
                                        @endif
                                    <span class="text-danger">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="first_name">@lang('dashboard.first_name')</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        value="{{ !empty($users->first_name) ? $users->first_name : old('first_name', '') }}"
                                        placeholder="@lang('dashboard.first_name_ph')">
                                    <span class="text-danger">
                                        @error('first_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_names">@lang('dashboard.middle_names')</label>
                                    <input type="text" class="form-control" name="middle_names" id="middle_names"
                                        value="{{ !empty($users->middle_names) ? $users->middle_names : old('middle_names', '') }}"
                                        placeholder="@lang('dashboard.middle_names_ph')">
                                    <span class="text-danger">
                                        @error('middle_names')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="last_name">@lang('dashboard.last_name')</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        value="{{ !empty($users->group_name) ? $users->group_name : old('last_name', '') }}"
                                        placeholder="@lang('dashboard.last_name_ph')">
                                    <span class="text-danger">
                                        @error('last_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dob">@lang('dashboard.dob')</label>
                                    <div class="input-group date" id="dob" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#dob"
                                            value="{{ !empty($users->dob) ? $users->dob : old('dob', '') }}" name="dob"
                                            placeholder="@lang('dashboard.dob')">
                                        <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>


                                    <span class="text-danger">
                                        @error('dob')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="blood_group">@lang('dashboard.blood_group')</label>

                                    <select name="blood_group" id="blood_group">
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="Unknown">Unknown</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('blood_group')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">@lang('dashboard.gender')</label>
                                    <select name="gender" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>

                                    <span class="text-danger">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="marital_status">@lang('dashboard.marital_status')</label>
                                    <select name="marital_status" id="marital_status">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Undisclosed">Undisclosed</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('marital_status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address">@lang('dashboard.address')</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        value="{{ !empty($users->address) ? $users->address : old('address', '') }}"
                                        placeholder="@lang('dashboard.address_ph')">
                                    <span class="text-danger">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="zip_code">@lang('dashboard.zip_code')</label>
                                    <input type="text" class="form-control" name="zip_code" id="zip_code"
                                        value="{{ !empty($users->zip_code) ? $users->zip_code : old('zip_code', '') }}"
                                        placeholder="@lang('dashboard.zip_code_ph')">
                                    <span class="text-danger">
                                        @error('zip_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city">@lang('dashboard.city')</label>
                                    <input type="text" class="form-control" name="city" id="city"
                                        value="{{ !empty($users->city) ? $users->city : old('city', '') }}"
                                        placeholder="@lang('dashboard.city_ph')">
                                    <span class="text-danger">
                                        @error('city')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="state">@lang('dashboard.state')</label>
                                    <input type="text" class="form-control" name="state" id="state"
                                        value="{{ !empty($users->state) ? $users->state : old('state', '') }}"
                                        placeholder="@lang('dashboard.state_ph')">
                                    <span class="text-danger">
                                        @error('state')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="landmark">@lang('dashboard.landmark')</label>
                                    <input type="text" class="form-control" name="landmark" id="landmark"
                                        value="{{ !empty($users->landmark) ? $users->landmark : old('landmark', '') }}"
                                        placeholder="@lang('dashboard.landmark_ph')">
                                    <span class="text-danger">
                                        @error('landmark')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">

                                    <label for="country_id">@lang('dashboard.country')</label>
                                    <select name="country_id" id="country_id"
                                        class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;"
                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->country_id }}"
                                                data-select2-id="{{ $country->country_id }}">{{ $country->country }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('country_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="mobile_number">@lang('dashboard.mobile_number')</label>
                                    <input type="text" class="form-control" name="mobile_number" id="mobile_number"
                                        value="{{ !empty($users->mobile_number) ? $users->mobile_number : old('mobile_number', '') }}"
                                        placeholder="@lang('dashboard.mobile_number_ph')">
                                    <span class="text-danger">
                                        @error('mobile_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="phone_number">@lang('dashboard.phone_number')</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number"
                                        value="{{ !empty($users->phone_number) ? $users->phone_number : old('phone_number', '') }}"
                                        placeholder="@lang('dashboard.phone_number_ph')">
                                    <span class="text-danger">
                                        @error('phone_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bank_details">@lang('dashboard.bank_details')</label>
                                    <input type="text" class="form-control" name="bank_details" id="bank_details"
                                        value="{{ !empty($users->bank_details) ? $users->bank_details : old('bank_details', '') }}"
                                        placeholder="@lang('dashboard.bank_details_ph')">
                                    <span class="text-danger">
                                        @error('bank_details')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tax_number">@lang('dashboard.tax_number')</label>
                                    <input type="text" class="form-control" name="tax_number" id="tax_number"
                                        value="{{ !empty($users->tax_number) ? $users->tax_number : old('tax_number', '') }}"
                                        placeholder="@lang('dashboard.tax_number_ph')">
                                    <span class="text-danger">
                                        @error('tax_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="employee_no">@lang('dashboard.employee_no')</label>
                                    <input type="text" class="form-control" name="employee_no" id="employee_no"
                                        value="{{ !empty($users->employee_no) ? $users->employee_no : old('employee_no', '') }}"
                                        placeholder="@lang('dashboard.employee_no_ph')">
                                    <span class="text-danger">
                                        @error('employee_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="credit_limit">@lang('dashboard.credit_limit')</label>
                                    <input type="text" class="form-control" name="credit_limit" id="credit_limit"
                                        value="{{ !empty($users->credit_limit) ? $users->credit_limit : old('credit_limit', '') }}"
                                        placeholder="@lang('dashboard.credit_limit_ph')">
                                    <span class="text-danger">
                                        @error('credit_limit')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fb_link">@lang('dashboard.fb_link')</label>
                                    <input type="text" class="form-control" name="fb_link" id="fb_link"
                                        value="{{ !empty($users->fb_link) ? $users->fb_link : old('fb_link', '') }}"
                                        placeholder="@lang('dashboard.fb_link')">
                                    <span class="text-danger">
                                        @error('fb_link')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="twitter_link">@lang('dashboard.twitter_link')</label>
                                    <input type="text" class="form-control" name="twitter_link" id="twitter_link"
                                        value="{{ !empty($users->twitter_link) ? $users->twitter_link : old('twitter_link', '') }}"
                                        placeholder="@lang('dashboard.twitter_link')">
                                    <span class="text-danger">
                                        @error('twitter_link')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="social_media_1">@lang('dashboard.social_media_1')</label>
                                    <input type="text" class="form-control" name="social_media_1" id="social_media_1"
                                        value="{{ !empty($users->social_media_1) ? $users->social_media_1 : old('social_media_1', '') }}"
                                        placeholder="@lang('dashboard.social_media_1')">
                                    <span class="text-danger">
                                        @error('social_media_1')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="social_media_2">@lang('dashboard.social_media_2')</label>
                                    <input type="text" class="form-control" name="social_media_2" id="social_media_2"
                                        value="{{ !empty($users->social_media_2) ? $users->social_media_2 : old('social_media_2', '') }}"
                                        placeholder="@lang('dashboard.social_media_2')">
                                    <span class="text-danger">
                                        @error('social_media_2')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="social_media_3">@lang('dashboard.social_media_3')</label>
                                    <input type="text" class="form-control" name="social_media_3" id="social_media_3"
                                        value="{{ !empty($users->social_media_3) ? $users->social_media_3 : old('social_media_3', '') }}"
                                        placeholder="@lang('dashboard.social_media_3')">
                                    <span class="text-danger">
                                        @error('social_media_3')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="social_media_4">@lang('dashboard.social_media_4')</label>
                                    <input type="text" class="form-control" name="social_media_4" id="social_media_4"
                                        value="{{ !empty($users->social_media_4) ? $users->social_media_4 : old('social_media_4', '') }}"
                                        placeholder="@lang('dashboard.social_media_4')">
                                    <span class="text-danger">
                                        @error('social_media_4')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_1">@lang('dashboard.custom_field_1')</label>
                                    <input type="text" class="form-control" name="custom_field_1" id="custom_field_1"
                                        value="{{ !empty($users->custom_field_1) ? $users->custom_field_1 : old('custom_field_1', '') }}"
                                        placeholder="@lang('dashboard.custom_field_1')">
                                    <span class="text-danger">
                                        @error('custom_field_1')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_2">@lang('dashboard.custom_field_2')</label>
                                    <input type="text" class="form-control" name="custom_field_2" id="custom_field_2"
                                        value="{{ !empty($users->custom_field_2) ? $users->custom_field_2 : old('custom_field_2', '') }}"
                                        placeholder="@lang('dashboard.custom_field_2')">
                                    <span class="text-danger">
                                        @error('custom_field_2')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_3">@lang('dashboard.custom_field_3')</label>
                                    <input type="text" class="form-control" name="custom_field_3" id="custom_field_3"
                                        value="{{ !empty($users->custom_field_3) ? $users->custom_field_3 : old('custom_field_3', '') }}"
                                        placeholder="@lang('dashboard.custom_field_3')">
                                    <span class="text-danger">
                                        @error('custom_field_3')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_4">@lang('dashboard.custom_field_4')</label>
                                    <input type="text" class="form-control" name="custom_field_4" id="custom_field_4"
                                        value="{{ !empty($users->custom_field_4) ? $users->custom_field_4 : old('custom_field_4', '') }}"
                                        placeholder="@lang('dashboard.custom_field_4')">
                                    <span class="text-danger">
                                        @error('custom_field_4')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_5">@lang('dashboard.custom_field_5')</label>
                                    <input type="text" class="form-control" name="custom_field_5" id="custom_field_5"
                                        value="{{ !empty($users->custom_field_5) ? $users->custom_field_5 : old('custom_field_5', '') }}"
                                        placeholder="@lang('dashboard.custom_field_5')">
                                    <span class="text-danger">
                                        @error('custom_field_5')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_6">@lang('dashboard.custom_field_6')</label>
                                    <input type="text" class="form-control" name="custom_field_6"
                                        id="group_custom_field_6name"
                                        value="{{ !empty($users->custom_field_6) ? $users->custom_field_6 : old('custom_field_6', '') }}"
                                        placeholder="@lang('dashboard.custom_field_6')">
                                    <span class="text-danger">
                                        @error('custom_field_6')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_7">@lang('dashboard.custom_field_7')</label>
                                    <input type="text" class="form-control" name="custom_field_7" id="custom_field_7"
                                        value="{{ !empty($users->custom_field_7) ? $users->custom_field_7 : old('custom_field_7', '') }}"
                                        placeholder="@lang('dashboard.custom_field_7')">
                                    <span class="text-danger">
                                        @error('custom_field_7')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_8">@lang('dashboard.custom_field_8')</label>
                                    <input type="text" class="form-control" name="custom_field_8" id="custom_field_8"
                                        value="{{ !empty($users->custom_field_8) ? $users->custom_field_8 : old('custom_field_8', '') }}"
                                        placeholder="@lang('dashboard.custom_field_8')">
                                    <span class="text-danger">
                                        @error('custom_field_8')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_9">@lang('dashboard.custom_field_9')</label>
                                    <input type="text" class="form-control" name="custom_field_9" id="custom_field_9"
                                        value="{{ !empty($users->custom_field_9) ? $users->custom_field_9 : old('custom_field_9', '') }}"
                                        placeholder="@lang('dashboard.custom_field_9')">
                                    <span class="text-danger">
                                        @error('custom_field_9')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="custom_field_10">@lang('dashboard.custom_field_10')</label>
                                    <input type="text" class="form-control" name="custom_field_10" id="custom_field_10"
                                        value="{{ !empty($users->custom_field_10) ? $users->custom_field_10 : old('custom_field_10', '') }}"
                                        placeholder="@lang('dashboard.custom_field_10')">
                                    <span class="text-danger">
                                        @error('custom_field_10')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="company_name">@lang('dashboard.company_name')</label>
                                    <select name="company_id" id="company_id"
                                        class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;"
                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->company_id }}"
                                                @if (!empty($users->company_id) && $users->company_id == $company->company_id) selected @endif
                                                data-select2-id="{{ $company->company_id }}">
                                                {{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('company_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">

                                    <label for="position_id">@lang('dashboard.position')</label>
                                    <select name="position_id" id="position_id"
                                        class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;"
                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->position_id }}"
                                                data-select2-id="{{ $position->position_id }}">
                                                {{ $position->position_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('position_id')
                                            {{ $message }}
                                        @enderror

                                </div>
                            </div><!-- ./col ################ -->


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department_id">@lang('dashboard.department')</label>
                                    <select name="department_id" id="department_id"
                                        class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;"
                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->department_id }}"
                                                data-select2-id="{{ $department->department_id }}">
                                                {{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('department_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ui_language">@lang('dashboard.ui_language')</label>
                                    <select name="ui_language" id="ui_language">
                                        <option value="en"  @if (!empty($users->ui_language) && $users->ui_language == 'en') selected @endif>English</option>
                                        <option value="ar"  @if (!empty($users->ui_language) && $users->ui_language == 'ar') selected @endif>Arabic</option>



                                    </select>
                                    <span class="text-danger">
                                        @error('ui_language')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user_type">@lang('dashboard.user_type')</label>
                                    <select name="user_type" id="user_type">
                                        <option value="User" selected>User</option>
                                        <option value="Owner">Owner</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Supplier">Supplier</option>
                                        <option value="Customer">Customer</option>
                                        <option value="SupplierCustomer">Supplier & Customer both</option>
                                        <option value="ContactOnly">ContactOnly</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('user_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="allow_login">@lang('dashboard.allow_login')</label>
                                    <input type="checkbox" class="form-control" name="allow_login" id="allow_login"
                                        value="1"
                                         {{!empty($users->allow_login) && $users->allow_login==1 ? ' checked ' : '' }}

                                        >

                                    <span class="text-danger">
                                        @error('allow_login')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="is_active">@lang('dashboard.is_active')</label>
                                    <input type="checkbox" class="form-control" name="is_active" id="is_active"
                                        value="1"
                                        {{!empty($users->is_active) && $users->is_active==1 ? ' checked ' : '' }}
                                        >
                                    <span class="text-danger">
                                        @error('is_active')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div><!-- ./col ################ -->


                        </div><!-- ./row ************************************************ -->



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
    @include('dashboard.datatables-footer-scripts-and-styles')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(function() {
                bsCustomFileInput.init();
            });
        });

        $.ajax({
            url: 'register.php',
            type: 'post',
            data: {
                'username_check' : 1,
                'username' : username,
            },
            success: function(response){
            if (response == 'taken' ) {
                username_state = false;
                $('#username').parent().removeClass();
                $('#username').parent().addClass("form_error");
                $('#username').siblings("span").text('Sorry... Username already taken');
            }else if (response == 'not_taken') {
                username_state = true;
                $('#username').parent().removeClass();
                $('#username').parent().addClass("form_success");
                $('#username').siblings("span").text('Username available');
            }
            }
        });

        function getMessage() {
            $.ajax({
               type:'POST',
               url:'/getmsg',
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                  $("#msg").html(data.msg);
               }
            });
         }


        $('#dob').datetimepicker({
            format: 'L'
        });
    </script>
@endpush
