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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.countries_form_title')</h3>
                    <a href="{{ url('/') }}/countries">
                        <button type="button" class="btn btn-primary btn-xs float-right" id="btn_view_all"><i
                                class="fa fa-list "></i> View All</button>
                    </a>
                </div>

                <!-- /.card-header -->
                <!-- form start -->
                @php
                $action_url = url('/countries');
                //reset submit url if edit form is loaded
                if (!empty($country->country_id)) {
                    $action_url = url('/countries').'/'.$country->country_id;
                }
                @endphp

                <form action="{{$action_url}}" method="POST">
                    @csrf
                    @php
                        if (!empty($country->country)) {
                            echo method_field('PUT');
                        }
                    @endphp
                <form action="{{ url('/') }}/countries" method="POST" >
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">@lang('dashboard.country')</label>
                                    <input type="text" class="form-control" name="country" id="country"
                                        value="{{ !empty($country->country)?$country->country:old('country',"") }}"
                                        placeholder="@lang('dashboard.country_ph')">
                                    <span class="text-danger">
                                        @error('country')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency">@lang('dashboard.currency')</label>
                                    <input type="text" class="form-control" name="currency" id="currency"
                                     value="{{ !empty($country->currency)?$country->currency:old('currency',"") }}"
                                     placeholder="@lang('dashboard.currency_ph')">
                                    <span class="text-danger">
                                        @error('currency')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency_code">@lang('dashboard.currency_code')</label>
                                    <input type="text" class="form-control" name="currency_code" id="currency_code"
                                     value="{{ !empty($country->currency_code)?$country->currency_code:old('currency_code',"") }}"
                                     placeholder="@lang('dashboard.currency_code_ph')">
                                    <span class="text-danger">
                                        @error('currency_code')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency_symbol">@lang('dashboard.currency_symbol')</label>
                                    <input type="text" class="form-control" name="currency_symbol" id="currency_symbol"
                                     value="{{ !empty($country->currency_symbol)?$country->currency_symbol:old('currency_symbol',"") }}"
                                      placeholder="@lang('dashboard.currency_symbol_ph')">
                                    <span class="text-danger">
                                        @error('currency_symbol')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thousand_separator">@lang('dashboard.thousand_separator')</label>
                                    <input type="text" class="form-control" name="thousand_separator"
                                     value="{{ !empty($country->thousand_separator)?$country->thousand_separator:old('thousand_separator',"") }}"
                                       id="thousand_separator" placeholder="@lang('dashboard.thousand_separator_ph')">
                                    <span class="text-danger">
                                        @error('thousand_separator')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="decimal_separator">@lang('dashboard.decimal_separator')</label>
                                    <input type="text" class="form-control" name="decimal_separator"
                                     value="{{ !empty($country->decimal_separator)?$country->decimal_separator:old('decimal_separator',"") }}"
                                        id="decimal_separator" placeholder="@lang('dashboard.decimal_separator_ph')">
                                    <span class="text-danger">
                                        @error('decimal_separator')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-primary">@lang('dashboard.submit_button')</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
@endpush
