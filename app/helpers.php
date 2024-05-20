
<?php

    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
     use App\Models\account\AccAccountBalance;


    

    function updateAccountBalance($accountId,$operator1,$debitArrayInc,$operator2,$creditArrayInc){

        AccAccountBalance::where('account_id', '=', $accountId)
        ->update([
            'balance' => DB::raw("balance $operator1 $debitArrayInc"),

        ]);
    AccAccountBalance::where('account_id', '=', $accountId)
        ->update([
            'balance' => DB::raw("balance $operator2 $creditArrayInc"),

        ]);

    }


    function formatArray($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
    function show_app_logo()
    {
        $app_logo = DB::table('app_settings')->select('app_logo')->get()->first();
        return $app_logo->app_logo;
    }
    function show_app_name()
    {
        $app_name = DB::table('app_settings')->select('app_name')->get()->first();
        return $app_name->app_name;
    }
    // stockQtyIncrement will update the quanty in main ware house ,here warehouse id of any company access by session() ->get('company_id) 
    function stockQtyIncrementOfMainWarehouse($productId, $qty): void
    {


        $mainWarehouse =  DB::table('pur_warehouses')->where('company_id', session()->get('company_id'))->where('warehouse_name', 'main warehouse')->get()->first();

        $productCount =  DB::table('pur_warehouse_stocks')->where('company_id', session()->get('company_id'))->where('warehouse_id', $mainWarehouse->warehouse_id)->where('product_id', $productId)->get()->count();
        if ($productCount == 0) {
            // echo 'product not exist in ';
            DB::table('pur_warehouse_stocks')->insert([
                'company_id' => session()->get('company_id'),
                'warehouse_id' => $mainWarehouse->warehouse_id,
                'product_id' => $productId,
                'stock_qty' => $qty,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } else {
            $stock =  DB::table('pur_warehouse_stocks')->where('company_id', session()->get('company_id'))->where('warehouse_id', $mainWarehouse->warehouse_id)->where('product_id', $productId)->get()->first();
            // echo  ' product 35 stock qty is : '. $stock->stock_qty ;
            DB::table('pur_warehouse_stocks')->where('product_id', $productId)->where('warehouse_id', $mainWarehouse->warehouse_id)->where('company_id', session()->get('company_id'))->update([
                'stock_qty' => intval($qty) + intval($stock->stock_qty),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ]);
        }
    }


    function stockQtyDecrementOfMainWarehouse($productId, $qty)
    {
        $mainWarehouse =  DB::table('pur_warehouses')->where('company_id', session()->get('company_id'))->where('warehouse_name', 'main warehouse')->get()->first();


        $stock =  DB::table('pur_warehouse_stocks')->where('company_id', session()->get('company_id'))->where('warehouse_id', $mainWarehouse->warehouse_id)->where('product_id', $productId)->get()->first();
        // echo  ' product 35 stock qty is : '. $stock->stock_qty ;
        DB::table('pur_warehouse_stocks')->where('product_id', $productId)->where('warehouse_id', $mainWarehouse->warehouse_id)->where('company_id', session()->get('company_id'))->update([
            'stock_qty' => intval($stock->stock_qty) - intval($qty),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

        ]);
    }
    function taxesInfo(string $taxesNames): array
    { // pass taxes as string separated by comma  e.g taxesInfo("first, second tax")
        $taxesInfoArray = []; // this array contain taxesNames,taxesPercentage,taxesNames=taxesPercentage,taxesPercentageSum
        if ($taxesNames != 'NULL') {
            $taxesPercentageArray = []; // this array contain percentages
            $taxesNamesAndPercentage = [];
            $taxesNamesArray = explode(',', $taxesNames); //this  array contain taxes names
            foreach ($taxesNamesArray as $taxName) {
                $taxRow =  DB::table('pro_taxes')->where('tax_name', $taxName)->get()->first();
                array_push($taxesPercentageArray, $taxRow->percentage);
                array_push($taxesNamesAndPercentage, $taxName . '=' . $taxRow->percentage . '%');
            }
            $taxesPercentageSum = collect($taxesPercentageArray)->sum(); // this property contain percentage sum
            $taxesInfoArray['taxesNames'] = $taxesNamesArray;
            $taxesInfoArray['taxesPercentage'] = $taxesPercentageArray;
            $taxesInfoArray['taxesPercentageSum'] = $taxesPercentageSum;
            $taxesInfoArray['taxesNamesAndPercentage'] = implode(',', $taxesNamesAndPercentage);
        }

        
        // print_r($taxesInfoArray);
        return $taxesInfoArray;
    }
    function updateStockByWarehouse($warehouseId,$productId,$qty){  //updateStockByWarehouse(warehouseId:'6',productId:"51",qty:"5")
        $productStock =  DB::table('pur_warehouse_stocks')->where('company_id',session()->get('company_id'))->where('warehouse_id',$warehouseId)->where('product_id',$productId)->get()->first();
    $newStockVal=  intval( $productStock->stock_qty) - intval($qty);

    DB::table('pur_warehouse_stocks')->where('company_id',session()->get('company_id'))->where('warehouse_id',$warehouseId)->where('product_id',$productId)->update([
      'stock_qty' =>$newStockVal
    ]);


    }
    function updateStockByWarehouseInc($warehouseId,$productId,$qty){  //updateStockByWarehouse(warehouseId:'6',productId:"51",qty:"5")
        $productStock =  DB::table('pur_warehouse_stocks')->where('company_id',session()->get('company_id'))->where('warehouse_id',$warehouseId)->where('product_id',$productId)->get()->first();
    $newStockVal=  intval( $productStock->stock_qty) + intval($qty);

    DB::table('pur_warehouse_stocks')->where('company_id',session()->get('company_id'))->where('warehouse_id',$warehouseId)->where('product_id',$productId)->update([
      'stock_qty' =>$newStockVal
    ]);


    }


    ?>