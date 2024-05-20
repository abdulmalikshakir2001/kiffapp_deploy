<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateUsersPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     * The Table is for static data purpose and shall be used by the developers only.
     * To add the module name to load in group permissions. The boolean fields are only
     * to help in creating the user form for group permissions assignment.
     * @return void
     */
    public function up()
    {

        Schema::create('users_permissions', function (Blueprint $table) {
            $table->increments('permission_id');
            $table->string('app_module_name');
            $table->string('permission_name');
            $table->softDeletes();
            $table->timestamps();
        });

        // Insert Default System Forms in the Permissions Table


            /** App Settings Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'UsersManagement']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'ManageGroups']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'SubscriptionPackages']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'Subscriptions']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'Companies']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'FullDatabase Backup']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'GlobalConfig']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'EmailSettings']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'SMSSettings']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'PaymentGateways']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'SecurityQuestions']);
            DB::table('users_permissions')->insert(['app_module_name' => 'AppSettings', 'permission_name' => 'Others']);

            /** Home Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'Home', 'permission_name' => 'Profile']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Home', 'permission_name' => 'ChangePassword']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Home', 'permission_name' => 'Notifications']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Home', 'permission_name' => 'Messages']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Home', 'permission_name' => 'ToDoTasks']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Home', 'permission_name' => 'NotificationsPreferences']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Home', 'permission_name' => 'Logout']);

            /* System Settings Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'SystemUsersManagement']);
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'SystemManageGroups']);
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'SystemCompanyProfile']);
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'SystemSubscriptions']);
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'Options']);
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'Header']);
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'Footer']);
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'MainContent']);
            DB::table('users_permissions')->insert(['app_module_name' => 'SystemSettings', 'permission_name' => 'ProductsPage']);
            /* Human Resources Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'HRM', 'permission_name' => 'Employees']);
            DB::table('users_permissions')->insert(['app_module_name' => 'HRM', 'permission_name' => 'LeaveManagement']);
            DB::table('users_permissions')->insert(['app_module_name' => 'HRM', 'permission_name' => 'PoliciesManagement']);
            DB::table('users_permissions')->insert(['app_module_name' => 'HRM', 'permission_name' => 'Payroll']);
            DB::table('users_permissions')->insert(['app_module_name' => 'HRM', 'permission_name' => 'Recruitment']);
            DB::table('users_permissions')->insert(['app_module_name' => 'HRM', 'permission_name' => 'Configuration']);
            DB::table('users_permissions')->insert(['app_module_name' => 'HRM', 'permission_name' => 'HRMReports']);

            /* Customers Resource Management Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'CRM', 'permission_name' => 'Contacts']);
            DB::table('users_permissions')->insert(['app_module_name' => 'CRM', 'permission_name' => 'Leads']);
            DB::table('users_permissions')->insert(['app_module_name' => 'CRM', 'permission_name' => 'Opportunities']);
            DB::table('users_permissions')->insert(['app_module_name' => 'CRM', 'permission_name' => 'PhoneCalls']);
            DB::table('users_permissions')->insert(['app_module_name' => 'CRM', 'permission_name' => 'HelpDisk']);

            /* Products Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'Products', 'permission_name' => 'ProductManagement']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Products', 'permission_name' => 'Categories']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Products', 'permission_name' => 'Variations']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Products', 'permission_name' => 'Units']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Products', 'permission_name' => 'Brands']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Products', 'permission_name' => 'Warrenties']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Products', 'permission_name' => 'ProductsReports']);

            /* Purchase Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'Suppliers']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'PurchaseQuotations']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'PurchaseOrders']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'PurchaseInvocies']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'PurchaseDelivery Notes']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'PurchaseForecast']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'PurchaseAnalytics']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'PurchaseReturns']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Purchase', 'permission_name' => 'PurchaseReports']);

            /* Inventory Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'InventoryLevels']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'Precautions']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'ManageBonuses']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'StockRequest Notes']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'TransferNotes']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'StockReceipts Notes']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'ManageRequests']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'ManageReturns']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'ManageAassets']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'ManageDamage Stock']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'StockConsumption']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'InventorySummaryReports']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Inventory', 'permission_name' => 'InventoryReports']);

            /* Sales Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'Customers']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'Quotations']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'SalesOrders']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'SalesInvocies']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'DeliveryNotes']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'SalesForecast']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'SalesAnalytics']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'SalesReturns']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Sales', 'permission_name' => 'SalesReports']);

            /* Accounts & Finances Menu */
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'FiscalPeriod']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'GLNotes']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'GLCostCenters']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'ControlCodes']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'Currency']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'Family']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'ChartOfAccounts']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'MainAccounts']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'DetailAccounts']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'GeneralLedger']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'JournalEntryVouchers']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'AccountPayable']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'SuppliersDetails']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'CashPaidVouchers']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'BankPaymentVouchers']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'AccountReceivable']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'CustomerDetails']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'CashReceiptVouchers']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'BankReceiptVoucher']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'Authorization']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'AuditVouchers']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'PostVouchers']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'AccountStatement']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'TrailBalance']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'BalanceSheet']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'ControlCodes']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'CostCenters']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'CashFlowStatement']);
            DB::table('users_permissions')->insert(['app_module_name' => 'Accounts', 'permission_name' => 'JournalEnteries']);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_permissions');
    }
}
