<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
@if (app()->getLocale() == 'ar')
<html lang="ar" dir='rtl'>
@else
<html lang="en" dir='ltr'>
@endif

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{ $title }}
    </title>
    <!-- header_links start  -->
    @include('dashboard/header_links')
    @yield('page_header_links')
    <!-- header_links start  -->
</head>

<body id="body" class="g-sidenav-show  bg-gray-100  {!! app()->getLocale() == 'ar' ? 'rtl' : '' !!}">
   



    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @if (app()->getLocale() == 'ar')
    <aside
        class="sidenav me-4 bg-white navbar navbar-vertical  navbar-expand-xs border-0 border-radius-xl fixed-end my-3 "
        id="sidenav-main">
        @else
        <aside
            class="sidenav ms-4 bg-white navbar navbar-vertical  navbar-expand-xs border-0 border-radius-xl fixed-start my-3 "
            id="sidenav-main">
            @endif
            <div class="sidenav-header" id="sidenav-header">
                
                <i class="fas fa-times p-3 cursor-pointer   position-absolute end-0 top-0 d-xl-none"
                    aria-hidden="true" id="iconSidenav"></i>

                <a class="navbar-brand m-0" href="# " target="_blank">
                    <img src="{{ asset('storage/app_logo/' . show_app_logo()) }}" class="navbar-brand-img h-100"
                        alt="main_logo">
                    <span class="ms-1 font-weight-bold">ERP</span>
                </a>
            </div>
            <!-- current -->
            <hr class="horizontal dark mt-0">
            <div class="  {{app()->getLocale() == 'ar' ? ' ps ps__rtl ps--active-y'  :'w-auto' }}  "
                id="sidenav-collapse-main">
                <ul class="navbar-nav">

                    <li class="nav-item ">
                        <a class="nav-link left-nav-link active" href="{{ route('dashboard') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">@lang('lang.dashboard')</span>
                        </a>
                    </li>
                    <!-- app setting start  -->

                    @if (Session::has('user_id'))
                    @php
                    $user_id = Session::get('user_id');
                    @endphp
                    @if ($user_id == '1')
                    <li class="nav_item_angle  nav-item" id="nav_item_angle">
                        <a class="nav-link  left-nav-link active" href="#" class="" id="app_settings">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i> -->
                                <i class="fa-solid fa-gear text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">@lang('lang.app_settings')</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user fa-user-left"></i>
                                        <a href="{{ route('users.index') }}"
                                            class="me-3 ps-3">@lang('lang.users_management')</a>
                                    </li>
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user-group "></i>
                                        <a href="{{ route('users_groups.index') }}"
                                            class="me-3 ps-3">@lang('lang.manage_groups')</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined subscription_one">
                                            subscriptions
                                        </span>
                                        <a href="{{ route('subscription_packages.index') }}"
                                            class="me-3 ps-3">@lang('lang.subscription_packages')</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined subscription_two">
                                            subscriptions
                                        </span>
                                        <a href="{{ route('subscriptions.index') }}"
                                            class="me-3 ps-3">@lang('lang.subscription')
                                        </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined apartment">
                                            apartment
                                        </span>
                                        <a href="{{ route('companies.index') }}"
                                            class="me-3 ps-3">@lang('lang.companies')</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined database">
                                            database
                                        </span>
                                        <a href="{{ route('db_backup.index') }}" class="me-3 ps-3" data-toggle="modal"
                                            data-target="#show_db_butt">@lang('lang.full_database_backup')</a>
                                    </li>
                                    <!-- web front start  -->
                                    <li class="drop_list_item_carret">
                                        <!-- new -->
                                        <a class="nav-link left-nav-link sub_drop_link" href="#" id="global_config">
                                            <div
                                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                                            </div>
                                            <span class="nav-link-text ms-1">Global Config </span>
                                            <i class="fas fa-angle-left m-auto angle"></i>
                                        </a>
                                        <!-- new -->
                                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                                            <div class="custom_dropdown_parent_child">
                                                <ul class="custom_dropdown">
                                                    <li class="drop_list_item_carret">
                                                        <a href="{{ route('change_logo') }}">Change App Logo</a>
                                                    </li>
                                                    <li class="drop_list_item_carret">
                                                        <a href="{{ route('email_settings') }}">Email Settings</a>
                                                    </li>

                                                    <li class="drop_list_item_carret"><a href="">SMS settings</a>
                                                    </li>
                                                    <li class="drop_list_item_carret"><a href="">Payment
                                                            gateways</a></li>
                                                    <li class="drop_list_item_carret"><a
                                                            href="{{ route('countries.index') }}">Countries </a></li>
                                                    <li class="drop_list_item_carret"><a href="">Users
                                                            Permissions</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- web front end -->
                                </ul>
                            </div>
                        </div>
                    </li>
                    @else
                    @endif
                    @endif

                    <!-- app setting end  -->
                    <!-- Home start  -->

                    <li class="nav-item  nav_item_angle">
                        <a class="nav-link left-nav-link active" href="#" id="home">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">@lang('lang.home')</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user fa-user-left"></i>
                                        <a href="{{ route('profile') }}" class="me-3 ps-3">@lang('lang.profile')</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined lock_reset">
                                            lock_reset
                                        </span>
                                        <a href="{{ route('change_password') }}"
                                            class="me-3 ps-3">@lang('lang.change_password')</a>
                                    </li>

                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="" class="me-3 ps-3">@lang('lang.notifications')</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined mail">
                                            mail
                                        </span>
                                        <a href="{{ route('chatify') }}" class="me-3 ps-3">@lang('lang.message') </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined task_alt">
                                            task_alt
                                        </span>
                                        <a href="{{ route('to_do_tasks.index') }}"
                                            class="me-3 ps-3">@lang('lang.to_do_task')</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="" class="me-3 ps-3">@lang('lang.notification_ref')</a>
                                    </li>
                                    <!-- <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('logout') }}" class="me-3 ps-3" id="logout_btn">@lang('lang.logout')</a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- Home end  -->
                    <!-- system settings start  -->
                    @if (session()->get('user_type') != 'JobCandidate')
                    <li class="nav-item  nav_item_angle">
                        <a class="nav-link left-nav-link active" href="javascript:void(0)" id="system_settings">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-app text-info text-sm opacity-10"></i> -->
                                <span class="material-symbols-outlined text-info" style="font-size:20px">
                                    settings
                                </span>
                            </div>
                            <span class="nav-link-text ms-1">@lang('lang.system_settings')</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user fa-user-left"></i>
                                        <a href="{{ route('users.index') }}" class="me-3 ps-3">
                                            @lang('lang.users_management') </a>
                                    </li>
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user-group"></i>
                                        <a href="{{ route('users_groups.index') }}" class="me-3 ps-3">
                                            @lang('lang.manage_groups')
                                        </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined apartment">
                                            apartment
                                        </span>

                                        <a href="{{ route('update_owner_company') }}"
                                            class="me-3 ps-3">@lang('lang.company_profile') </a>
                                    </li>
                                    <li class="drop_list_item_carret">
                                        <span class="material-symbols-outlined subscription_two">
                                            subscriptions
                                        </span>
                                        <a href="{{ route('companySubscription') }}"
                                            class="me-3 ps-3">@lang('lang.subscriptions')</a>
                                    </li>
                                    <!-- web front start  =================-->
                                    <li class="drop_list_item_carret">
                                        <!-- new -->
                                        <a class="nav-link  left-nav-link sub_drop_link" href="#" id="web_front">
                                            <div
                                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                                            </div>
                                            <span class="nav-link-text ms-1">@lang('lang.web_fronts') </span>
                                            <i class="fas fa-angle-left m-auto angle"></i>
                                        </a>
                                        <!-- new -->
                                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                                            <div class="custom_dropdown_parent_child">
                                                <ul class="custom_dropdown">
                                                    <!-- <li class="drop_list_item_carret">
                                                        <a href="">Options</a>
                                                    </li> -->
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="" class="ps-2">Options</a>
                                                    </li>


                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="{{ route('update_header') }}" class="ps-2">Header</a>
                                                    </li>

                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="{{ route('update_body') }}" class="ps-2">Main
                                                            Content</a>
                                                    </li>

                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="#" class="ps-2">Product Page</a>
                                                    </li>
                                                    <!-- <li class="drop_list_item_carret"><a href="{{ route('update_footer') }}">Footer</a></li> -->
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="{{ route('update_footer') }}" class="ps-2">Footer</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- web front end  ======================-->
                                </ul>
                            </div>
                        </div>
                    </li>
                    @endif
                    <!-- system settings end  -->




                    <!-- <li class="nav-item">
                    <a class="nav-link active" href="#" id="rtl">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">@lang('lang.change_lang')</span>
                        <i class="fas fa-angle-left m-auto angle"></i>

                    </a>


                </li> -->
                    <!--  -->

                    @if (session()->get('user_type') != 'JobCandidate')
                    <!-- human resourcses start  -->
                    {{-- @if (Session::get('user_id') != 1) --}}
                    <li class="nav-item  nav_item_angle" id="">
                        <a class="nav-link left-nav-link active" href="#" id="human_resources">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> -->
                                <span class="material-symbols-outlined group_icon">
                                    group
                                </span>
                            </div>
                            <span class="nav-link-text ms-1">Human resources</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user fa-user-left"></i>
                                        <a href="{{ route('employee.index') }}" class="me-3 ps-3">Employee</a>
                                    </li>

                                    <!-- leave management end -->
                                    <li class="drop_list_item_carret">
                                        <a class="nav-link  left-nav-link sub_drop_link" href="javascript:void"
                                            id="leave_management">
                                            <div
                                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                <span class="material-symbols-outlined airplanemode_active">
                                                    airplanemode_active
                                                </span>
                                                {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
                                            </div>
                                            <span class="nav-link-text ms-1">Leave Mangement </span>
                                            <i class="fas fa-angle-left m-auto angle"></i>
                                        </a>
                                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                                            <div class="custom_dropdown_parent_child">
                                                <ul class="custom_dropdown">
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="{{ route('hrm_week_day.index') }}" class="ps-2">Week
                                                            Days</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="{{ route('employee_leave.index') }}"
                                                            class="ps-2">Manage Leave</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span
                                                            class="material-symbols-outlined text-info holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="{{ route('public_holiday.index') }}"
                                                            class="ps-2">Manage Public Holiday</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined  work">
                                                            work
                                                        </span>
                                                        <a href="{{ route('work_shift.index') }}" class="ps-2">Manage
                                                            Work Shift</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined  work">
                                                            work
                                                        </span>
                                                        <a href="{{ route('attendence.index') }}" class="ps-2">Manage
                                                            Attendence</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- leave management end -->
                                    <!-- <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="" class="me-3 ps-3">Policies Mangement</a>
                                    </li> -->
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined mail">
                                            mail
                                        </span>
                                        <a href="{{ route('payroll.index') }}" class="me-3 ps-3">Payroll </a>
                                    </li>

                                    <!-- recruitment new-->
                                    <li class="drop_list_item_carret margin_left_10">
                                        <a class="nav-link  left-nav-link sub_drop_link" href="javascript:void"
                                            id="recruitment">
                                            <div
                                                class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
                                                <i class="fa-solid fa-list"></i>
                                            </div>
                                            <span class="nav-link-text ms-2">Recruitment </span>
                                            <i class="fas fa-angle-left m-auto angle"></i>
                                        </a>
                                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                                            <div class="custom_dropdown_parent_child">
                                                <ul class="custom_dropdown">
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="{{ route('applied_candidate.index') }}"
                                                            class="ps-2">Applied Candidate</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span
                                                            class="material-symbols-outlined text-info holiday_village">
                                                            holiday_village
                                                        </span>
                                                        <a href="{{ route('view_interview_status') }}"
                                                            class="ps-2">Interview Status</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined  work">
                                                            work
                                                        </span>
                                                        <a href="{{ route('job_vacancies.index') }}" class="ps-2">Manage
                                                            Vacancies</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- recruitment new-->




                                    <!-- <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="" class="me-3 ps-3">Configuration </a>
                                    </li> -->
                                    <!-- <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('logout') }}" class="me-3 ps-3">Report</a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- human resourcses end  -->
                    <!-- CRM  starts  -->
                    <li class="nav-item  nav_item_angle">
                        <a class="nav-link left-nav-link active" href="#" id="crm">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> -->
                                <span class="material-symbols-outlined badge_icon text-danger">
                                    badge
                                </span>
                            </div>
                            <span class="nav-link-text ms-1">CRM</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">
                                    <li class="drop_list_item_carret d-flex ">
                                        {{-- <i class="fa-solid fa-phone"></i> --}}
                                        {{-- <i class="fas fa-layer-group layer_icon"></i> --}}
                                        <span class="material-symbols-outlined dashboardIcon ">
                                            dashboard
                                        </span>
                                        <a href="{{ route('crmDashboard') }}" class="me-3 ps-3">Summary</a>
                                    </li>
                                    <li class="drop_list_item_carret">
                                        {{-- <i class="fa-solid fa-phone"></i> --}}
                                        <i class="fas fa-layer-group layer_icon"></i>
                                        <a href="{{ route('category.index') }}" class="me-3 ps-3">Lead Category</a>
                                    </li>
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-phone"></i>
                                        <a href="{{ route('contact.index') }}" class="me-3 ps-3">Contacts</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex align-items-center">
                                        {{-- <span class="material-symbols-outlined lock_reset">
                                            lock_reset
                                        </span> --}}
                                        <i class="fas fa-random"></i>
                                        <a href="{{ route('lead.index') }}" class="me-3 ps-3">Leads</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex align-items-center">
                                        <i class="fa fa-google-wallet"></i>
                                        <a href="{{ route('oppertunity.index') }}" class="me-3 ps-3">Opertunites</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex align-items-center">
                                        <i class="fa-solid fa-phone"></i>
                                        <a href="{{ route('phoneCall.index') }}" class="me-3 ps-3">Phone Calls </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex align-items-center">
                                        <i class="fa-solid fa-phone "></i>
                                        <a href="{{ route('schedulePhoneCall.index') }}" class="me-3 ps-3">Schedule
                                            Phone
                                            Calls </a>
                                    </li>
                                    {{-- <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined task_alt">
                                            task_alt
                                        </span>
                                        <a href="#" class="me-3 ps-3">Sales Forcast</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="#" class="me-3 ps-3">Sales analytics </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="#" class="me-3 ps-3">Help Disk</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- CRM end  -->
                    <!-- products   starts  -->
                    <li class="nav-item  nav_item_angle">
                        <a class="nav-link left-nav-link active" href="#" id="products">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> -->
                                <i class="fa-solid fa-box-open text-secondary fs-6"></i>
                            </div>
                            <span class="nav-link-text ms-1">Products</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user fa-user-left"></i>
                                        <a href="{{ route('proProduct.index') }}" class="me-3 ps-3">Product
                                            managment</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="" class="me-3 ps-3">Variations</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="{{ route('proWarrenty.index') }}" class="me-3 ps-3">Warranties </a>
                                    </li>


                                    {{-- subdrop down start --}}
                                    <li class="drop_list_item_carret margin_left_10">
                                        <a class="nav-link  left-nav-link sub_drop_link" href="javascript:void"
                                            id="product_settings">
                                            <div
                                                class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
                                                <i class="fas fa-cog"></i>
                                            </div>
                                            <span class="nav-link-text ms-2">Product Settings</span>
                                            <i class="fas fa-angle-left m-auto angle"></i>
                                        </a>
                                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                                            <div class="custom_dropdown_parent_child">
                                                <ul class="custom_dropdown">
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('proCategory.index') }}"
                                                            class="me-3 ps-3">Categories</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined mail">
                                                            mail
                                                        </span>
                                                        <a href="{{ route('proTax.index') }}" class="me-3 ps-3">Taxes
                                                        </a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined mail">
                                                            mail
                                                        </span>
                                                        <a href="{{ route('proUnit.index') }}" class="me-3 ps-3">Units
                                                        </a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined task_alt">
                                                            task_alt
                                                        </span>
                                                        <a href="{{ route('proBrand.index') }}"
                                                            class="me-3 ps-3">Brands</a>
                                                    </li>
                                                    {{-- add attribute --}}
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined notifications">
                                                            notifications
                                                        </span>
                                                        <a href="{{ route('proAttribute.index') }}"
                                                            class="me-3 ps-3">Add
                                                            Attribute </a>
                                                    </li>
                                                    {{-- add attribute value --}}
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined notifications">
                                                            notifications
                                                        </span>
                                                        <a href="{{ route('proAttributeValue.index') }}"
                                                            class="me-3 ps-3"> Attribute Value</a>
                                                    </li>
                                                    {{-- warehouse --}}
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined notifications">
                                                            notifications
                                                        </span>
                                                        <a href="{{ route('pur_warehouse.index') }}" class="me-3 ps-3">
                                                            Warehouse</a>
                                                    </li>
                                                    {{-- warehouse stock --}}
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined notifications">
                                                            notifications
                                                        </span>
                                                        <a href="{{ route('pur_warehouse_stock.index') }}"
                                                            class="me-3 ps-3"> Warehouse Stock</a>
                                                    </li>



                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    {{-- subdrop down end --}}








                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('logout') }}" class="me-3 ps-3">Reports</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- products  end  -->
                    <!-- purchases   starts  -->
                    <li class="nav-item  nav_item_angle">
                        <a class="nav-link left-nav-link active" href="#" id="purchase">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> -->
                                <i class="fa-solid fa-cart-shopping text-success fs-6"></i>
                            </div>
                            <span class="nav-link-text ms-1">Purchases</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user fa-user-left"></i>
                                        <a href="{{ route('pro_quotation_req.index') }}" class="me-3 ps-3">PQR</a>
                                    </li>
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user fa-user-left"></i>
                                        <a href="{{route('supplier.index')}}" class="me-3 ps-3">Suplliers</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined lock_reset">
                                            lock_reset
                                        </span>
                                        <a href="{{route('pur_purchase_quotation.index')}}" class="me-3 ps-3">Purchase
                                            Quotations</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="{{route('pur_purchase_order.index')}}" class="me-3 ps-3">Purchase
                                            Orders</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined mail">
                                            mail
                                        </span>
                                        <a href="{{route('pur_invoice.index')}}" class="me-3 ps-3">Purchase Invoices
                                        </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined task_alt">
                                            task_alt
                                        </span>
                                        <a href="{{route('pur_delivery_note.index')}}" class="me-3 ps-3">Purchase
                                            Delivery Notes</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="{{ route('purchase_forecast') }}" class="me-3 ps-3">Purchase Forecast
                                        </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('logout') }}" class="me-3 ps-3">Purchase Analytics</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('pur_purchase_return.index') }}" class="me-3 ps-3">Purchase
                                            Return</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('logout') }}" class="me-3 ps-3">Reports</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- purchases  end  -->
                    <!-- inventory   starts  -->
                    <li class="nav-item  nav_item_angle">
                        <a class="nav-link left-nav-link active" href="#" id="inventory">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> -->
                                <i class="fa-solid fa-warehouse opacity-10 text-primary fs-6"></i>
                            </div>
                            <span class="nav-link-text ms-1">Inventry</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">

                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined lock_reset">
                                            lock_reset
                                        </span>
                                        <a href="{{route('ims_stock_request.index')}}" class="me-3 ps-3">Stock Request
                                            Notes</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="{{route('ims_stock_transfer.index')}}" class="me-3 ps-3">Transfer
                                            Notes</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined mail">
                                            mail
                                        </span>
                                        <a href="{{route('ims_stock_receipt.index')}}" class="me-3 ps-3">Stock receipt
                                            Notes </a>
                                    </li>

                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('ims_asset.index') }}" class="me-3 ps-3">Manage Assets</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout

                                        </span>
                                        <a href="{{ route('ims_damage_stock.index') }}" class="me-3 ps-3">Manage Damage
                                            Stock</a>
                                    </li>
                                    {{-- subdrop down start --}}
                                    <li class="drop_list_item_carret margin_left_10">
                                        <a class="nav-link  left-nav-link sub_drop_link" href="javascript:void"
                                            id="inventory_reports">
                                            <div
                                                class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
                                                <i class="fas fa-cog"></i>
                                            </div>
                                            <span class="nav-link-text ms-2">Reports</span>
                                            <i class="fas fa-angle-left m-auto angle"></i>
                                        </a>
                                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                                            <div class="custom_dropdown_parent_child">
                                                <ul class="custom_dropdown">
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('product_report_view') }}"
                                                            class="me-3 ps-3">Product Reports</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('warehouse_report_view') }}"
                                                            class="me-3 ps-3">Warehouse Reports</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    {{-- subdrop down end --}}


                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- inventory  end  -->
                    <!-- Sales   starts  -->
                    <li class="nav-item  nav_item_angle">
                        <a class="nav-link left-nav-link active" href="#" id="sales">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> -->
                                <i class="fa-solid fa-cart-shopping text-danger fs-6"></i>
                            </div>
                            <span class="nav-link-text ms-1">Sales</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">
                                    <li class="drop_list_item_carret">
                                        <i class="fa-solid fa-user fa-user-left"></i>
                                        <a href="{{route('customer.index')}}" class="me-3 ps-3">Customers</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined lock_reset">
                                            lock_reset
                                        </span>
                                        <a href="{{route('sal_quotation.index')}}" class="me-3 ps-3">Quotations</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="{{route('sal_order.index')}}" class="me-3 ps-3">Sales orders</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined mail">
                                            mail
                                        </span>
                                        <a href="{{route('sal_invoice.index')}}" class="me-3 ps-3">Sales invoices </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined task_alt">
                                            task_alt
                                        </span>
                                        <a href="{{route('sal_delivery_note.index')}}" class="me-3 ps-3">Delivery
                                            Notes</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="{{route('sale_forecast')}}" class="me-3 ps-3">Sales Forcast </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('logout') }}" class="me-3 ps-3">Sales Analytics</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{route( 'sal_return.index') }}" class="me-3 ps-3">Sales Returns </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{ route('logout') }}" class="me-3 ps-3">Sales Reports</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{route('open_cash_register')}}" class="me-3 ps-3">POS</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined logout">
                                            logout
                                        </span>
                                        <a href="{{route('sal_list_pos')}}" class="me-3 ps-3">List POS</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- Sales  end  -->
                    <!-- Account and finance   starts  -->
                    <li class="nav-item  nav_item_angle">
                        <a class="nav-link left-nav-link active" href="#" id="accounts_and_finance">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> -->
                                <i class="fa-solid fa-filter-circle-dollar text-secondary fs-6"></i>
                            </div>
                            <span class="nav-link-text ms-1">Accounts And Finance</span>
                            <i class="fas fa-angle-left m-auto angle"></i>
                        </a>
                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                            <div class="custom_dropdown_parent_child">
                                <ul class="custom_dropdown">


                                    {{-- subdrop down start --}}
                                    <li class="drop_list_item_carret margin_left_10">
                                        <a class="nav-link  left-nav-link sub_drop_link" href="javascript:void"
                                            id="accounts_configuration">
                                            <div
                                                class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
                                                <i class="fas fa-cog"></i>
                                            </div>
                                            <span class="nav-link-text ms-2">Configurations</span>
                                            <i class="fas fa-angle-left m-auto angle"></i>
                                        </a>
                                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                                            <div class="custom_dropdown_parent_child">
                                                <ul class="custom_dropdown">
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('acc_fiscal_period.index') }}"
                                                            class="me-3 ps-3">Fiscal Period</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('acc_family.index') }}"
                                                            class="me-3 ps-3">Family</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('acc_transaction_category.index') }}"
                                                            class="me-3 ps-3">Transaction Category</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('acc_cost_center.index') }}"
                                                            class="me-3 ps-3">Cost Centers</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('acc_control_code.index') }}"
                                                            class="me-3 ps-3">Control Code</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('acc_currency.index') }}"
                                                            class="me-3 ps-3">Currency</a>
                                                    </li>
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('acc_account_balance.index') }}"
                                                            class="me-3 ps-3">Account Balance</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    {{-- subdrop down end --}}




                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined lock_reset">
                                            lock_reset
                                        </span>
                                        <a href="{{ route('acc_account.index') }}" class="me-3 ps-3">Chart of
                                            account</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="{{ route('acc_journal_entry.create') }}" class="me-3 ps-3">General
                                            ledger</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined mail">
                                            mail
                                        </span>
                                        <a href="{{ route('acc_payable.create') }}" class="me-3 ps-3">Account Payable </a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined task_alt">
                                            task_alt
                                        </span>
                                        <a href="{{ route('acc_recievable.create') }}" class="me-3 ps-3">Account Recievable</a>
                                    </li>
                                    <li class="drop_list_item_carret d-flex">
                                        <span class="material-symbols-outlined notifications">
                                            notifications
                                        </span>
                                        <a href="{{ route('acc_authorization.index') }}" class="me-3 ps-3">Authorization </a>
                                    </li>
                                    {{-- subdrop down start --}}
                                    <li class="drop_list_item_carret margin_left_10">
                                        <a class="nav-link  left-nav-link sub_drop_link" href="{{ route('acc_trial_balance.index') }}"
                                            id="accounts_configuration">
                                            <div
                                                class="border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                                {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
                                                <i class="fas fa-cog"></i>
                                            </div>
                                            <span class="nav-link-text ms-2">Reports</span>
                                            <i class="fas fa-angle-left m-auto angle"></i>
                                        </a>
                                        <div class="custom_dropdown_parent" id="custom_dropdown_parent">
                                            <div class="custom_dropdown_parent_child">
                                                <!-- <ul class="custom_dropdown">
                                                    <li class="drop_list_item_carret d-flex">
                                                        <span class="material-symbols-outlined lock_reset">
                                                            lock_reset
                                                        </span>
                                                        <a href="{{ route('acc_trial_balance.index') }}"
                                                            class="me-3 ps-3">Trial Balance</a>
                                                    </li>
                                                    
                                                    
                                                </ul> -->
                                            </div>
                                        </div>
                                    </li>
                                    {{-- subdrop down end --}}

                                </ul>
                            </div>
                        </div>
                    </li>
                    <!--Account and finance  end  -->
                    {{-- @endif --}}
                    @endif




                    <!-- <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">{{ __('lang.account_pages') }}</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="./pages/profile.html">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">@lang('lang.profile')</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item">
                    <a class="nav-link " href="./pages/sign-in.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sign In</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/sign-up.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sign Up</span>
                    </a>
                </li> -->
                </ul>
            </div>
            <!-- <div class="sidenav-footer mx-3 ">
                <div class="card card-plain shadow-none" id="sidenavCard">
                    <img class="w-50 mx-auto" src="{{ asset('dashboard_assets/assets/img/illustrations/icon-documentation.svg') }}" alt="sidebar_illustration">
                    <div class="card-body text-center p-3 w-100 pt-0">
                        <div class="docs-info">
                            <h6 class="mb-0">Need help?</h6>
                            <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
                        </div>
                    </div>
                </div>
                <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
                <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
            </div> -->
        </aside>
        <!-- current -->
        <main
            class="main-content position-relative border-radius-lg {{app()->getLocale() == 'ar' ? 'overflow-hidden ps ps__rtl'  :' overflow-visible' }} ">
            <!-- Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl justify-content-lg-between" id="navbarBlur"
                data-scroll="false">

                <div class="navbar_blur_first_child">
                    <!-- ok -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                    href="javascript:;">@lang('lang.pages')</a></li>
                            <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                                {{ $navbar_headings }}</li>
                        </ol>
                        <h6 class="font-weight-bolder text-white mb-0">{{ $navbar_headings }}</h6>
                    </nav>
                </div>
                <!-- ok -->
                <div class="nav_right_side_items">
                    <div class="collapse navbar-collapse flex-wrap mt-sm-0  mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="d-flex search_logout_lang_dropdowns">
                            <!-- search start  -->
                            <div class="body_nav_item">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-search"
                                            aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" placeholder="@lang('lang.type_here')">
                                </div>
                            </div>

                            <!-- search  end -->
                            

                            
                            <!-- language -->
                            <div class="dropdown body_nav_item">

                                <a href="#" class="btn bg-light text-secondary  dropdown-toggle  mb-0" data-bs-toggle="dropdown"
                                    id="navbarDropdownMenuLink2">

                                    <i class="me-2 fi fi-{{ Config::get('languages')[app()->getLocale()]['flag-icon'] }}  opacity-10"
                                        style="font-size:17px"></i>
                                    {{
                                    Config::get('languages')[app()->getLocale()]['display'] }}
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                    @foreach (Config::get('languages') as $lang => $language)
                                    @if ($lang != app()->getLocale())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                            <i class="me-2 fi fi-{{ $language['flag-icon'] }} opacity-10"
                                                style="font-size:17px"></i>

                                            <!-- class="ms-4 fi fi-{{ $language['flag-icon'] }} text-dark"> -->
                                            {{ $language['display'] }}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach


                                </ul>
                            </div>
                            <!-- language -->
                            <!-- logout dropdwon start  -->
                            <div class="dropdown body_nav_item ">
                                <button class="btn btn-light mb-0 text-secondary dropdown-toggle button_m_bottom_0" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="me-3 font_roboto">
                                        @if (Session::get('user_type') == 'JobCandidate')
                                        {{ Session::get('user_type') }}
                                        @else
                                        {{ Session::get('user_fullname') }}
                                        @endif
                                    </span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </div>
                            <!-- logout dropdwon end  -->
                        </div>



                        
                        <div class="bill_notify">
                            <div>
                                <a href="javascript:void(0)" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner hamburger d-none">
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                    </div>
                                </a>
                            </div>

                            <div>
                                <a href="javascript:;" class="nav-link text-white p-0">
                                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                                </a>
                            </div>


                            <div>
                                <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell cursor-pointer position-relative">
                                        @if (count(auth()->user()->unreadnotifications))
                                        <span
                                            class=" position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info badge-text">

                                            {{ count(auth()->user()->unreadnotifications) }}
                                        </span>
                                        @endif
                                    </i>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                    aria-labelledby="dropdownMenuButton">
                                    <!-- mark all as read  -->
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="{{ route('mark_as_read') }}">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        Mark all as read
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <!-- <i class="fa fa-clock me-1"></i> -->
                                                        <!-- 13 minutes ago -->
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- unread notifications -->
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="#">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        {{ $notification->data['message'] }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        <!-- 13 minutes ago -->
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach



                                </ul>
                            </div>

                        </div>
                    </div>
                </div>


            </nav>
            <!-- End Navbar -->
            <div class="container-fluid wrapper-container ">
                <!-- dynamic content of all pages start  -->

                @yield('body_content')
                <!-- dynamic content of all pages end  -->


              
            </div>
        </main>
        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
                <i class="fa fa-cog py-2"> </i>
            </a>
            <div class="card shadow-lg">
                <div class="card-header pb-0 pt-3 ">
                    <div class="float-start">
                        <h5 class="mt-3 mb-0">Argon Configurator</h5>
                        <p>See our dashboard options.</p>
                    </div>
                    <div class="float-end mt-4">
                        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <!-- End Toggle Button -->
                </div>
                <hr class="horizontal dark my-1">
                <div class="card-body pt-sm-3 pt-0 overflow-auto">
                    <!-- Sidebar Backgrounds -->
                    <div>
                        <h6 class="mb-0">Sidebar Colors</h6>
                    </div>
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors my-2 text-start">
                            <span class="badge filter bg-gradient-primary active" data-color="primary"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-dark" data-color="dark"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-info" data-color="info"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-success" data-color="success"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-warning" data-color="warning"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-danger" data-color="danger"
                                onclick="sidebarColor(this)"></span>
                        </div>
                    </a>
                    <!-- Sidenav Type -->
                    <div class="mt-3">
                        <h6 class="mb-0">Sidenav Type</h6>
                        <p class="text-sm">Choose between 2 different sidenav types.</p>
                    </div>
                    <div class="d-flex">
                        <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                            onclick="sidebarType(this)">White</button>
                        <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
                            onclick="sidebarType(this)">Dark</button>
                    </div>
                    <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                    <!-- Navbar Fixed -->
                    <div class="d-flex my-3">
                        <h6 class="mb-0">Navbar Fixed</h6>
                        <div class="form-check form-switch ps-0 ms-auto my-auto">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                                onclick="navbarFixed(this)">
                        </div>
                    </div>
                    <hr class="horizontal dark my-sm-4">
                    <div class="mt-2 mb-5 d-flex">
                        <h6 class="mb-0">Light / Dark</h6>
                        <div class="form-check form-switch ps-0 ms-auto my-auto">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                                onclick="darkMode(this)">
                        </div>
                    </div>
                    <a class="btn bg-gradient-dark w-100"
                        href="https://www.creative-tim.com/product/argon-dashboard">Free
                        Download</a>
                    <a class="btn btn-outline-dark w-100"
                        href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View
                        documentation</a>
                    <div class="w-100 text-center">
                        <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard"
                            data-icon="octicon-star" data-size="large" data-show-count="true"
                            aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
                        <h6 class="mt-3">Thank you for sharing!</h6>
                        <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard"
                            class="btn btn-dark mb-0 me-2" target="_blank">
                            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard"
                            class="btn btn-dark mb-0 me-2" target="_blank">
                            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--   Core JS Files   -->
        @include('dashboard/script_links')
        @yield('page_script_links')


</body>

</html>