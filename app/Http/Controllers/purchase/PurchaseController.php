<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\purchase\PurWarehouseStock;
use Illuminate\Support\Facades\DB;
use App\Models\purchase\PurPurchaseOrder;
use Carbon\Carbon;


class PurchaseController extends Controller
{
    //
    public function purchaseForecast(){
        $data['title']='Purchase Forecast';
            $data['navbar_headings']='Purchase Forecast';

            // showing top 10 purchase product last 3 month start 
            $currentDateObj = Carbon::now();
            $threeMonthsAgo = $currentDateObj->subMonths(3);
            $ordersLastThreeMonth = PurPurchaseOrder::with('details')
            ->whereDate('created_at', '>=', $threeMonthsAgo)->where('company_id',session('company_id'))->get();
            $detailsArrayOfObj =  $ordersLastThreeMonth->pluck('details')->flatten();
              $productQty =  $detailsArrayOfObj->groupBy('product_id')->map(function($item){
                return $item->sum('quantity');
              }) ; // this array contain product with qty 

              $data['productQtyFull']  = $productQty->sum();
               $data['last3MonthMostPurchaseProduct']  =  $productQty->sortDesc()->take(10); // last 3 month most purchase product 
                $data['productIdsAsKey']  =  $data['last3MonthMostPurchaseProduct']->keys()->all(); // product ids 

                $data['products'] =DB::table('pro_products')->whereIn('product_id',$data['productIdsAsKey'])->orderByRaw("FIELD(product_id,".implode(',',$data['productIdsAsKey']).")")->get();
                // for charts start 
                $data['productQty']  =  $data['last3MonthMostPurchaseProduct']->values()->all(); // product qty array
                $data['productNames']  =  DB::table('pro_products')->whereIn('product_id',$data['productIdsAsKey'])->orderByRaw("FIELD(product_id,".implode(',',$data['productIdsAsKey']).")")->get()->pluck('product_name')->all();
                // for charts end
            
            
        return view('purchase/purchase_forecast',$data);
    }
}
