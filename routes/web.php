<?php
// app settings start 
use App\Http\Controllers\AppSettings\AppSettingsController;
// app settings end 
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppliedCandidate\AppliedCandidateController;
use App\Http\Controllers\Countries\CountriesController;
// use App\Http\Controllers\AppSettings\SubscriptionPackagesController;
use App\Http\Controllers\SubscriptionPackages\SubscriptionPackagesController;
use App\Http\Controllers\DbBackup\DbBackupController;
// use App\Http\Controllers\AppSettings\SubscriptionsController;
use App\Http\Controllers\Subscriptions\SubscriptionsController;
use App\Http\Controllers\CompaniesPositions\CompaniesPositionController;
use App\Http\Controllers\Companies\CompaniesController;
use App\Http\Controllers\CompaniesDepartments\CompaniesDepartmentController;
use App\Http\Controllers\UsersPermissions\UsersPermissionsController;
use App\Http\Controllers\Notifications\Notifications;
use App\Http\Controllers\ToDoTasks\ToDoTasksController;

use App\Http\Controllers\UsersGroups\UsersGroupsController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Users\UsersAuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\LandingPage\LandingPageController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\JobVacancy\JobVacancyController;
use Illuminate\Http\Request;
use App\Http\Controllers\Users\EmployeeController;

// Web Front start 
use App\Http\Controllers\WebFront\WebFrontController;
use App\Http\Controllers\WebFront\WebfrontHeaderController;
use App\Http\Controllers\Interview\InterviewController;
use App\Http\Controllers\HRM\EmployeeLeaveController;
use App\Http\Controllers\HRM\PublicHolidayController;
use App\Http\Controllers\HRM\WorkShiftController;
use App\Http\Controllers\HRM\AttendenceController;
use App\Http\Controllers\HRM\HrmWeekDayController;
use App\Http\Controllers\HRM\HrmPayrollController;
use App\Http\Controllers\HRM\HrmPrintController;

// crm start 
use App\Http\Controllers\CRM\CrmContactController;
use App\Http\Controllers\CRM\CrmCategoryController;
use App\Http\Controllers\CRM\CrmLeadController;
use App\Http\Controllers\CRM\CrmOppertunityController;
use App\Http\Controllers\CRM\CrmPhoneCallController;
use App\Http\Controllers\CRM\CrmSchedulePhoneCallController;
use App\Http\Controllers\CRM\CrmController;

// crm end 

// product start -------------------------------------------------------------------------------------
use App\Http\Controllers\product\ProCategoryController;
use App\Http\Controllers\product\ProBrandController;
use App\Http\Controllers\product\ProUnitController;
use App\Http\Controllers\product\ProTaxController;
use App\Http\Controllers\product\ProWarrentyController;
use App\Http\Controllers\product\ProProductController;
use App\Http\Controllers\product\ProAttributeController;
use App\Http\Controllers\product\ProAttributeValueController;

//  ------------------------------------------------------------------------------------- product end

// purchase start ---------------------------------------------------------------------------

use  App\Http\Controllers\purchase\PurProductQuotationRequestController;
use App\Http\Controllers\purchase\PurSupplierController;
use App\Http\Controllers\purchase\PurPurchaseQuotationController;
use App\Http\Controllers\purchase\PurPurchaseOrderController;
use App\Http\Controllers\purchase\PurWarehouseController;
use App\Http\Controllers\purchase\PurInvoiceController;
use App\Http\Controllers\purchase\PurDeliveryNoteController;
use App\Http\Controllers\purchase\PurPurchaseReturnController;
use App\Http\Controllers\purchase\PurWarehouseStockController;
use App\Http\Controllers\purchase\PurchaseController;
//  --------------------------------------------------------------------------- purchase end

// sale module  start  -----------------------------------------------------------------------
use  App\Http\Controllers\sale\SalCustomerController;
use  App\Http\Controllers\sale\SalQuotationController;
use  App\Http\Controllers\sale\SalOrderController;
use  App\Http\Controllers\sale\SalInvoiceController;
use  App\Http\Controllers\sale\SalDeliveryNoteController;
use  App\Http\Controllers\sale\SalReturnController;
use  App\Http\Controllers\sale\SaleController;
use  App\Http\Middleware\CheckRegisterOpen;

//  ----------------------------------------------------------------------- sale module  end


// inventory module  start  ----------------------------------------------------------------------- 
use App\Http\Controllers\inventory\ImsStockRequestController;
 use App\Http\Controllers\inventory\ImsStockTransferController;
 use App\Http\Controllers\inventory\ImsStockReceiptController;
 use App\Http\Controllers\inventory\ImsAssetController;
 use App\Http\Controllers\inventory\ImsDamageStockController;
 use App\Http\Controllers\inventory\InventoryReportsController;
//  ----------------------------------------------------------------------- inventory module  end

// account module  start ----------------------------------------------------------------------- 
use  App\Http\Controllers\account\AccFiscalPeriodController;
use  App\Http\Controllers\account\AccFamilyController;
use  App\Http\Controllers\account\AccTransactionCategoryController;
use  App\Http\Controllers\account\AccCostCenterController;
use  App\Http\Controllers\account\AccControlCodeController;
use  App\Http\Controllers\account\AccCurrencyController;
use  App\Http\Controllers\account\AccAccountController;
use  App\Http\Controllers\account\AccAccountBalanceController;
use  App\Http\Controllers\account\AccTransactionController;
use  App\Http\Controllers\account\AccJournalEntryController;
use  App\Http\Controllers\account\AccPayableController;
use  App\Http\Controllers\account\AccRecievableController;
use  App\Http\Controllers\account\AccAuthorizationController;
use  App\Http\Controllers\account\AccTrialBalanceController;
//  ----------------------------------------------------------------------- account module  end
// Web Front end 

use App\Models\JobVacancy\JobVacancy;
use App\Models\Users\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// argon start 
use Illuminate\Support\Facades\Blade;
use App\Models\HRM\Attendence;
use Carbon\CarbonInterval;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\CRM\CrmLead;
use App\Models\purchase\PurProductQuotationRequest;
use App\Models\purchase\PurPurchaseQuotation;
use App\Models\purchase\PurWarehouse;
// check start ------------------------------
use App\Models\account\AccAccount;
Route::get('check', function () {
   $v =   collect([1000])[0];
    


    return  $v;
    

    
});
// check end ------------------------------









// argon end
//Load the default Public Home page of the application
// Route::get('/', function () {
//     // App::setLocale($locale);
//     return view('webfront.webfront', ['companycode' => 'zaratica']);
// })->name('home');

// Route::get('/{lang?}', function ($locale=null) {
//     App::setLocale($locale);
//     return view('webfront.webfront', ['companycode' => 'zaratica']);
// })->name('home');
/** User Login Handling */
Route::get('register', [UsersAuthController::class, 'register'])->name('register');
Route::get('login', [UsersAuthController::class, 'login'])->name('login');
Route::post('authenticate', [UsersAuthController::class, 'authenticate'])->middleware('return_to_pos')->name('authenticate');
Route::post('register_user', [UsersAuthController::class, 'registerUser'])->name("register_user");
Route::post('is_exist_user_name', [UsersAuthController::class, 'isExistUserName'])->name("is_exist_user_name");

Route::post('is_exist_email', [UsersAuthController::class, 'isExistEmail'])->name("is_exist_email");
Route::get('logout', [UsersAuthController::class, 'logout'])->name('logout');
Route::get('lang/{lang?}', [LanguageController::class, 'switchLang'])->name('lang.switch');
Route::post('register_job_cand', [UsersAuthController::class, 'register_job_cand'])->name('register_job_cand');


