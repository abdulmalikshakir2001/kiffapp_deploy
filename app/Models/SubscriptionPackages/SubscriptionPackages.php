<?php

namespace App\Models\SubscriptionPackages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubscriptionPackages extends Model
{
    use HasFactory;
    // insert companies positions
    public function insertSubscriptionPackages($subscription_packages_data){
        $subscription_packages_inserted= DB::insert('insert into subscription_packages(
        package_name,
        package_description,
        price,
        duration,
        duration_type,
        trail_period_in_days,
        sort_order,
        allowed_users,
        allowed_products,
        allowed_customers,
        allowed_suppliers,
        allowed_purchaseorders,
        allowed_salesinvoices,
        allowed_accounts,
        module_hrm,
        module_crm,
        module_products,
        module_purchase,
        module_inventroy,
        module_sales,
        module_accounts,
        is_active
        ) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$subscription_packages_data['package_name'],$subscription_packages_data['package_description'],$subscription_packages_data['price'],$subscription_packages_data['duration'],$subscription_packages_data['duration_type'],$subscription_packages_data['trail_period_in_days'],$subscription_packages_data['sort_order'],$subscription_packages_data['allowed_users'],$subscription_packages_data['allowed_products'],$subscription_packages_data['allowed_customers'],$subscription_packages_data['allowed_suppliers'],$subscription_packages_data['allowed_purchaseorders'],$subscription_packages_data['allowed_salesinvoices'],$subscription_packages_data['allowed_accounts'],$subscription_packages_data['module_hrm'],$subscription_packages_data['module_crm'],$subscription_packages_data['module_products'],$subscription_packages_data['module_purchase'],$subscription_packages_data['module_inventroy'],$subscription_packages_data['module_sales'],$subscription_packages_data['module_accounts'],$subscription_packages_data['is_active']]
    );
        if($subscription_packages_inserted){
            return true;
        }
        else{
            return false;
        }
    }
    // delete companies positions
    public function deleteSubscriptionPackages($subscription_packages_data){
        $subscription_packages_deleted= DB::table('subscription_packages')->where('package_id',$subscription_packages_data['delete_subscription_packages_id'])->delete();
        if($subscription_packages_deleted){
            return true;
        }
        else{
            return false;
        }
    }
       // insert companies positions
       public function updateSubscriptionPackages($subscription_packages_data){
        $subscription_packages_updated= DB::update('update  subscription_packages set 
        package_name=?,
        package_description=?,
    price=?,
    duration=?,
    duration_type=?,
    trail_period_in_days=?,
    sort_order=?,
    allowed_users=?,
    allowed_products=?,
    allowed_customers=?,
    allowed_suppliers=?,
    allowed_purchaseorders=?,
    allowed_salesinvoices=?,
    allowed_accounts=?,
    module_hrm=?,
    module_crm=?,
    module_products=?,
    module_purchase=?,
    module_inventroy=?,
    module_sales=?,
    module_accounts=?,
    is_active=? 
        where package_id=?',
        [
            $subscription_packages_data['package_name'],
            $subscription_packages_data['package_description'],
            $subscription_packages_data['price'],
            $subscription_packages_data['duration'],
            $subscription_packages_data['duration_type'],
            $subscription_packages_data['trail_period_in_days'],
            $subscription_packages_data['sort_order'],
            $subscription_packages_data['allowed_users'],
            $subscription_packages_data['allowed_products'],
            $subscription_packages_data['allowed_customers'],
            $subscription_packages_data['allowed_suppliers'],
            $subscription_packages_data['allowed_purchaseorders'],
            $subscription_packages_data['allowed_salesinvoices'],
            $subscription_packages_data['allowed_accounts'],
            $subscription_packages_data['module_hrm'],
            $subscription_packages_data['module_crm'],
            $subscription_packages_data['module_products'],
            $subscription_packages_data['module_purchase'],
            $subscription_packages_data['module_inventroy'],
            $subscription_packages_data['module_sales'],
            $subscription_packages_data['module_accounts'],
            $subscription_packages_data['is_active'],
            $subscription_packages_data['package_id']
            ]
);
        if($subscription_packages_updated){
            return true;
        }
        else{
            return false;
        }
    }
    
}
