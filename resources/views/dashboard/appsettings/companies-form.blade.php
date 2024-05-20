@extends('layouts.dashboard-master')

{{-- Set Dashboard Title --}}
@section('title', 'Dashboard - Companies')

{{-- *** Add styles and scripts to the header of the master layout for this form *** --}}
@push('header-scripts-and-styles')
    {{-- *** your scripts and styles here *** --}}
    @include('dashboard.datatables-header-scripts-and-styles')
@endpush

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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.companies_form_title')</h3>
                    <a href="{{ url('/') }}/companies">
                        <button type="button" class="btn btn-primary btn-xs float-right" id="btn_view_all"><i
                                class="fa fa-list "></i> View All</button>
                    </a>
                </div>

                <!-- /.card-header -->
                <!-- form start -->
                @php
                $action_url = url('/companies');
                //reset submit url if edit form is loaded
                if (!empty($company->company_id)) {
                    $action_url = url('/companies').'/'.$company->company_id;
                }
                @endphp
                <form action="{{ $action_url }}" method="POST">
                   @csrf
                    @php
                        if (!empty($company->company_id)) {
                            echo method_field('PUT');
                        }
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="company_name">@lang('dashboard.company_name')</label>
                                    <input type="text" class="form-control" name="company_name" id="company_name"
                                        value="{{ !empty($company->company_name)?$company->company_name:old('company_name',"") }}"
                                        placeholder="@lang('dashboard.company_name_ph')">
                                    <span class="text-danger">
                                        @error('company_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="registration_number">@lang('dashboard.registration_number')</label>
                                    <input type="text" class="form-control" name="registration_number"
                                        id="registration_number" value="{{
                                        !empty($company->registration_number)?
                                        $company->registration_number:
                                        old('registration_number',"")
                                        }}"
                                        placeholder="@lang('dashboard.registration_number_ph')">
                                    <span class="text-danger">
                                        @error('landmark')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="address">@lang('dashboard.address')</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        value="{{
                                        !empty($company->address)?
                                        $company->address:
                                        old('address',"")
                                        }}" placeholder="@lang('dashboard.address_ph')">
                                    <span class="text-danger">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city">@lang('dashboard.city')</label>
                                    <input type="text" class="form-control" name="city" id="city"
                                        value="{{
                                        !empty($company->city)?
                                        $company->city:
                                        old('city',"")
                                        }}" placeholder="@lang('dashboard.city_ph')">
                                    <span class="text-danger">
                                        @error('city')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div><!-- ./row -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="state">@lang('dashboard.state')</label>
                                    <input type="text" class="form-control" name="state" id="state"
                                        value="{{
                                        !empty($company->state)?
                                        $company->state:
                                        old('state',"")
                                        }}" placeholder="@lang('dashboard.state_ph')">
                                    <span class="text-danger">
                                        @error('state')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="landmark">@lang('dashboard.landmark')</label>
                                    <input type="text" class="form-control" name="landmark" id="landmark"
                                        value="{{
                                        !empty($company->landmark)?
                                        $company->landmark:
                                        old('landmark',"")
                                        }}" placeholder="@lang('dashboard.landmark_ph')">
                                    <span class="text-danger">
                                        @error('landmark')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="zip_code">@lang('dashboard.zip_code')</label>
                                    <input type="text" class="form-control" name="zip_code" id="zip_code"
                                        value="{{
                                        !empty($company->zip_code)?
                                        $company->zip_code:
                                        old('zip_code',"")
                                        }}" placeholder="@lang('dashboard.zip_code_ph')">
                                    <span class="text-danger">
                                        @error('zip_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
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
                            </div>
                        </div><!-- ./row -->

                        <div class="row">
                            <div class="col-md-12">


                                <div class="form-group">
                                    <label for="logo">@lang('dashboard.logo')</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo" id="logo">
                                            <label class="custom-file-label"
                                                for="logo">@lang('dashboard.logo_ph')</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <span class="text-danger">
                                        @error('logo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>



                            </div>
                        </div><!-- ./row -->


                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tax1_name">@lang('dashboard.tax1_name')</label>
                                    <input type="text" class="form-control" name="tax1_name" id="tax1_name"
                                        value="{{
                                        !empty($company->tax1_name)?
                                        $company->tax1_name:
                                        old('tax1_name',"")
                                        }}" placeholder="@lang('dashboard.tax1_name_ph')">
                                    <span class="text-danger">
                                        @error('tax1_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tax1_number">@lang('dashboard.tax1_number')</label>
                                    <input type="text" class="form-control" name="tax1_number" id="tax1_number"
                                        value="{{
                                        !empty($company->tax1_number)?
                                        $company->tax1_number:
                                        old('tax1_number',"")
                                        }}" placeholder="@lang('dashboard.tax1_number_ph')">
                                    <span class="text-danger">
                                        @error('tax1_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tax2_name">@lang('dashboard.tax2_name')</label>
                                    <input type="text" class="form-control" name="tax2_name" id="tax2_name"
                                        value="{{
                                        !empty($company->tax2_name)?
                                        $company->tax2_name:
                                        old('tax2_name',"")
                                        }}" placeholder="@lang('dashboard.tax2_name')">
                                    <span class="text-danger">
                                        @error('tax2_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tax2_number">@lang('dashboard.tax2_number')</label>
                                    <input type="text" class="form-control" name="tax2_number" id="tax2_number"
                                        value="{{
                                        !empty($company->tax2_number)?
                                        $company->tax2_number:
                                        old('tax2_number',"")
                                        }}" placeholder="@lang('dashboard.tax2_number_ph')">
                                    <span class="text-danger">
                                        @error('tax2_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                        </div><!-- ./row -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="phone_number">@lang('dashboard.phone_number')</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number"
                                        value="{{
                                        !empty($company->phone_number)?
                                        $company->phone_number:
                                        old('phone_number',"")
                                        }}"
                                        placeholder="@lang('dashboard.phone_number_ph')">
                                    <span class="text-danger">
                                        @error('phone_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_number">@lang('dashboard.contact_number')</label>
                                    <input type="text" class="form-control" name="contact_number" id="contact_number"
                                        value="{{
                                        !empty($company->contact_number)?
                                        $company->contact_number:
                                        old('contact_number',"")
                                        }}"
                                        placeholder="@lang('dashboard.contact_number_ph')">
                                    <span class="text-danger">
                                        @error('contact_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="email">@lang('dashboard.email')</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{
                                        !empty($company->email)?
                                        $company->email:
                                        old('email',"")
                                        }}" placeholder="@lang('dashboard.email_ph')">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sku_prefix">@lang('dashboard.sku_prefix')</label>
                                    <input type="text" class="form-control" name="sku_prefix" id="sku_prefix"
                                        value="{{
                                        !empty($company->sku_prefix)?
                                        $company->sku_prefix:
                                        old('sku_prefix',"")
                                        }}" placeholder="@lang('dashboard.sku_prefix_ph')">
                                    <span class="text-danger">
                                        @error('sku_prefix')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>



                        </div><!-- ./row -->

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="time_zone">@lang('dashboard.time_zone')</label>
                                    <select name="time_zone" id="time_zone"
                                        class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;"
                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @php
                                            $time_zones = DateTimeZone::listIdentifiers(); //Get Default System Level Time zones List
                                            foreach ($time_zones as $time_zone => $value) {
                                                # code...
                                                echo "<option value='" . $value . "'>" . $value . '</option>';
                                            }
                                        @endphp
                                    </select>

                                    <span class="text-danger">
                                        @error('time_zone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_format">@lang('dashboard.date_format')</label>
                                    <select name="date_format" id="date_format" class="form-control">
                                        <option value="d/m/y" selected>d/m/y (eg.23/09/2023)</option>
                                        <option value="d-m-y">d-m-y (eg.23-09-2023)</option>
                                        <option value="m/d/y">m/d/y (eg.09/23/2023)</option>
                                        <option value="m-d-y">m-d-y (eg.09-23-2023)</option>
                                    </select>

                                    <span class="text-danger">
                                        @error('date_format')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="time_format">@lang('dashboard.time_format')</label>
                                    <select name="time_format" id="time_format" class="form-control">
                                        <option value="12" selected>12 Hours (AM/PM)</option>
                                        <option value="24">24 Hours</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('time_format')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fy_start_month">@lang('dashboard.fy_start_month')</label>
                                    <select name="fy_start_month" id="fy_start_month" class="form-control">
                                        <option value="1" selected>January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('fy_start_month')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                        </div><!-- ./row -->

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="default_profit_percent">@lang('dashboard.default_profit_percent')</label>
                                    <input type="text" class="form-control" name="default_profit_percent"
                                        id="default_profit_percent" value="{{
                                        !empty($company->default_profit_percent)?
                                        $company->default_profit_percent:
                                        old('default_profit_percent',"")
                                        }}"
                                        placeholder="@lang('dashboard.default_profit_percent_ph')">
                                    <span class="text-danger">
                                        @error('default_profit_percent')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label
                                        for="default_sales_discount_percent">@lang('dashboard.default_sales_discount_percent')</label>
                                    <input type="text" class="form-control" name="default_sales_discount_percent"
                                        id="default_sales_discount_percent"
                                        value="{{
                                        !empty($company->default_sales_discount_percent)?
                                        $company->default_sales_discount_percent:
                                        old('default_sales_discount_percent',"")
                                        }}"
                                        placeholder="@lang('dashboard.default_sales_discount_percent_ph')">
                                    <span class="text-danger">
                                        @error('default_sales_discount_percent')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label
                                        for="default_sales_tax_percent">@lang('dashboard.default_sales_tax_percent')</label>
                                    <input type="text" class="form-control" name="default_sales_tax_percent"
                                        id="default_sales_tax_percent" value="{{
                                        !empty($company->default_sales_tax_percent)?
                                        $company->default_sales_tax_percent:
                                        old('default_sales_tax_percent',"")
                                        }}"
                                        placeholder="@lang('dashboard.default_sales_tax_percent_ph')">
                                    <span class="text-danger">
                                        @error('default_sales_tax_percent')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="default_barcode_type">@lang('dashboard.default_barcode_type')</label>
                                    <select name="default_barcode_type" id="default_barcode_type" class="form-control">
                                        <option value="C128" selected="selected">Code 128 (C128)</option>
                                        <option value="C39">Code 39 (C39)</option>
                                        <option value="EAN13">EAN-13</option>
                                        <option value="EAN8">EAN-8</option>
                                        <option value="UPCA">UPC-A</option>
                                        <option value="UPCE">UPC-E</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('time_format')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                        </div><!-- ./row -->



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pos_settings">@lang('dashboard.pos_settings')</label>
                                    <textarea rows="3" class="form-control" name="pos_settings" id="pos_settings"
                                        placeholder="@lang('dashboard.pos_settings_ph')">
                                    {{
                                        !empty($company->pos_settings)?
                                        $company->pos_settings:
                                        old('pos_settings',"")
                                    }}
                                    </textarea>

                                    <span class="text-danger">
                                        @error('pos_settings')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="email_settings">@lang('dashboard.email_settings')</label>
                                    <textarea rows="3" class="form-control" name="email_settings" id="email_settings"
                                        placeholder="@lang('dashboard.email_settings_ph')">
                                        {{
                                        !empty($company->email_settings)?
                                        $company->email_settings:
                                        old('email_settings',"")
                                        }}
                                    </textarea>
                                    <span class="text-danger">
                                        @error('email_settings')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sms_settings">@lang('dashboard.sms_settings')</label>
                                    <textarea rows="3" class="form-control" name="sms_settings" id="sms_settings"
                                        placeholder="@lang('dashboard.sms_settings_ph')">
                                        {{
                                        !empty($company->sms_settings)?
                                        $company->sms_settings:
                                        old('sms_settings',"")
                                        }}
                                    </textarea>
                                    <span class="text-danger">
                                        @error('sms_settings')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="common_settings">@lang('dashboard.common_settings')</label>
                                    <textarea rows="3" class="form-control" name="common_settings" id="common_settings"
                                        placeholder="@lang('dashboard.common_settings_ph')">
                                    {{
                                        !empty($company->common_settings)?
                                        $company->common_settings:
                                        old('common_settings',"")
                                        }}
                                    </textarea>
                                    <span class="text-danger">
                                        @error('common_settings')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div><!-- ./row -->




                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="website">@lang('dashboard.website')</label>
                                    <input type="text" class="form-control" name="website" id="website"
                                        value="{{
                                        !empty($company->website)?
                                        $company->website:
                                        old('website',"")
                                        }}" placeholder="@lang('dashboard.website_ph')">
                                    <span class="text-danger">
                                        @error('website')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="webfront_theme">@lang('dashboard.webfront_theme')</label>
                                    <select name="webfront_theme" id="webfront_theme" class="form-control">
                                        <option value="default">Default</option>
                                        <option value="ecommerce">E-Commerce</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('webfront_theme')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="webfront_public_code">@lang('dashboard.webfront_public_code')</label>
                                    <input type="text" class="form-control" name="webfront_public_code" id="webfront_public_code"
                                        value="{{
                                        !empty($company->webfront_public_code)?
                                        $company->webfront_public_code:
                                        old('webfront_public_code',Str::random(40))
                                        }}"
                                        placeholder="@lang('dashboard.webfront_public_code_ph')">
                                    <span class="text-danger">
                                        @error('webfront_public_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>



                        </div><!-- ./row -->


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label
                                        for="currency_symbol_placement">@lang('dashboard.currency_symbol_placement')</label>
                                    <select name="currency_symbol_placement" id="currency_symbol_placement"
                                        class="form-control">
                                        <option value="before">Before</option>
                                        <option value="after">After</option>
                                    </select>


                                    <span class="text-danger">
                                        @error('currency_symbol_placement')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="stock_accounting_method">@lang('dashboard.stock_accounting_method')</label>
                                    <select name="stock_accounting_method" id="stock_accounting_method"
                                        class="form-control">
                                        <option value="fifo" selected>FIFO (First In First Out)</option>
                                        <option value="lifo">LIFO (Last In First Out)</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('stock_accounting_method')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div><!-- ./row -->


                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <div class="custom-control custom-switch">
                                        <input name="enable_purchase" id="enable_purchase"
                                            value="{{
                                        !empty($company->enable_purchase)?
                                        $company->enable_purchase:
                                        old('enable_purchase',"1")
                                        }}"
                                            {{
                                        !empty($company->enable_purchase)?
                                        ' checked'  :
                                        old('enable_purchase','')
                                        }}
                                            type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label"
                                            for="enable_purchase">@lang('dashboard.enable_purchase')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('enable_purchase')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>



                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="enable_product_expiry" id="enable_product_expiry"
                                            value="{{
                                        !empty($company->enable_product_expiry)?
                                        $company->enable_product_expiry:
                                        old('enable_product_expiry',"1")
                                        }}"
                                            {{
                                        !empty($company->enable_product_expiry)?
                                         ' checked ' :
                                        old('enable_product_expiry',"")
                                        }}
                                            type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label"
                                            for="enable_product_expiry">@lang('dashboard.enable_product_expiry')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('enable_product_expiry')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="enable_price_tax" id="enable_price_tax"
                                            value="{{
                                        !empty($company->enable_price_tax)?
                                        $company->enable_price_tax:
                                        old('enable_price_tax',"1")
                                        }}"
                                            {{
                                        !empty($company->enable_price_tax)?
                                         ' checked ':
                                        old('enable_price_tax',"")
                                        }}
                                            type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label"
                                            for="enable_price_tax">@lang('dashboard.enable_price_tax')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('enable_price_tax')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="enable_category" id="enable_category"
                                            value="{{
                                        !empty($company->enable_category)?
                                        $company->enable_category:
                                        old('enable_category',"1")
                                        }}"
                                            {{
                                        !empty($company->enable_category)?
                                        ' checked ':
                                        old('enable_category',"")
                                        }}
                                            type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label"
                                            for="enable_category">@lang('dashboard.enable_category')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('enable_category')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="enable_sub_category" id="enable_sub_category"
                                            value="{{
                                        !empty($company->enable_sub_category)?
                                        $company->enable_sub_category:
                                        old('enable_sub_category',"1")
                                        }}"
                                            {{
                                        !empty($company->enable_sub_category)?
                                         ' checked ':
                                        old('enable_sub_category',"")
                                        }}
                                            type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label"
                                            for="enable_sub_category">@lang('dashboard.enable_sub_category')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('enable_sub_category')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="enable_brand" id="enable_brand"
                                            value="{{
                                        !empty($company->enable_brand)?
                                        $company->enable_brand:
                                        old('enable_brand',"1")
                                        }}"
                                            {{
                                        !empty($company->enable_brand)?
                                         ' checked ':
                                        old('enable_brand',"")
                                        }}
                                            type="checkbox" class="custom-control-input">

                                        <label class="custom-control-label"
                                            for="enable_brand">@lang('dashboard.enable_brand')</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('enable_brand')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>



                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="is_active" id="is_active"
                                            value="{{
                                        !empty($company->is_active)?
                                        $company->is_active:
                                        old('is_active',"1")
                                        }}"
                                            {{
                                        !empty($company->is_active)?
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


<script src="{{ asset('dashboard_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(function () {
                bsCustomFileInput.init();
            });
        });
    </script>
@endpush