// Route::get('dashboard', ['middleware' => 'userAuth', 'uses' => 'DashboardController@index']);
/** ====== Auth Applied on the routes ======= */
Route::middleware(['authUser'])->group(function () {
    Route::get('dashboard/{lang?}', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('userspermissions', UsersPermissionsController::class);
    Route::resource('users', UsersController::class);
    // ->middleware('sub_package_one')
    Route::get('users/create', [UsersController::class, 'create'])->name('users.create')->middleware('sub_package_one');
    Route::get('get_data', [UsersController::class, 'getData'])->name('get_data');
    Route::get('updateUser/{update_user_id?}', [UsersController::class, 'userUpdateForm'])->name('userUpdateForm');
    Route::get('singleuser', [UsersController::class, 'singleuser'])->name('singleuser');
    Route::get('change_password', [UsersController::class, 'changePassword'])->name('change_password');
    Route::post('check_password', [UsersController::class, 'checkPassword'])->name('check_password');
    Route::post('update_password', [UsersController::class, 'updatePassword'])->name('update_password');
    Route::get('update_profile_form', [UsersController::class, 'update_profile_form'])->name('update_profile_form');
    Route::post('update_user_profile', [UsersController::class, 'update_user_profile'])->name('update_user_profile');
    Route::post('update_job_candidate_profile', [UsersController::class, 'update_job_candidate_profile'])->name('update_job_candidate_profile');
    Route::post('check_user_count', [UsersController::class, 'check_user_count'])->name('check_user_count');
    Route::post('is_exist_user_name_for_update', [UsersAuthController::class, 'isExistUserNameForUpdate'])->name("is_exist_user_name_for_update");
    Route::post('is_exist_email_for_update', [UsersAuthController::class, 'isExistEmailForUpdate'])->name("is_exist_email_for_update");
    Route::post('deleteUser', [UsersAuthController::class, 'deleteUser'])->name("deleteUser");
    Route::post('update_user', [UsersController::class, 'updateUser'])->name("updateUser");
    Route::post('assign_groups_to_user', [UsersController::class, 'assignGroupsToUser'])->name('assign_groups_to_user');
    Route::post('users_edit_groups', [UsersController::class, 'usersEditGroups'])->name('users_edit_groups');
    Route::get('profile', [UsersController::class, 'profile'])->name('profile');
    Route::get('job_candite_profile_form', [UsersController::class, 'job_candite_profile_form'])->name('job_candite_profile_form');
    Route::post('updateUserProfile', [UsersController::class, 'updateUserProfile'])->name('updateUserProfile');
    Route::post('fetchSingleUser', [UsersController::class, 'fetchSingleUser'])->name('fetchSingleUser');


    // companies positions start 
    Route::resource('companies_position', CompaniesPositionController::class);
    Route::get('get_data_com_pos', [CompaniesPositionController::class, 'getData'])->name('get_data_com_pos');
    Route::post('delete_com_pos', [CompaniesPositionController::class, 'deleteCompaniesPositions'])->name('delete_com_pos');
    Route::get('updatePosition/{update_position_id?}', [CompaniesPositionController::class, 'updateCompaniesPositionsForm'])->name('updatePosition');
    Route::post('update_com_pos', [CompaniesPositionController::class, 'updateCompaniesPositions'])->name('update_com_pos');
    // companies positions end 
    // Landing page  start 
    Route::resource('landing_page', LandingPageController::class);
    Route::get('get_data_landing_page', [LandingPageController::class, 'getData'])->name('get_data_landing_page');
    Route::post('delete_landing_page', [LandingPageController::class, 'deleteLandingPage'])->name('delete_landing_page');
    Route::get('updateLandingPage/{update_landing_page_id?}', [LandingPageController::class, 'updateLandingPageForm'])->name('updateLandingPage');
    Route::post('update_landing_page', [LandingPageController::class, 'updateLandingPage'])->name('update_landing_page');
    Route::post('is_exist_url', [LandingPageController::class, 'isExistUrl'])->name('is_exist_url');
    Route::post('isExistUrlUpdate', [LandingPageController::class, 'isExistUrlUpdate'])->name('isExistUrlUpdate');
    // companies departments end 
    // countries start 
    Route::resource('countries', CountriesController::class);
    Route::get('get_data_countries', [CountriesController::class, 'getData'])->name('get_data_countries');
    Route::post('delete_countries', [CountriesController::class, 'deleteCountries'])->name('delete_countries');
    Route::get('updateCountries/{update_countries_id?}', [CountriesController::class, 'updateCountriesForm'])->name('updateCountries');
    Route::post('update_countries', [CountriesController::class, 'updateCountries'])->name('update_countries');
    // countries end 

    // user groups start 
    Route::resource('users_groups', UsersGroupsController::class);

    Route::get('get_data_users_groups', [UsersGroupsController::class, 'getData'])->name('get_data_users_groups');
    Route::post('delete_users_groups', [UsersGroupsController::class, 'deleteUsersGroups'])->name('delete_users_groups');
    Route::get('updateUsersGroups/{update_users_groups_id?}', [UsersGroupsController::class, 'updateUsersGroupsForm'])->name('updateUsersGroups');
    Route::post('update_users_groups', [UsersGroupsController::class, 'updateUsersGroups'])->name('update_users_groups');

    Route::get('all_groups', [UsersGroupsController::class, 'allGroups'])->name('all_groups');
    Route::post('assign_per_to_group', [UsersGroupsController::class, 'assignPermissionsToGroup'])->name('assign_per_to_group');
    Route::post('users_groups_edit_per', [UsersGroupsController::class, 'users_groups_edit_per'])->name('users_groups_edit_per');

    // users groups end 
    // companies start  
    Route::resource('companies', CompaniesController::class);
    Route::get('get_data_companies', [CompaniesController::class, 'getData'])->name('get_data_companies');
    Route::post('delete_companies', [CompaniesController::class, 'deleteCompanies'])->name('delete_companies');
    Route::get('updateCompanies/{update_companies_id?}', [CompaniesController::class, 'updateCompaniesForm'])->name('updateCompanies');
    Route::post('update_companies', [CompaniesController::class, 'updateCompanies'])->name('update_companies');
Route::get('update_owner_company', [CompaniesController::class, 'updateOwnerCompany'])->name('update_owner_company');
Route::post('updateCompaniesPost', [CompaniesController::class, 'updateCompaniesPost'])->name('updateCompaniesPost');


Route::get('updateCompanyByApp/{update_companies_id?}', [CompaniesController::class, 'updateCompanyByAppForm'])->name('updateCompanyByApp');
    // companies  end 

    // Users Permissions start 
    Route::resource('users_permissions', UsersPermissionsController::class);
    Route::get('get_data_users_permissions', [UsersPermissionsController::class, 'getData'])->name('get_data_users_permissions');
    // practice
    // Route::get('per',[UsersPermissionsController::class,'per'])->name('per');
    // practice
    Route::post('delete_users_permissions', [UsersPermissionsController::class, 'deleteUsersPermissions'])->name('delete_users_permissions');
    Route::get('updateUsersPermissions/{update_users_permissions_id?}', [UsersPermissionsController::class, 'updateUsersPermissionsForm'])->name('updateUsersPermissions');
    Route::post('update_users_permissions', [UsersPermissionsController::class, 'updateUsersPermissions'])->name('update_users_permissions');
    // Users Permissions end 

    // subscriptions start 
    Route::resource('subscriptions', SubscriptionsController::class);
    Route::get('get_data_subscriptions', [SubscriptionsController::class, 'getData'])->name('get_data_subscriptions');
    Route::post('delete_subscriptions', [SubscriptionsController::class, 'deleteSubscriptions'])->name('delete_subscriptions');
    Route::get('updateSubscriptions/{subscriptions_id?}', [SubscriptionsController::class, 'updateSubscriptionsForm'])->name('updateSubscriptions');

    Route::post('update_subscriptions', [SubscriptionsController::class, 'updatesubscriptions'])->name('update_subscriptions');

    Route::get('companySubscription', [SubscriptionsController::class, 'companySubscription'])->name('companySubscription');
    Route::post('add_company_subs', [SubscriptionsController::class, 'add_company_subs'])->name('add_company_subs');


    // companies departments end 
    // dbbase backup start 
    // Route::get('get_db_backup',[DatabaseBackupController::class,'getFullDbBackup'])->name('getFullDbBackup');

    // dbbase backup end 
    // to do task  start 
    Route::resource('to_do_tasks', ToDoTasksController::class);
    Route::get('get_data_to_do_tasks', [ToDoTasksController::class, 'getData'])->name('get_data_to_do_tasks');
    Route::post('delete_to_do_tasks', [ToDoTasksController::class, 'deleteToDoTasks'])->name('delete_to_do_tasks');
    Route::get('updateToDoTasks/{update_to_do_tasks_id?}', [ToDoTasksController::class, 'updatetoDoTasksForm'])->name('updateToDoTasks');
    Route::post('update_to_do_tasks', [ToDoTasksController::class, 'updateToDoTasks'])->name('update_to_do_tasks');
    // to do task  end

    // companies departments start 
    Route::resource('companies_department', CompaniesDepartmentController::class);
    Route::get('get_data_com_dep', [CompaniesDepartmentController::class, 'getData'])->name('get_data_com_dep');
    Route::post('delete_com_dep', [CompaniesDepartmentController::class, 'deleteCompaniesDepartments'])->name('delete_com_dep');
    Route::get('updateDepartment/{update_department_id?}', [CompaniesDepartmentController::class, 'updateCompaniesDepartmentsForm'])->name('updateDepartment');
    Route::post('update_com_dep', [CompaniesDepartmentController::class, 'updateCompaniesDepartment'])->name('update_com_dep');
    // companies departments end 


    // interview start 
    Route::resource('interview', InterviewController::class);
    Route::controller(InterviewController::class)->group(function () {
        Route::post('call_interview', 'call_interview')->name('call_interview');
    });
    // interview end 
    // employee  start 
    Route::middleware(['is_buisness_owner'])->group(function () {
        Route::resource('employee', EmployeeController::class);
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('get_data_employee', 'get_data_employee')->name('get_data_employee');
            Route::get('updateEmployee/{update_user_id?}', 'userUpdateForm')->name('updateEmployeeForm');
            Route::get('employeeDetails/{user_id?}', 'employeeDetails')->name('employeeDetails');
            Route::post('updateEmployee', 'updateUser')->name("updateEmployee");
            Route::post('is_exist_employee_no', 'isExistEmployeeNo')->name("is_exist__employee_no");
            Route::post('is_exist_employee_no_for_update', 'isExistEmployeeForUpdate')->name("is_exist_employee_no_for_update");
            Route::get('printEmployeeDetails/{user_id?}', 'printEmployeeDetails')->name("printEmployeeDetails");
            Route::post('returnUrl', 'returnUrl')->name("returnUrl");
        });
    });
    // employee end 
    //employee_leave  start 
    Route::resource('employee_leave', EmployeeLeaveController::class);
    Route::controller(EmployeeLeaveController::class)->group(function () {
        Route::get('get_data_employee_leave', 'getData')->name('get_data_employee_leave');
        Route::post('fetch_employee_leave', 'fetch_employee_leave')->name('fetch_employee_leave');
        Route::post('update_employee_leave', 'update_employee_leave')->name('update_employee_leave');
        Route::post('delete_employee_leave', 'delete_employee_leave')->name('delete_employee_leave');
        Route::post('approve_employee_leave', 'approve_employee_leave')->name('approve_employee_leave');
        Route::post('reject_employee_leave', 'reject_employee_leave')->name('reject_employee_leave');
    });
    // employee_leave  end 
    // job vacancy   start 
    Route::resource('job_vacancies', JobVacancyController::class);
    Route::controller(JobVacancyController::class)->group(function () {
        Route::get('get_data_job_vacancies', 'getData')->name('get_data_job_vacancies');
        Route::post('fetch_job_vacancy', 'fetch_job_vacancy')->name('fetch_job_vacancy');
        Route::post('update_job_vacancies', 'update_job_vacancies')->name('update_job_vacancies');
        Route::post('delete_job_vacancies', 'delete_job_vacancies')->name('delete_job_vacancies');
        Route::get('show_job_details', 'show_job_details')->name('show_job_details');
        Route::post('applied_job', 'applied_job')->name('applied_job');
    });
    // job vacancy   end 
    //public_holiday  start 
    Route::resource('public_holiday', PublicHolidayController::class);
    Route::controller(PublicHolidayController::class)->group(function () {
        Route::get('get_data_public_holiday', 'getData')->name('get_data_public_holiday');
        Route::post('fetch_public_holiday', 'fetch_public_holiday')->name('fetch_public_holiday');
        Route::post('update_public_holiday', 'update_public_holiday')->name('update_public_holiday');
        Route::post('delete_public_holiday', 'delete_public_holiday')->name('delete_public_holiday');
    });
    // public_holiday  end 
    //hrm_week_day start 
    Route::resource('hrm_week_day', HrmWeekDayController::class);
    Route::controller(HrmWeekDayController::class)->group(function () {
        Route::get('get_data_hrm_week_day', 'getData')->name('get_data_hrm_week_day');
        Route::post('on_off_day', 'on_off_day')->name('on_off_day');
    });
    // hrm_week_day  end 
    //  hrm_print_controller start
    Route::controller(HrmPrintController::class)->group(function () {
        Route::get('view_payroll/{payroll_id?}', 'viewPayroll')->name('view_payroll');
        Route::get('download_payroll/{payroll_id?}', 'downloadPayroll')->name('download_payroll');
        Route::get('printPayroll/{payroll_id?}', 'printPayroll')->name('printPayroll');
        Route::post('print_payroll_url', 'print_payroll_url')->name('print_payroll_url');
        Route::post('payroll_page', 'payrollPage')->name('payroll_page');
        // Route::get('return_pdf/{payroll_id?}','returnPdf')->name('return_pdf');

        Route::get('view_payroll_by_employee/{payroll_id?}/{company_id?}', 'viewPayrollByEmployee')->name('view_payroll_by_employee');
        Route::get('thermal_print_reciept_of_payroll', 'thermalPrintRecieptOfPayroll')->name('thermal_print_reciept_of_payroll');
        Route::get('viewPdf', 'viewPdf')->name('viewPdf');

        // Route::post('on_off_day','on_off_day')->name('on_off_day');

    });
    //  hrm_print_controller end
    //work_shift  start 
    Route::resource('work_shift', WorkShiftController::class);
    Route::controller(WorkShiftController::class)->group(function () {
        Route::get('get_data_work_shift', 'getData')->name('get_data_work_shift');
        Route::post('fetch_work_shift', 'fetch_work_shift')->name('fetch_work_shift');
        Route::post('update_work_shift', 'update_work_shift')->name('update_work_shift');
        Route::post('delete_work_shift', 'delete_work_shift')->name('delete_work_shift');
    });
    // work_shift  end 
    //attendence  start 
    Route::resource('attendence', AttendenceController::class);
    Route::controller(AttendenceController::class)->group(function () {
        Route::get('get_data_attendence', 'getData')->name('get_data_attendence');
        Route::post('fetch_attendence', 'fetch_attendence')->name('fetch_attendence');
        Route::post('update_attendence', 'update_attendence')->name('update_attendence');
        Route::post('delete_attendence', 'delete_attendence')->name('delete_attendence');
        Route::get('get_employee_names_attendence', 'get_employee_names_attendence')->name('get_employee_names_attendence');
        Route::get('get_employee_names_shift_attendence', 'get_employee_names_shift_attendence')->name('get_employee_names_shift_attendence');
    });
    // attendence  end 
    //  start 
    Route::resource('payroll', HrmPayrollController::class);
    Route::controller(HrmPayrollController::class)->group(function () {
        Route::get('get_data_payroll', 'getData')->name('get_data_payroll');
        Route::post('fetch_payroll', 'fetch_attendence')->name('fetch_payroll');
        Route::post('update_payroll', 'update_attendence')->name('update_payroll');
        Route::post('delete_payroll', 'delete_attendence')->name('delete_payroll');
        Route::get('get_employee_names_payroll', 'get_employee_names_attendence')->name('get_employee_names_payroll');
        Route::get('get_employee_names_shift_payroll', 'get_employee_names_shift_payroll')->name('get_employee_names_shift_payroll');
    });
    // payroll  end 

    // applied_candidate  start 
    Route::resource('applied_candidate', AppliedCandidateController::class);
    Route::controller(AppliedCandidateController::class)->group(function () {
        Route::get('get_data_applied_candidate', 'getData')->name('get_data_applied_candidate');
        Route::post('fetch_applied_candidate', 'fetch_applied_candidate')->name('fetch_applied_candidate');
        Route::get('download_candidate_file/{download_backup?}', 'download_candidate_file')->name('download_candidate_file');
        Route::get('view_interview_status', 'view_interview_status')->name('view_interview_status');
        Route::get('get_data_interview', 'get_data_interview')->name('get_data_interview');
        Route::post('interview_status_change', 'interview_status_change')->name('interview_status_change');
    });
    // applied_candidate  end 



    // webfront header start 
    Route::resource('header', WebfrontHeaderController::class);
    Route::controller(WebfrontHeaderController::class)->group(function () {
        Route::get('update_header', 'update_header')->name('update_header');
        Route::post('database_update_head', 'update_header_db')->name('database_update_head');
        Route::get('update_body', 'update_body')->name('update_body');
        Route::post('database_update_body', 'update_body_db')->name('database_update_body');
        Route::get('update_footer', 'update_footer')->name('update_footer');
        Route::post('database_update_footer', 'database_update_footer')->name('database_update_footer');
    });
    // webfront header end 
    // app settings start 
    Route::controller(AppSettingsController::class)->group(function () {
        Route::get('change_logo', 'change_logo')->name('change_logo');
        Route::post('update_app_logo', 'update_app_logo')->name('update_app_logo');
    });
    // app settings end 

    // crm start ----------------------------------------------------------------------------------
    Route::resource('contact', CrmContactController::class);
        Route::controller(CrmContactController::class)->group(function () {
            Route::get('get_data_contact', 'get_data_contact')->name('get_data_contact');
            Route::get('update_contact_form/{update_user_id?}', 'userUpdateForm')->name('update_contact_form');
            Route::post('update_contact', 'updateUser')->name("update_contact");
            Route::get('contact_details/{user_id?}', 'contactDetails')->name('contact_details');
            Route::post('return_url_contact', 'returnUrlContact')->name("return_url_contact");
            Route::get('print_contact_details/{user_id?}', 'printContactDetails')->name("print_contact_details");
            
        });



        //category  start 
    Route::resource('category', CrmCategoryController::class);
    Route::controller(CrmCategoryController::class)->group(function () {
        Route::get('get_data_crm_category', 'getData')->name('get_data_crm_category');
        Route::post('fetch_crm_category', 'fetch_crm_category')->name('fetch_crm_category');
        Route::post('update_crm_category', 'update_crm_category')->name('update_crm_category');
        Route::post('delete_crm_category', 'delete_crm_category')->name('delete_crm_category');
    });
    // category  end 

    // lead start 
    Route::resource('lead', CrmLeadController::class);
    Route::controller(CrmLeadController::class)->group(function(){
        Route::get('leadGetData', 'getData')->name('leadGetData');
        Route::post('leadDelete', 'delete')->name('leadDelete');
        Route::get('leadUpdateForm/{crmLeadId?}', 'updateForm')->name('leadUpdateForm');
        Route::post('leadUpdate', 'update')->name('leadUpdate');
        Route::get('leadDetails/{crmLeadId?}', 'Details')->name('leadDetails');
        Route::post('leadUrl', 'crmLeadUrl')->name('leadUrl');
        Route::get('leadDetailsPrint/{crmLeadId?}', 'crmLeadDetailsPrint')->name('leadDetailsPrint');
    });
    // lead end 
    // oppertunity start 
    Route::resource('oppertunity', CrmOppertunityController::class);
    Route::controller(CrmOppertunityController::class)->group(function(){
        Route::get('oppertunityGetData', 'getData')->name('oppertunityGetData');
        Route::post('oppertunityDelete', 'delete')->name('oppertunityDelete');
        Route::get('oppertunityUpdateForm/{crmOppertunityId?}', 'updateForm')->name('oppertunityUpdateForm');
        Route::post('oppertunityUpdate', 'update')->name('oppertunityUpdate');
        Route::get('oppertunityDetails/{crmOppertunityId?}', 'Details')->name('oppertunityDetails');
        Route::post('oppertunityUrl', 'crmOppertunityUrl')->name('oppertunityUrl');
        Route::get('oppertunityDetailsPrint/{crmOppertunityId?}', 'crmOppertunityDetailsPrint')->name('oppertunityDetailsPrint');
    });
    // oppertunity end 
    // phone call start 
    Route::resource('phoneCall', CrmPhoneCallController::class);
    Route::controller(CrmPhoneCallController::class)->group(function(){
        Route::get('phoneCallGetData', 'getData')->name('phoneCallGetData');
        Route::post('phoneCallDelete', 'delete')->name('phoneCallDelete');
        Route::get('phoneCallUpdateForm/{crmPhoneCallId?}', 'updateForm')->name('phoneCallUpdateForm');
        Route::post('phoneCallUpdate', 'update')->name('phoneCallUpdate');
        Route::get('phoneCallDetails/{crmPhoneCallId?}', 'Details')->name('phoneCallDetails');
        Route::post('phoneCallUrl', 'crmPhoneCallUrl')->name('phoneCallUrl');
        Route::get('phoneCallDetailsPrint/{crmPhoneCallId?}', 'crmPhoneCallDetailsPrint')->name('phoneCallDetailsPrint');
    });
    // phone call end 

    // schedule phone call start 
    Route::resource('schedulePhoneCall', CrmSchedulePhoneCallController::class);
    Route::controller(CrmSchedulePhoneCallController::class)->group(function(){
        Route::get('schedulePhoneCallGetData', 'getData')->name('schedulePhoneCallGetData');
        Route::post('schedulePhoneCallDelete', 'delete')->name('schedulePhoneCallDelete');
        Route::get('schedulePhoneCallUpdateForm/{crmSchedulePhoneCallId?}', 'updateForm')->name('schedulePhoneCallUpdateForm');
        Route::post('schedulePhoneCallUpdate', 'update')->name('schedulePhoneCallUpdate');
        Route::get('schedulePhoneCallDetails/{crmSchedulePhoneCallId?}', 'Details')->name('schedulePhoneCallDetails');
        Route::post('schedulePhoneCallUrl', 'crmSchedulePhoneCallUrl')->name('schedulePhoneCallUrl');
        Route::get('schedulePhoneCallDetailsPrint/{crmSchedulePhoneCallId?}', 'crmSchedulePhoneCallDetailsPrint')->name('schedulePhoneCallDetailsPrint');
    });
    // schedule phone call end 

    Route::controller(CrmController::class)->group(function(){
        Route::get('crmDashboard','crmDashboard')->name('crmDashboard');

    });
    // crm end ---------------------------------------------------------------------------------


    // product start ---------------------------------------------------------------------------------
    //pro Category  start 
    Route::resource('proCategory', ProCategoryController::class);
    Route::controller(ProCategoryController::class)->group(function () {
        Route::get('proCategoryGetData', 'getData')->name('proCategoryGetData');
        Route::post('proCategoryFetch', 'proCategoryFetch')->name('proCategoryFetch');
        Route::post('proCategoryUpdate', 'update')->name('proCategoryUpdate');
        Route::post('proCategoryDelete', 'delete')->name('proCategoryDelete');
    });
    // pro Category  end 
    //pro Brand  start 
    Route::resource('proBrand', ProBrandController::class);
    Route::controller(ProBrandController::class)->group(function () {
        Route::get('proBrandGetData', 'getData')->name('proBrandGetData');
        Route::post('proBrandFetch', 'proBrandFetch')->name('proBrandFetch');
        Route::post('proBrandUpdate', 'update')->name('proBrandUpdate');
        Route::post('proBrandDelete', 'delete')->name('proBrandDelete');
    });
    // pro Brand  end 
    //pro attribute  start 
    Route::resource('proAttribute', ProAttributeController::class);
    Route::controller(ProAttributeController::class)->group(function () {
        Route::get('proAttributeGetData', 'getData')->name('proAttributeGetData');
        Route::post('proAttributeFetch', 'proAttributeFetch')->name('proAttributeFetch');
        Route::post('proAttributeUpdate', 'update')->name('proAttributeUpdate');
        Route::post('proAttributeDelete', 'delete')->name('proAttributeDelete');
    });
    // pro attribute  end 
    //pro attribute  value start 
    Route::resource('proAttributeValue', ProAttributeValueController::class);
    Route::controller(ProAttributeValueController::class)->group(function () {
        Route::get('proAttributeValueGetData', 'getData')->name('proAttributeValueGetData');
        Route::post('proAttributeValueFetch', 'proAttributeValueFetch')->name('proAttributeValueFetch');
        Route::post('proAttributeValueUpdate', 'update')->name('proAttributeValueUpdate');
        Route::post('proAttributeValueDelete', 'delete')->name('proAttributeValueDelete');
    });
    // pro attribute  value end 
    //pro Unit  start 
    Route::resource('proUnit', ProUnitController::class);
    Route::controller(ProUnitController::class)->group(function () {
        Route::get('proUnitGetData', 'getData')->name('proUnitGetData');
        Route::post('proUnitFetch', 'proUnitFetch')->name('proUnitFetch');
        Route::post('proUnitUpdate', 'update')->name('proUnitUpdate');
        Route::post('proUnitDelete', 'delete')->name('proUnitDelete');
    });
    // pro Unit  end 
    //pro Tax  start 
    Route::resource('proTax', ProTaxController::class);
    Route::controller(ProTaxController::class)->group(function () {
        Route::get('proTaxGetData', 'getData')->name('proTaxGetData');
        Route::post('proTaxFetch', 'proTaxFetch')->name('proTaxFetch');
        Route::post('proTaxUpdate', 'update')->name('proTaxUpdate');
        Route::post('proTaxDelete', 'delete')->name('proTaxDelete');
    });
    // pro Tax  end 

    // warrenty start 
    Route::resource('proWarrenty', ProWarrentyController::class);
    Route::controller(ProWarrentyController::class)->group(function(){
        Route::get('proWarrentyGetData', 'getData')->name('proWarrentyGetData');
        Route::post('proWarrentyDelete', 'delete')->name('proWarrentyDelete');
        Route::get('proWarrentyUpdateForm/{proWarrentyId?}', 'updateForm')->name('proWarrentyUpdateForm');
        Route::post('proWarrentyUpdate', 'update')->name('proWarrentyUpdate');
        Route::get('proWarrentyDetails/{proWarrentyId?}', 'Details')->name('proWarrentyDetails');
        Route::post('proWarrentyUrl', 'proWarrentyUrl')->name('proWarrentyUrl');
        Route::get('proWarrentyDetailsPrint/{proWarrentyId?}', 'proWarrentyDetailsPrint')->name('proWarrentyDetailsPrint');
    });
    // warrenty end 
    // product start 
    Route::resource('proProduct', ProProductController::class);
    Route::controller(ProProductController::class)->group(function(){
        Route::get('proProductGetData', 'getData')->name('proProductGetData');
        Route::post('proProductDelete', 'delete')->name('proProductDelete');
        Route::get('proProductUpdateForm/{proProductId?}', 'updateForm')->name('proProductUpdateForm');
        Route::post('proProductUpdate', 'update')->name('proProductUpdate');
        Route::get('proProductDetails/{proProductId?}', 'Details')->name('proProductDetails');
        Route::post('proProductUrl', 'proProductUrl')->name('proProductUrl');
        Route::get('proProductDetailsPrint/{proProductId?}', 'proProductDetailsPrint')->name('proProductDetailsPrint');
        Route::post('is_exist_product_sku','isExistProductSku')->name('is_exist_product_sku');
        Route::post('is_exist_product_sku_for_update','isExistProductSkuForUpdate')->name('is_exist_product_sku_for_update');
    });

    // product end 
    //  --------------------------------------------------------------------------------- product end

    // purchase start -----------------------------------------------------------------------------
    // quotation request start 
    Route::resource('pro_quotation_req', PurProductQuotationRequestController::class);
    Route::controller(PurProductQuotationRequestController::class)->group(function(){
        Route::get('pro_quotation_req_get_data', 'getData')->name('pro_quotation_req_get_data');
        Route::post('pro_quotation_req_delete', 'delete')->name('pro_quotation_req_delete');
        Route::get('pro_quotation_req_update_form/{proQuotationReqId?}', 'updateForm')->name('pro_quotation_req_update_form');
        Route::post('pro_quotation_req_update', 'update')->name('pro_quotation_req_update');
        Route::get('pro_quotation_req_detail/{pro_quotation_req_id?}', 'Details')->name('pro_quotation_req_detail');
        Route::post('pro_quotation_req_url', 'proQuotationReqUrl')->name('pro_quotation_req_url');
        Route::get('pro_quotation_req_details_print/{id?}', 'proQuotationReqDetailsPrint')->name('pro_quotation_req_details_print');
        Route::post('product_taxes', 'productTaxes')->name('product_taxes');
        Route::post('product_taxes_select_field', 'productTaxesSelectField')->name('product_taxes_select_field');
    });
    // lead end 

    // supplier start 

    Route::resource('supplier', PurSupplierController::class);
        Route::controller(PurSupplierController::class)->group(function () {
            Route::get('get_data_supplier', 'get_data_contact')->name('get_data_supplier');
            Route::get('update_supplier_form/{update_user_id?}', 'userUpdateForm')->name('update_supplier_form');
            Route::post('update_supplier', 'updateUser')->name("update_supplier");
            Route::get('supplier_details/{user_id?}', 'contactDetails')->name('supplier_details');
            Route::post('return_url_supplier', 'returnUrlContact')->name("return_url_supplier");
            Route::get('print_supplier_details/{user_id?}', 'printContactDetails')->name("print_supplier_details");
            
        });
        // supplier start 

        // purchase quotation  start 
    Route::resource('pur_purchase_quotation',PurPurchaseQuotationController::class);
    Route::controller(PurPurchaseQuotationController::class)->group(function(){
        Route::get('pur_purchase_quotation_get_data', 'getData')->name('pur_purchase_quotation_get_data');
        Route::post('pur_purchase_quotation_delete', 'delete')->name('pur_purchase_quotation_delete');
        Route::get('pur_purchase_quotation_update_form/{purPurchaseQuotationId?}', 'updateForm')->name('pur_purchase_quotation_update_form');
        Route::post('pur_purchase_quotation_update', 'update')->name('pur_purchase_quotation_update');
        Route::get('pur_purchase_quotation_detail/{purPurchaseQuotationId?}', 'details')->name('pur_purchase_quotation_detail');
        Route::post('pur_purchase_quotation_url', 'purPurchaseQuotationUrl')->name('pur_purchase_quotation_url');
        Route::get('pur_purchase_quotation_detail_print/{id?}', 'purPurchaseQuotationDetailPrint')->name('pur_purchase_quotation_detail_print');

        Route::post('quotation_to_order','quotationToOrder')->name('quotation_to_order');

    });
    // purchase quotation  end 
    // purchase order  start 
    Route::resource('pur_purchase_order',PurPurchaseOrderController::class);
    Route::controller(PurPurchaseOrderController::class)->group(function(){
        Route::get('pur_purchase_order_get_data', 'getData')->name('pur_purchase_order_get_data');
        Route::post('pur_purchase_order_delete', 'delete')->name('pur_purchase_order_delete');
        Route::get('pur_purchase_order_update_form/{purPurchaseOrderId?}', 'updateForm')->name('pur_purchase_order_update_form');
        Route::post('pur_purchase_order_update', 'update')->name('pur_purchase_order_update');
        Route::get('pur_purchase_order_detail/{purPurchaseOrderId?}', 'details')->name('pur_purchase_order_detail');
        Route::post('pur_purchase_order_url', 'purPurchaseOrderUrl')->name('pur_purchase_order_url');
        Route::get('pur_purchase_order_detail_print/{id?}', 'purPurchaseOrderDetailPrint')->name('pur_purchase_order_detail_print');
    });
    // purchase order  end 

    // ware house start  
    Route::resource('pur_warehouse',PurWarehouseController::class);
    Route::controller(PurWarehouseController::class)->group(function () {
        Route::get('pur_warehouse_get_data', 'getData')->name('pur_warehouse_get_data');
        Route::post('pur_warehouse_fetch', 'purWarehouseFetch')->name('pur_warehouse_fetch');
        Route::post('pur_warehouse_update', 'update')->name('pur_warehouse_update');
        Route::post('pur_warehouse_delete', 'delete')->name('pur_warehouse_delete');
    });

    // ware house end  

    // invoice  start 
    Route::resource('pur_invoice',PurInvoiceController::class);
    Route::controller(PurInvoiceController::class)->group(function(){
        Route::get('pur_invoice_get_data', 'getData')->name('pur_invoice_get_data');
        Route::post('pur_invoice_delete', 'delete')->name('pur_invoice_delete');
        Route::get('pur_invoice_update_form/{purInvoiceId?}', 'updateForm')->name('pur_invoice_update_form');
        Route::post('pur_invoice_update', 'update')->name('pur_invoice_update');
        Route::get('pur_invoice_detail/{purInvoiceId?}', 'details')->name('pur_invoice_detail');
        Route::post('pur_invoice_url', 'purInvoiceUrl')->name('pur_invoice_url');
        Route::get('pur_invoice_detail_print/{id?}', 'purInvoiceDetailPrint')->name('pur_invoice_detail_print');

        // Route::post('quotation_to_order','quotationToOrder')->name('quotation_to_order');

    });
    // invoice  end 

    // ware house stock start  
    Route::resource('pur_warehouse_stock',PurWarehouseStockController::class);
    Route::controller(PurWarehouseStockController::class)->group(function () {
        Route::get('pur_warehouse_stock_get_data', 'getData')->name('pur_warehouse_stock_get_data');
        Route::post('pur_warehouse_stock_fetch', 'purWarehouseStockFetch')->name('pur_warehouse_stock_fetch');
        Route::post('pur_warehouse_stock_update', 'update')->name('pur_warehouse_stock_update');
        Route::post('pur_warehouse_stock_delete', 'delete')->name('pur_warehouse_stock_delete');
    });

    // ware house stock end  



    // delivery note  start 
    Route::resource('pur_delivery_note',PurDeliveryNoteController::class);
    Route::controller(PurDeliveryNoteController::class)->group(function(){
        Route::get('pur_delivery_note_get_data', 'getData')->name('pur_delivery_note_get_data');
        Route::post('pur_delivery_note_delete', 'delete')->name('pur_delivery_note_delete');
        Route::get('pur_delivery_note_update_form/{purDeliveryNoteId?}', 'updateForm')->name('pur_delivery_note_update_form');
        Route::post('pur_delivery_note_update', 'update')->name('pur_delivery_note_update');
        Route::get('pur_delivery_note_detail/{purDeliveryNoteId?}', 'details')->name('pur_delivery_note_detail');
        Route::post('pur_delivery_note_url', 'purDeliveryNoteUrl')->name('pur_delivery_note_url');
        Route::get('pur_delivery_note_detail_print/{id?}', 'purDeliveryNoteDetailPrint')->name('pur_delivery_note_detail_print');
        // Route::post('quotation_to_order','quotationToOrder')->name('quotation_to_order');

    });
    // delivery note  end 


    // purchase return  start 
    Route::resource('pur_purchase_return',PurPurchaseReturnController::class);
    Route::controller(PurPurchaseReturnController::class)->group(function(){
        Route::get('pur_purchase_return_get_data', 'getData')->name('pur_purchase_return_get_data');
        Route::post('pur_purchase_return_delete', 'delete')->name('pur_purchase_return_delete');
        Route::get('pur_purchase_return_update_form/{purPurchaseReturnId?}', 'updateForm')->name('pur_purchase_return_update_form');
        Route::post('pur_purchase_return_update', 'update')->name('pur_purchase_return_update');
        Route::get('pur_purchase_return_detail/{purPurchaseReturnId?}', 'details')->name('pur_purchase_return_detail');
        Route::post('pur_purchase_return_url', 'purPurchaseReturnUrl')->name('pur_purchase_return_url');
        Route::get('pur_purchase_return_detail_print/{id?}', 'purPurchaseReturnDetailPrint')->name('pur_purchase_return_detail_print');
        // Route::post('quotation_to_order','quotationToOrder')->name('quotation_to_order');

    });
    // purchase return  end 

    // purchase controller start 
    // PurchaseController
    Route::controller(PurchaseController::class)->group(function(){
        Route::get('purchase_forecast','purchaseForecast')->name('purchase_forecast');

    });
    // purchase controller end 

    
    // -----------------------------------------------------------------------------  purchase end

    
    // sales module start ---------------------------------------------------------------------------
    // Route::get('store_cash_register_amount_in_session', [SaleController::class, 'storeCashRegisterAmountInSession'])->name('store_cash_register_amount_in_session');
    Route::controller(SaleController::class)->group(function(){

        Route::get('sale_forecast','saleForecast')->name('sale_forecast');
        Route::get('store_cash_register_amount_in_session','storeCashRegisterAmountInSession')
        ->middleware('close_pos')
        
        ->name
        ('store_cash_register_amount_in_session')
        ;
        Route::get('open_cash_register','openCashRegister')->middleware('check_register_open')->name('open_cash_register');
        Route::post('close_register','closeRegister')->name('close_register');
        Route::post('close_register_by_admin','closeRegisterByAdmin')->name('close_register_by_admin');
        Route::get('sal_list_pos','salListPos')->name('sal_list_pos');
        Route::get('sal_list_pos_get_data/{date?}','salListPosGetData')->name('sal_list_pos_get_data');
        
        
        Route::get('pos_detail/{cashRegisterId}','posDetail')->name('pos_detail');
        Route::post('fetch_product_for_pos','fetchProductForPos')->name('fetch_product_for_pos');
        Route::post('store_pos','storePos')->middleware('close_pos_ajax')->name('store_pos');        
        Route::get('sessionValue', 'sessionValue')->name("sessionValue");

        Route::post('cash_register_url', 'cashRegisterUrl')->name('cash_register_url');
        Route::get('cash_register_detail_print/{id?}', 'cashRegisterDetailPrint')->name('cash_register_detail_print');
        // cashier
        Route::get('pos_detail_cashier','posDetailCashier')->name('pos_detail_cashier');

    });
    // customer start 
    Route::resource('customer', SalCustomerController::class);
        Route::controller(SalCustomerController::class)->group(function () {
            Route::get('get_data_customer', 'get_data_contact')->name('get_data_customer');
            Route::get('update_customer_form/{update_user_id?}', 'userUpdateForm')->name('update_customer_form');
            Route::post('update_customer', 'updateUser')->name("update_customer");
            Route::get('customer_details/{user_id?}', 'contactDetails')->name('customer_details');
            Route::post('return_url_customer', 'returnUrlContact')->name("return_url_customer");
            Route::get('print_customer_details/{user_id?}', 'printContactDetails')->name("print_customer_details");
            
            
        });
        // customer start 

        // sale start 
    Route::resource('sal_quotation',SalQuotationController::class);
    Route::controller(SalQuotationController::class)->group(function(){
        Route::get('sal_quotation_get_data', 'getData')->name('sal_quotation_get_data');
        Route::post('sal_quotation_delete', 'delete')->name('sal_quotation_delete');
        Route::get('sal_quotation_update_form/{salQuotationId?}', 'updateForm')->name('sal_quotation_update_form');
        Route::post('sal_quotation_update', 'update')->name('sal_quotation_update');
        Route::get('sal_quotation_detail/{salQuotationId?}', 'details')->name('sal_quotation_detail');
        Route::post('sal_quotation_url', 'salQuotationUrl')->name('sal_quotation_url');
        Route::get('sal_quotation_detail_print/{id?}', 'salQuotationDetailPrint')->name('sal_quotation_detail_print');

        Route::post('quotation_to_order','quotationToOrder')->name('quotation_to_order');

    });
    // sale end 
    // sale order  start 
    Route::resource('sal_order',SalOrderController::class);
    Route::controller(SalOrderController::class)->group(function(){
        Route::get('sal_order_get_data', 'getData')->name('sal_order_get_data');
        Route::post('sal_order_delete', 'delete')->name('sal_order_delete');
        Route::get('sal_order_update_form/{salOrderId?}', 'updateForm')->name('sal_order_update_form');
        Route::post('sal_order_update', 'update')->name('sal_order_update');
        Route::get('sal_order_detail/{salOrderId?}', 'details')->name('sal_order_detail');
        Route::post('sal_order_url', 'salOrderUrl')->name('sal_order_url');
        Route::get('sal_order_detail_print/{id?}', 'salOrderDetailPrint')->name('sal_order_detail_print');
    });
    // sale order  end 


    // invoice  start 
    Route::resource('sal_invoice',SalInvoiceController::class);
    Route::controller(SalInvoiceController::class)->group(function(){
        Route::get('sal_invoice_get_data', 'getData')->name('sal_invoice_get_data');
        Route::post('sal_invoice_delete', 'delete')->name('sal_invoice_delete');
        Route::get('sal_invoice_update_form/{salInvoiceId?}', 'updateForm')->name('sal_invoice_update_form');
        Route::post('sal_invoice_update', 'update')->name('sal_invoice_update');
        Route::get('sal_invoice_detail/{salInvoiceId?}', 'details')->name('sal_invoice_detail');
        Route::post('sal_invoice_url', 'salInvoiceUrl')->name('sal_invoice_url');
        Route::get('sal_invoice_detail_print/{id?}', 'salInvoiceDetailPrint')->name('sal_invoice_detail_print');

        // Route::post('quotation_to_order','quotationToOrder')->name('quotation_to_order');

    });
    // invoice  end 
    // delivery note  start 
    Route::resource('sal_delivery_note',SalDeliveryNoteController::class);
    Route::controller(SalDeliveryNoteController::class)->group(function(){
        Route::get('sal_delivery_note_get_data', 'getData')->name('sal_delivery_note_get_data');
        Route::post('sal_delivery_note_delete', 'delete')->name('sal_delivery_note_delete');
        Route::get('sal_delivery_note_update_form/{salDeliveryNoteId?}', 'updateForm')->name('sal_delivery_note_update_form');
        Route::post('sal_delivery_note_update', 'update')->name('sal_delivery_note_update');
        Route::get('sal_delivery_note_detail/{salDeliveryNoteId?}', 'details')->name('sal_delivery_note_detail');
        Route::post('sal_delivery_note_url', 'salDeliveryNoteUrl')->name('sal_delivery_note_url');
        Route::get('sal_delivery_note_detail_print/{id?}', 'salDeliveryNoteDetailPrint')->name('sal_delivery_note_detail_print');
        // Route::post('quotation_to_order','quotationToOrder')->name('quotation_to_order');

    });
    // delivery note  end 
    // Sale return  start 
    Route::resource('sal_return',SalReturnController::class);
    Route::controller(SalReturnController::class)->group(function(){
        Route::get('sal_return_get_data', 'getData')->name('sal_return_get_data');
        Route::post('sal_return_delete', 'delete')->name('sal_return_delete');
        Route::get('sal_return_update_form/{salReturnId?}', 'updateForm')->name('sal_return_update_form');
        Route::post('sal_return_update', 'update')->name('sal_return_update');
        Route::get('sal_return_detail/{salReturnId?}', 'details')->name('sal_return_detail');
        Route::post('sal_return_url', 'salReturnUrl')->name('sal_return_url');
        Route::get('sal_return_detail_print/{id?}', 'salReturnDetailPrint')->name('sal_return_detail_print');
        // Route::post('quotation_to_order','quotationToOrder')->name('quotation_to_order');

    });
    // Sale return  end 

    //  --------------------------------------------------------------------------- sales module end


    // inventory module start ==============================================================
    // stock request start
    Route::resource('ims_stock_request', ImsStockRequestController::class);
    Route::controller(ImsStockRequestController::class)->group(function(){
        Route::get('ims_stock_request_get_data', 'getData')->name('ims_stock_request_get_data');
        Route::post('ims_stock_request_delete', 'delete')->name('ims_stock_request_delete');
        Route::get('ims_stock_request_update_form/{imsStockRequestId?}', 'updateForm')->name('ims_stock_request_update_form');
        Route::post('ims_stock_request_update', 'update')->name('ims_stock_request_update');
        Route::get('ims_stock_request_detail/{ims_stock_request_id?}', 'Details')->name('ims_stock_request_detail');
        Route::post('ims_stock_request_url', 'imsStockRequestUrl')->name('ims_stock_request_url');
        Route::get('ims_stock_request_details_print/{id?}', 'imsStockRequestDetailsPrint')->name('ims_stock_request_details_print');

        Route::post('update_ims_stock_request_status','updateImsStockRequestStatus')->name('update_ims_stock_request_status');
        
    });
    // stock request end
    // stock transfer start 
    Route::resource('ims_stock_transfer', ImsStockTransferController::class);
    Route::controller(ImsStockTransferController::class)->group(function(){
        Route::get('ims_stock_transfer_get_data', 'getData')->name('ims_stock_transfer_get_data');
        Route::post('ims_stock_transfer_delete', 'delete')->name('ims_stock_transfer_delete');
        Route::get('ims_stock_transfer_update_form/{imsStockRequestId?}', 'updateForm')->name('ims_stock_transfer_update_form');
        Route::post('ims_stock_transfer_update', 'update')->name('ims_stock_transfer_update');
        Route::get('ims_stock_transfer_detail/{ims_stock_request_id?}', 'Details')->name('ims_stock_transfer_detail');
        Route::post('ims_stock_transfer_url', 'imsStockTransferUrl')->name('ims_stock_transfer_url');
        Route::get('ims_stock_transfer_details_print/{id?}', 'imsStockTransferDetailsPrint')->name('ims_stock_transfer_details_print');
        
    });
    // stock transfer end 
    // stock receipt start
    Route::resource('ims_stock_receipt', ImsStockReceiptController::class);
    Route::controller(ImsStockReceiptController::class)->group(function(){
        Route::get('ims_stock_receipt_get_data', 'getData')->name('ims_stock_receipt_get_data');
        Route::post('ims_stock_receipt_delete', 'delete')->name('ims_stock_receipt_delete');
        Route::get('ims_stock_receipt_update_form/{imsStockRequestId?}', 'updateForm')->name('ims_stock_receipt_update_form');
        Route::post('ims_stock_receipt_update', 'update')->name('ims_stock_receipt_update');
        Route::get('ims_stock_receipt_detail/{ims_stock_request_id?}', 'Details')->name('ims_stock_receipt_detail');
        Route::post('ims_stock_receipt_url', 'imsStockReceiptUrl')->name('ims_stock_receipt_url');
        Route::get('ims_stock_receipt_details_print/{id?}', 'imsStockReceiptDetailsPrint')->name('ims_stock_receipt_details_print');

        
        
    });
    // stock receipt end
    //Ims Asset  start 
    Route::resource('ims_asset', ImsAssetController::class);
    Route::controller(ImsAssetController::class)->group(function () {
        Route::get('ims_asset_get_data', 'getData')->name('ims_asset_get_data');
        Route::post('ims_asset_fetch', 'imsAssetFetch')->name('ims_asset_fetch');
        Route::post('ims_asset_update', 'update')->name('ims_asset_update');
        Route::post('ims_asset_delete', 'delete')->name('ims_asset_delete');
    });
    // Ims Asset  end 
    // damage stock start
    Route::resource('ims_damage_stock', ImsDamageStockController::class);
    Route::controller(ImsDamageStockController::class)->group(function(){
        Route::get('ims_damage_stock_get_data', 'getData')->name('ims_damage_stock_get_data');
        Route::post('ims_damage_stock_delete', 'delete')->name('ims_damage_stock_delete');
        Route::get('ims_damage_stock_update_form/{imsDamageStockId?}', 'updateForm')->name('ims_damage_stock_update_form');
        Route::post('ims_damage_stock_update', 'update')->name('ims_damage_stock_update');
        Route::get('ims_damage_stock_detail/{ims_damage_stock_id?}', 'Details')->name('ims_damage_stock_detail');
        Route::post('ims_damage_stock_url', 'imsDamageStockUrl')->name('ims_damage_stock_url');
        Route::get('ims_damage_stock_details_print/{id?}', 'imsDamageStockDetailsPrint')->name('ims_damage_stock_details_print');

        Route::post('update_ims_damage_stock_status','updateImsDamageStockStatus')->name('update_ims_damage_stock_status');
        
    });
    // damage stock end
    // reports start 
    Route::controller(InventoryReportsController::class)->group(function(){
        Route::get('product_report_view', 'productReportView')->name('product_report_view');
        Route::get('product_report', 'productReport')->name('product_report');
        
        Route::get('warehouse_report_view', 'warehouseReportView')->name('warehouse_report_view');
        Route::get('warehouse_report', 'warehouseReport')->name('warehouse_report');

    });
    // report end
    //  ============================================================== inventory module end
    // account and finance start ==========================================================
    //Fiscal Period  start 
    Route::resource('acc_fiscal_period', AccFiscalPeriodController::class);
    Route::controller(AccFiscalPeriodController::class)->group(function () {
        Route::get('acc_fiscal_period_get_data', 'getData')->name('acc_fiscal_period_get_data');
        Route::post('acc_fiscal_period_fetch', 'accFiscalPeriodFetch')->name('acc_fiscal_period_fetch');
        Route::post('acc_fiscal_period_update', 'update')->name('acc_fiscal_period_update');
        Route::post('acc_fiscal_period_delete', 'delete')->name('acc_fiscal_period_delete');
        Route::post('fiscal_period_status_change', 'statusChange')->name('fiscal_period_status_change');
    });
    // Fiscal Period  end 
    //Family  start 
    Route::resource('acc_family', AccFamilyController::class);
    Route::controller(AccFamilyController::class)->group(function () {
        Route::get('acc_family_get_data', 'getData')->name('acc_family_get_data');
        
    });
    // Family  end 

    //Transaction Category  start 
    Route::resource('acc_transaction_category', AccTransactionCategoryController::class);
    Route::controller(AccTransactionCategoryController::class)->group(function () {
        Route::get('acc_transaction_category_get_data', 'getData')->name('acc_transaction_category_get_data');
        Route::post('acc_transaction_category_fetch', 'accTransactionCategoryFetch')->name('acc_transaction_category_fetch');
        Route::post('acc_transaction_category_update', 'update')->name('acc_transaction_category_update');
        Route::post('acc_transaction_category_delete', 'delete')->name('acc_transaction_category_delete');
    });
    // Transaction Category  end 
    //Cost Center  start 
    Route::resource('acc_cost_center', AccCostCenterController::class);
    Route::controller(AccCostCenterController::class)->group(function () {
        Route::get('acc_cost_center_get_data', 'getData')->name('acc_cost_center_get_data');
        Route::post('acc_cost_center_fetch', 'accCostCenterFetch')->name('acc_cost_center_fetch');
        Route::post('acc_cost_center_update', 'update')->name('acc_cost_center_update');
        Route::post('acc_cost_center_delete', 'delete')->name('acc_cost_center_delete');
    });
    // Cost Center  end 
    //Control Code start 
    Route::resource('acc_control_code', AccControlCodeController::class);
    Route::controller(AccControlCodeController::class)->group(function () {
        Route::get('acc_control_code_get_data', 'getData')->name('acc_control_code_get_data');
        Route::post('acc_control_code_fetch', 'accControlCodeFetch')->name('acc_control_code_fetch');
        Route::post('acc_control_code_update', 'update')->name('acc_control_code_update');
        Route::post('acc_control_code_delete', 'delete')->name('acc_control_code_delete');
    });
    // Control Code end 
    //Currency  start 
    Route::resource('acc_currency', AccCurrencyController::class);
    Route::controller(AccCurrencyController::class)->group(function () {
        Route::get('acc_currency_get_data', 'getData')->name('acc_currency_get_data');
        Route::post('acc_currency_fetch', 'accCurrencyFetch')->name('acc_currency_fetch');
        Route::post('acc_currency_update', 'update')->name('acc_currency_update');
        Route::post('acc_currency_delete', 'delete')->name('acc_currency_delete');
        Route::match( ['get','post'],'fetch_transaction_currency', 'fetchTransactionCurrency')->name('fetch_transaction_currency');
    });
    // Currency  end 
    //Account  start 
    Route::resource('acc_account', AccAccountController::class);
    Route::controller(AccAccountController::class)->group(function () {
        Route::get('acc_account_get_data', 'getData')->name('acc_account_get_data');
        Route::post('acc_account_fetch', 'accAccountFetch')->name('acc_account_fetch');
        Route::post('acc_account_update', 'update')->name('acc_account_update');
        Route::post('acc_account_delete', 'delete')->name('acc_account_delete');
        Route::post('check_head_account', 'checkHeadAccount')->name('check_head_account');
        Route::post('check_child_account', 'checkChildAccount')->name('check_child_account');
    });
    // Account  end 
    //Account Balance  start 
    Route::resource('acc_account_balance', AccAccountBalanceController::class);
    Route::controller(AccAccountBalanceController::class)->group(function () {
        Route::get('acc_account_balance_get_data', 'getData')->name('acc_account_balance_get_data');
        Route::post('acc_account_balance_fetch', 'accAccountBalanceFetch')->name('acc_account_balance_fetch');
        Route::post('acc_account_balance_update', 'update')->name('acc_account_balance_update');
        Route::post('acc_account_balance_delete', 'delete')->name('acc_account_balance_delete');
    });
    // Account Balance  end 
    // transaction start 
     
    Route::resource('acc_transaction', AccTransactionController::class);
    Route::controller(AccTransactionController::class)->group(function () {
        // Route::get('acc_cost_center_get_data', 'getData')->name('acc_cost_center_get_data');
        // Route::post('acc_cost_center_fetch', 'accCostCenterFetch')->name('acc_cost_center_fetch');
        // Route::post('acc_cost_center_update', 'update')->name('acc_cost_center_update');
        Route::get('acc_transaction_post_view', 'postView')->name('acc_transaction_post_view');
        Route::post('post_transaction_store', 'postTransactionStore')->name('post_transaction_store');
    });
    // transaction start 


    // journal entry start 
     
    Route::resource('acc_journal_entry', AccJournalEntryController::class);
    Route::controller(AccJournalEntryController::class)->group(function () {
        // Route::get('acc_cost_center_get_data', 'getData')->name('acc_cost_center_get_data');
        // Route::post('acc_cost_center_fetch', 'accCostCenterFetch')->name('acc_cost_center_fetch');
        // Route::post('acc_cost_center_update', 'update')->name('acc_cost_center_update');
        // Route::post('acc_cost_center_delete', 'delete')->name('acc_cost_center_delete');
    });
    // journal entry start 

    // payable account start 
    Route::resource('acc_payable', AccPayableController::class);
    Route::controller(AccPayableController::class)->group(function () {
        // Route::get('acc_cost_center_get_data', 'getData')->name('acc_cost_center_get_data');
        // Route::post('acc_cost_center_fetch', 'accCostCenterFetch')->name('acc_cost_center_fetch');
        // Route::post('acc_cost_center_update', 'update')->name('acc_cost_center_update');
        Route::post('acc_payable_fetch', 'accPayableFetch')->name('acc_payable_fetch');
    });
    // payable account end 
    // recievable account start 
    Route::resource('acc_recievable', AccRecievableController::class);
    Route::controller(AccRecievableController::class)->group(function () {
        // Route::get('acc_cost_center_get_data', 'getData')->name('acc_cost_center_get_data');
        // Route::post('acc_cost_center_fetch', 'accCostCenterFetch')->name('acc_cost_center_fetch');
        // Route::post('acc_cost_center_update', 'update')->name('acc_cost_center_update');
        Route::post('acc_recievable_fetch', 'accFetch')->name('acc_recievable_fetch');
    });
    // recievable account end 

    //authorization Code start 
    Route::resource('acc_authorization', AccAuthorizationController::class);
    Route::controller(AccAuthorizationController::class)->group(function () {
        Route::get('acc_authorization_get_data', 'getData')->name('acc_authorization_get_data');
        
    });
    // authorization Code end 
    //trial balance Code start 
    Route::resource('acc_trial_balance', AccTrialBalanceController::class);
    Route::controller(AccTrialBalanceController::class)->group(function () {
        Route::get('acc_trial_balance_get_data', 'getData')->name('acc_trial_balance_get_data');
        
    });
    // trial balance Code end 



    
    //============================================================ account and finance end 


    Route::middleware(['is_app_admin'])->group(function () {
        // data base backup start 
        Route::resource('db_backup', DbBackupController::class);
        Route::get('get_data_db_backup', [DbBackupController::class, 'getData'])->name('get_data_db_backup');
        Route::get('database_backup', [DbBackupController::class, 'getDbBackup'])->name('database_backup');
        Route::post('delete_db_backup', [DbBackupController::class, 'deleteDbBackup'])->name('delete_db_backup');
        Route::get('download_backup/{backup_file_name}', [DbBackupController::class, 'downloadBackup'])->name('download_backup');
        // data base backup start 
        // subscription packages  start  
        Route::resource('subscription_packages', SubscriptionPackagesController::class);
        Route::get('get_data_subscription_packages', [SubscriptionPackagesController::class, 'getData'])->name('get_data_subscription_packages');
        Route::post('delete_subscription_packages', [SubscriptionPackagesController::class, 'deleteSubscriptionPackages'])->name('delete_subscription_packages');
        Route::get('updateSubscriptionPackages/{update_subscription_packages_id?}', [SubscriptionPackagesController::class, 'updateSubscriptionPackagesForm'])->name('updateSubscriptionPackages');
        Route::post('update_subscription_packages', [SubscriptionPackagesController::class, 'updateSubscriptionPackages'])->name('update_subscription_packages');
        //  subscription packages  end 
    });
    // Notification start 
    Route::get('mark_as_read', [Notifications::class, 'markAsRead'])->name('mark_as_read');
    Route::get('email_settings', [Notifications::class, 'emailSettingView'])->name('email_settings');
    Route::post('on_off_email', [Notifications::class, 'OnOffEmail'])->name('on_off_email');

    // Notification end







}); //./Route End for Middleware Auth







/*
|--------------------------------------------------------------------------
|  Web Front Page | Public View | E-Commerce
|--------------------------------------------------------------------------
|
| Here is where you can load public view e-commerce store front page for
| selected company
*/


Route::controller(WebFrontController::class)->group(function () {
    Route::get('/', 'WebFront')->name('web_front')->name('home');
    Route::get('/{unique_url?}/{jobs?}', 'WebFront')->name('home');
});

// Auth::routes();


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
