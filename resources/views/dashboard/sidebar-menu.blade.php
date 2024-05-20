<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('dashboard_assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="/dashboard/profile" class="d-block">
                <?= (session()->has('user_fullname') ? session()->get('user_fullname') : 'User\'s Profile'); ?>
            </a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @if(session()->get('IsAppAdmin')==true)
                   <!-- App Super Admin Settings  Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p> @lang('dashboard.app_settings')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/users')}}" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>@lang('dashboard.users_management')</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('/usersgroups')}}" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>@lang('dashboard.manage_groups')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/subscriptionpackages')}}" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>@lang('dashboard.subscription_packages')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/subscriptions')}}" class="nav-link">
                            <i class="nav-icon fas fa-list-ol"></i>
                            <p>@lang('dashboard.subscriptions')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/companies')}}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>@lang('dashboard.companies')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/fulldatabasebackup')}}" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>@lang('dashboard.full_database_backup')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas fa-globe"></i>
                            <p>@lang('dashboard.global_config')</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/emailsettings')}}" class="nav-link">
                                    <i class="fas fa-envelope nav-icon"></i>
                                    <p>@lang('dashboard.email_settings')</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{url('/smssettings')}}" class="nav-link">
                                    <i class="fas fa-sms nav-icon"></i>
                                    <p>@lang('dashboard.sms_settings')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/paymentgateways')}}" class="nav-link">
                                    <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                    <p>@lang('dashboard.payment_gateways')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/countries')}}" class="nav-link">
                                    <i class="fas fa-flag nav-icon"></i>
                                    <p>@lang('dashboard.countries')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/userspermissions')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('dashboard.users_permissions')</p>
                                </a>
                            </li>
                        </ul> <!-- ./Global Config -->
                    </li>
                </ul>
            </li>
            <!-- ./App Super Admin Settings-->
            @endif


            <!-- User Home Prefrences Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas   fa-street-view"></i>
                    <p> @lang('dashboard.home')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>@lang('dashboard.profile')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-unlock"></i>
                            <p>@lang('dashboard.change_password')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>@lang('dashboard.notifications')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas  fa-envelope"></i>
                            <p>@lang('dashboard.messages')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas   fa-gavel"></i>
                            <p>@lang('dashboard.to_do_tasks')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon far fa-comment"></i>
                            <p>@lang('dashboard.notifications_preferences')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout')}}" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>@lang('dashboard.logout')</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ./User Home Prefrences-->

            <!-- System Admin Settings Prefrences Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-cog"></i>
                    <p> @lang('dashboard.system_settings')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>@lang('dashboard.users_management')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>@lang('dashboard.manage_groups')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>@lang('dashboard.company_profile')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>@lang('dashboard.subscriptions')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas fa-globe"></i>
                            <p>@lang('dashboard.web_front_settings')</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/forms/advanced.html" class="nav-link">
                                    <i class="fas fa-envelope nav-icon"></i>
                                    <p>@lang('dashboard.options')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/forms/advanced.html" class="nav-link">
                                    <i class="fas fa-sms nav-icon"></i>
                                    <p>@lang('dashboard.header')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/forms/advanced.html" class="nav-link">
                                    <i class="fas fa-sms nav-icon"></i>
                                    <p>@lang('dashboard.footer')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/forms/editors.html" class="nav-link">
                                    <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                    <p>@lang('dashboard.main_content')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/forms/validation.html" class="nav-link">
                                    <i class="far fa-question-circle nav-icon"></i>
                                    <p>@lang('dashboard.products_page')</p>
                                </a>
                            </li>
                        </ul> <!-- ./Global Config -->
                    </li>
                </ul>
            </li>
            <!-- ./System Admin Settings Prefrences-->


            <!-- Human Resources Settings Prefrences Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-users"></i>
                    <p> @lang('dashboard.human_resources')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>@lang('dashboard.employees')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>@lang('dashboard.leave_management')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon far fa-file-alt"></i>
                            <p>@lang('dashboard.policies_management')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>@lang('dashboard.payroll')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon far fa-address-card"></i>
                            <p>@lang('dashboard.recruitment')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>@lang('dashboard.configuration')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-print"></i>
                            <p>@lang('dashboard.reports')</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ./Human Resources Settings Prefrences-->
            <!-- CRM Module Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon far fa-address-book"></i>
                    <p>@lang('dashboard.crm')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>@lang('dashboard.contacts')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>@lang('dashboard.leads')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-people-arrows"></i>
                            <p>@lang('dashboard.opportunities')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-phone-volume"></i>
                            <p>@lang('dashboard.phone_calls')</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>@lang('dashboard.sales_forecast')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon far fa-chart-bar"></i>
                            <p>@lang('dashboard.sales_analytics')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fab fa-slideshare"></i>
                            <p>@lang('dashboard.help_desk')</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ./CRM Module  -->

            <!-- Products Prefrences Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-box-open"></i>
                    <p> @lang('dashboard.products')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>@lang('dashboard.product_management')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>@lang('dashboard.categories')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>@lang('dashboard.variations')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fab fa-uniregistry"></i>
                            <p>@lang('dashboard.units')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>@lang('dashboard.brands')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p>@lang('dashboard.warrenties')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-print"></i>
                            <p>@lang('dashboard.reports')</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ./Products Settings Prefrences-->
            <!-- Purchase Module  Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>@lang('dashboard.purchases')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon far fa-address-card"></i>
                            <p>@lang('dashboard.suppliers')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>@lang('dashboard.purchase_quotations')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>@lang('dashboard.purchase_orders')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>@lang('dashboard.purchase_invocies')</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-truck-moving"></i>
                            <p>@lang('dashboard.purchase_delivery_notes')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>@lang('dashboard.purchase_forecast')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-chart-area"></i>
                            <p>@lang('dashboard.purchase_analytics')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>@lang('dashboard.purchase_returns')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>@lang('dashboard.reports')</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ./Purchase Module Prefrences-->

            <!-- Inventory  Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-warehouse"></i>
                    <p>@lang('dashboard.inventory')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon  fas fa-sliders-h"></i>
                            <p>@lang('dashboard.configuration')</p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/gallery.html" class="nav-link">
                                    <i class="nav-icon fa-list-ol"></i>
                                    <p>@lang('dashboard.inventory_levels')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-luggage-cart"></i>
                                    <p>@lang('dashboard.precautions')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-folder-plus"></i>
                                    <p>@lang('dashboard.manage_bonuses')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>@lang('dashboard.stock_request_notes')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>@lang('dashboard.transfer_notes')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-truck-loading"></i>
                            <p>@lang('dashboard.stock_receipts_notes')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>@lang('dashboard.manage_requests')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>@lang('dashboard.manage_returns')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>@lang('dashboard.manage_assets')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-box-tissue"></i>
                            <p>@lang('dashboard.manage_damage_stock')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-pallet"></i>
                            <p>@lang('dashboard.stock_consumption')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-print"></i>
                            <p>@lang('dashboard.reports')</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/gallery.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-powerpoint"></i>
                                    <p>@lang('dashboard.summary_reports')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon far fa-file-powerpoint"></i>
                                    <p>@lang('dashboard.stock_reports')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- ./Inventory Settings-->




            <!-- Sales Module  Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                    <p>@lang('dashboard.sales')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>@lang('dashboard.customers')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>@lang('dashboard.sales_quotations')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon far fa-file-alt"></i>
                            <p>@lang('dashboard.sales_orders')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>@lang('dashboard.sales_invoices')</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>@lang('dashboard.sales_delivery_notes')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>@lang('dashboard.sales_forecast')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>@lang('dashboard.sales_analytics')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>@lang('dashboard.sales_returns')</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>@lang('dashboard.sales_reports')</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- ./Sales Module Prefrences-->


            <!-- Accounting Module  Menu -->
            <li class="nav-item menu-closed">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-funnel-dollar"></i>
                    <p>@lang('dashboard.accounts')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>@lang('dashboard.configuration')</p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/gallery.html" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>@lang('dashboard.fiscal_period')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon far fa-sticky-note"></i>
                                    <p>@lang('dashboard.gl_notes')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="nav-icon fas fa-search-dollar"></i>
                                    <p>@lang('dashboard.gl_cost_centers')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                    <p>@lang('dashboard.control_codes')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon far fa-money-bill-alt"></i>
                                    <p>@lang('dashboard.currency')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-money-bill-wave"></i>
                                    <p>@lang('dashboard.family')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>@lang('dashboard.global_configuration')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>@lang('dashboard.chart_of_accounts')</p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/gallery.html" class="nav-link">
                                    <i class="nav-icon fas fa-font"></i>
                                    <p>@lang('dashboard.main_accounts')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-subscript"></i>
                                    <p>@lang('dashboard.detail_accounts')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>@lang('dashboard.general_ledger')</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/gallery.html" class="nav-link">
                                    <i class="nav-icon fas fa-receipt"></i>
                                    <p>@lang('dashboard.journal_entry_vouchers')</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas fa-book-reader"></i>
                            <p>@lang('dashboard.account_payable')</p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/gallery.html" class="nav-link">
                                    <i class="nav-icon fas fa-user-alt"></i>
                                    <p>@lang('dashboard.suppliers_details')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>@lang('dashboard.cash_paid_vouchers')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                    <p>@lang('dashboard.bank_payment_vouchers')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas  far fa-file-alt"></i>
                            <p>@lang('dashboard.account_receivable')</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/gallery.html" class="nav-link">
                                    <i class="nav-icon fas fa-user-alt"></i>
                                    <p>@lang('dashboard.customer_details')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>@lang('dashboard.cash_receipt_vouchers')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                    <p>@lang('dashboard.bank_receipt_voucher')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>@lang('dashboard.authorization')</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-export"></i>
                                    <p>@lang('dashboard.audit_vouchers')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-download"></i>
                                    <p>@lang('dashboard.post_vouchers')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="right fas fa-angle-left"></i>
                            <i class="nav-icon fas fa-print  "></i>
                            <p>@lang('dashboard.reports')</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                    <p>@lang('dashboard.account_statement')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>@lang('dashboard.trail_balance')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>@lang('dashboard.balance_sheet')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-contract"></i>
                                    <p>@lang('dashboard.control_codes')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-medical"></i>
                                    <p>@lang('dashboard.cost_centers')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>@lang('dashboard.cash_flow_statement')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link">
                                    <i class="nav-icon far fa-file-alt"></i>
                                    <p>@lang('dashboard.journal_enteries')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- ./Accounting Module Prefrences-->


        </ul>
    </nav>
    <br /><br />
    <!-- /.sidebar-menu -->
</div>
