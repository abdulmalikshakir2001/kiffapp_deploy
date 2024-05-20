<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\account\AccTransaction;
use Illuminate\Http\Request;
use App\Models\account\AccAccount;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;


class AccTrialBalanceController extends Controller
{
    public function index()
    {
        //
        $data['title'] = 'Account Trial Balance';
        $data['navbar_headings'] = 'Account Trial Balance ';
        return view('account/acc_trial_balance_view', $data);
    }
    public function getData(Request $request)
    {
        // start 
        

        // end
        $accTransactionTable = AccTransaction::with('journalEntries')->whereBetween('created_at', [$request->from_date, $request->to_date])->get();
        

        
        $transformed =     $accTransactionTable->pluck('journalEntries')->flatten(1)->groupBy('account_id')->map(function($item,$key){
            return [
                'debit'=>$item->pluck('debit'),
                'credit'=>$item->pluck('credit'),

            ];

        });

        $transformedMath=  $transformed->map(function($item,$key){
            return [
                'debit' =>collect( $item['debit']->sum())[0],
                'credit' =>collect( $item['credit']->sum())[0],

            ];

        }) ;
        // trial balance 
        $transformedTrialBalance=  $transformedMath->map(function($item,$key){
            $debitValue = $item['debit'];
            $creditValue = $item['credit'];

            if($debitValue > $creditValue){
                return [
                    'debit'=>$debitValue -$creditValue,
                    'credit'=>null,
                ];

            }else{
                return [
                    'debit'=>null,
                    'credit'=> $creditValue - $debitValue,
                ];

            }
            

        }) ;
        // return response()->json($transformedTrialBalance);
        // now fetching account naem start  
        $accountIds =  $transformedTrialBalance->keys()->all();
        // return response()->json($accountIds);

        // $accounts = AccAccount::whereIn('acc_account_id', $accountIds)->get();
        $accounts = AccAccount::whereIn('acc_account_id', $accountIds)->get();
$accounts = $accounts->sortBy(function ($account, $key) use ($accountIds) {
    return array_search($account->acc_account_id, $accountIds);
});
        $accounts =  $accounts->values();
        $result = $transformedTrialBalance->map(function ($item, $key) use ($accounts) {
            $accountName = $accounts->firstWhere('acc_account_id', $key)->name;
            $accountCode = $accounts->firstWhere('acc_account_id', $key)->code;
            return [
                
                'account_name' => $accountName,
                'account_code' => $accountCode,
                'debit' => $item['debit'],
                'credit' => $item['credit']
            ];
        })->values();
         $totalDebitTrialBalance =  collect($result)->pluck('debit')->sum();
         $totalCreditTrialBalance =  collect($result)->pluck('credit')->sum();
         



        
        
        $allData = DataTables::of(collect($result))
            ->addIndexColumn()
            
            ->with(
                [
                    'totalDebit'=>$totalDebitTrialBalance,
                    'totalCredit'=>$totalCreditTrialBalance
                    ]
                )
      
            ->toJson();
      
        return $allData;
    }

    
    
}
