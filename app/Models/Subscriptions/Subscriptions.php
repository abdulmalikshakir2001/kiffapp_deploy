<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subscriptions extends Model
{
    use HasFactory;
    // insert companies positions
    public function insertSubscriptions($subscriptions_data){
        $subscriptions_inserted= DB::insert('insert into subscriptions (company_id,package_id,start_date,end_date,trial_ends_date,price,status,is_paid_offline,is_active) values(?,?,?,?,?,?,?,?,?)',[
            $subscriptions_data['company_id'],$subscriptions_data['package_id'],
            $subscriptions_data['start_date'],$subscriptions_data['end_date'],
            $subscriptions_data['trial_ends_date'],$subscriptions_data['price'],
            $subscriptions_data['status'],$subscriptions_data['is_paid_offline'],
            $subscriptions_data['is_active'],
        ]
    );
        if($subscriptions_inserted){
            return true;
        }
        else{
            return false;
        }
    }
    // delete companies positions
    public function deleteSubscriptions($subscriptions_data){
        $subscriptions_deleted= DB::table('subscriptions')->where('subscription_id',$subscriptions_data['delete_subscriptions_id'])->delete();
        if($subscriptions_deleted){
            return true;
        }
        else{
            return false;
        }
    }
       // insert companies positions
       public function updateSubscriptions($subscriptions_data){
        $subscriptions_updated= DB::update('update  subscriptions set company_id=?,package_id=?,start_date=?,end_date=?,trial_ends_date=?,price=?,status=?,is_paid_offline=?,is_active=? where subscription_id=?',[$subscriptions_data['company_id'],$subscriptions_data['package_id'],
        $subscriptions_data['start_date'],
        $subscriptions_data['end_date'],
        $subscriptions_data['trial_ends_date'],
        $subscriptions_data['price'],
        $subscriptions_data['status'],
        $subscriptions_data['is_paid_offline'],
        $subscriptions_data['is_active'],
        $subscriptions_data['subscription_id'],
    ]);
        if($subscriptions_updated){
            return true;
        }
        else{
            return false;
        }
    }
    
}
