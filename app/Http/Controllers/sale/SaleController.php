<?php

namespace App\Http\Controllers\sale;

use App\Http\Controllers\Controller;
use App\Models\purchase\PurWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use  App\Models\purchase\PurWarehouseStock;
use Illuminate\Support\Facades\DB;
use App\Models\sale\SalOrder;
use  App\Models\Users\User;
use App\Models\sale\SalInvoice;
use  App\Models\sale\SalInvoiceDetail;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\sale\SalCashRegister;
use Exception;
use DNS1D;
use DNS2D;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;


class SaleController extends Controller
{
    //
    public function saleForecast(){
        $data['title']='Sale  Forecast';
            $data['navbar_headings']='Sale  Forecast';
                        // showing top 10 purchase product last 3 month start 
                        $currentDateObj = Carbon::now();
                        $threeMonthsAgo = $currentDateObj->subMonths(3);
                        $ordersLastThreeMonth = SalOrder::with('details')
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
        return view('sale/sal_forecast',$data);
    }
    public function  openCashRegister (){
      $data['title']='Open Cash Register';
      $data['navbar_headings']='Open Cash Register';
      return  view('sale/sal_open_cash_register',$data);
    }
    public function  storeCashRegisterAmountInSession (Request $request){
      $data['title']='Pos';
      $data['navbar_headings']='Pos';
      

      if(session()->missing('posOpenRegisterAmount')){
        $request->validate([
          'open_register_amount'=>'required'
        ],[
          'open_register_amount.required'=>'Amount field is required'
        ]);

      
      session(['posOpenRegisterAmount'=>$request->open_register_amount]);
      session()->save();


      // $cashRegisterId =  DB::table('sal_cash_registers')->insertGetId([
      //   'company_id' =>session()->get('company_id'),
      //   'user_id' =>session()->get('user_id'),
      //   'status' =>'open',
      //   'closing_amount'=>$request->open_register_amount
      // ]);
      $salCashRegisterTable =  new SalCashRegister();
      $cashRegisterId = $salCashRegisterTable->openRegsiter(openRegisterAmount:$request->open_register_amount);
      session(['cashRegisterId'=>$cashRegisterId]);
      session()->save();
    }
      // dd(session()->all());

      // walk in customer name modified to show for user start
      $users = User::where('company_id',session()->get('company_id'))->where('user_type','Customer')->get();
      $data['warehouses'] = PurWarehouse::where('company_id',session()->get('company_id'))->get();
      $data['customers']=  $users->map(function($item){
          if($item->username=="walk in customer ".session()->get('company_id')){
              $item['username'] = 'Walk In Customer';
  
          }
              return $item;
      });
      // walk in customer name modified to show for user end
      return response( view('sale/sal_pos',$data))->cookie('user');
    }
    public function fetchProductForPos(Request $request){
      // return response()->json($request->productNameOrSku);
      $productSearched =  DB::table('pro_products')->where('company_id',session()->get('company_id')) ->where('product_sku','=',$request->productNameOrSku)->orWhere('product_name', 
'=',$request->productNameOrSku)->get();
      if(count($productSearched)>0){
      $product = $productSearched->first();

      // return response()->json($product);

      if($product->product_taxes != null){
      $taxesInfoVar= taxesInfo($product->product_taxes);
      $taxesInfoVar['productInfo'] =$product;
      return response()->json($taxesInfoVar);

      }
      else{
        // if product taxes = null then 
        $taxesInfoVar  = [
          'taxesNames' => ['No taxes'],
          'taxesPercentage'=>[0],
          'taxesPercentageSum' => 0 ,
          'taxesNamesAndPercentage'=>'No taxes',
          'productInfo' =>$product
        ];
        return response()->json($taxesInfoVar);
      }



    }
    
    
    else{
      return response()->json([]);
    }

      
    }


    public function  storePos (Request $request){
      // return response()->json( json_decode($request->warehouse_id));
      $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
      $randNumber = rand(1345689359, 1098354890);
        $qrCodeRandNumber = rand(1345689359, 9999994899);
      $posSaleInserted =  SalInvoice::create([
        "company_id" =>session('company_id'),
        "supplier_id" =>$request->customer_id,
        "sal_order_id" =>0,
        "delivery_date" =>$currentDateTime,
        "ref_num" =>"pos".strval($randNumber),
        "sal_invoice_code" =>$randNumber,
        "barcode" =>json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128')),
        "qr_code" =>$qrCodeRandNumber,
        "qr_code_string" =>json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5)),
        "creation_date" => Carbon::now()->format('Y-m-d'),
        "creation_time" => Carbon::now()->format('H:i:s'),
        "taxes" =>null,
        "total_price" => $request->total_amount ,
        "invoice_status" =>"approved"

      ]);
      // return response()->json($posSaleInserted->sal_invoice_id);
      if($posSaleInserted->sal_invoice_id){
        $subTotalArray = explode(',', $request->sub_total_array);
            $productDiscountArray = explode(',', $request->product_discount_array);
            $productQuantityArray = explode(',', $request->qty_array);
            $productUnitPriceArray = explode(',', $request->unit_price_array);
            $productIdsArray = json_decode( $request->product_ids_array);
             $productTaxesNamesArray =  collect( json_decode( $request->product_taxes_names_array));
             $productTaxesNamesArrayDb =  $productTaxesNamesArray->values()->all() ;
             foreach($productIdsArray as $index=> $productId){
              // DB::table('sal_invoice_details')

              SalInvoiceDetail::create([
                'sal_invoice_id'=>$posSaleInserted->sal_invoice_id,
                'pro_taxes' =>$productTaxesNamesArrayDb[$index],
                'product_id' =>$productId,
                'unit_price' =>$productUnitPriceArray[$index],
                'quantity' =>$productQuantityArray[$index],
                'discount' =>$productDiscountArray[$index],
                'sub_total' =>$subTotalArray[$index],

              ]);
              

    updateStockByWarehouse(warehouseId: $request->warehouse_id,productId:$productId,qty:$productQuantityArray[$index]);
            // updating stock qty for ware house end 
             }
            //  update counter amount in session  start 
            session()->increment('posOpenRegisterAmount', $incrementBy = $request->total_amount);
            session()->save();
            //  update counter amount in session  end 
            session()->push('invoice.invoiceInfo', [$posSaleInserted->sal_invoice_id,$request->total_amount]);

            DB::table('sal_cash_register_transactions')->insert([
              'cash_register_id' => session('cashRegisterId'),
              'amount' => $request->total_amount,
              'type' =>'debit',
              'transaction_type'=>'sell',
              'transaction_id'=>$posSaleInserted->sal_invoice_id,
              'created_at'=> Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at'=> Carbon::now()->format('Y-m-d H:i:s'),

            ]);

            DB::table('sal_cash_registers')->where('company_id',session('company_id'))->where('id',session('cashRegisterId'))->update([
              'closing_amount'=>session('posOpenRegisterAmount'),
              // current
              'updated_at'=> Carbon::now()->format('Y-m-d H:i:s')

            ]);





            // return url for generate print start 
            $url = url('sal_invoice_detail_print' . '/' . $posSaleInserted->sal_invoice_id);
            // current
            return response()->json(['url'=>$url,'currentRegisterAmount'=>session('posOpenRegisterAmount')]);
            // return url for generate print end 

      }
      

    }

    public function closeRegister(Request $request){
      DB::table('sal_cash_registers')
      ->where("company_id",session('company_id'))
      ->where('id',session('cashRegisterId'))->update([
        'status' =>'close',
        'closed_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'closing_amount' =>session('posOpenRegisterAmount'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
        session()->forget('posOpenRegisterAmount');
        session()->forget('invoice');
        session()->forget('cashRegisterId');
        session()->save();

        return response()->json('true');



    }


    public function salListPos(Request $request){
      $data['title']='List POS';
      $data['navbar_headings']='List POS';
      $date = Carbon::now()->format('Y-m-d');
      $data['todaySalesAmount'] =  SalCashRegister::where('company_id',session('company_id'))->whereDate('created_at','=',$date)->get()->sum('closing_amount');// this query same as for  listing of pos
      return view('sale/sal_list_pos',$data);
    }


    
    public function salListPosGetData (Request $request ){
      if($request->from_date == null){
        $sal_cash_register_table = SalCashRegister::where('company_id',session('company_id'))->whereDate('created_at','=',$request->by_date)->orderBy('id','desc')->get();
        $transactionsAmount = $sal_cash_register_table->sum('closing_amount');
        return Datatables::of($sal_cash_register_table)
               ->addColumn('action', function ($row) {
                    $btn =
                        '
                    <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 sal_cash_register_detail_button"  style="border: none;" data-sal_cash_register_id="' . $row->id . '" >
                            <a href="'.route('pos_detail',$row->id).'" class="text-white"> <i class="fas fa-eye ">
                            </i>
                            View
                            </a>
                        </button>
                    
                    ';
                    return $btn;
                }) 
                ->addColumn('status',function($row){
                          if($row->status == "open"){
                            $btn =  '
                             <input type="checkbox" data-toggle="switchbutton" checked data-onlabel="Open" data-offlabel="Close" data-onstyle="success" data-offstyle="danger" id="open_close_switch" class="open_close_switch"  data-width="100" data-height="25" 
                             data-id='.$row->id.'
                             >
                            ' ;
                            return $btn;
            
                          }
                          else{
                            return '<span class="badge bg-dark">close</span>';
                            
            
                          }
            
                        })->addColumn('user_id' ,function($row){
                          return $row->user->username;
            
                        })
                        ->addColumn('closed_at' ,function($row){
                          if($row->closed_at !=null){
            
                          
                          return '<span class="cash_register_date me-3">'.Carbon::parse($row->closed_at)->format('d F Y ').'</span><span class="cash_register_date">'.Carbon::parse($row->closed_at)->format('g:i A ').'</span> ';
                        }
                        else{
                          return ;
                        }
                        })
                        ->editColumn('created_at' ,function($row){
                          if($row->created_at !=null){
            
                          
                          return '<span class="cash_register_date me-3">'.Carbon::parse($row->created_at)->format('d F Y ').'</span><span class="cash_register_date">'.Carbon::parse($row->created_at)->format('g:i A ').'</span> ';
                        }
                        else{
                          return ;
                        }
                        })
                ->rawColumns([ 'action','status','user_id','closed_at','created_at'])
                ->with(['amount'=>$transactionsAmount])
      
        ->toJson();
        

      }
      else{
        $from_date = ($request->from_date) ? $request->from_date:null;
        $to_date = ($request->to_date) ? $request->to_date:null;
        $sal_cash_register_table = SalCashRegister::where('company_id',session('company_id'))->dataFilter($from_date,$to_date)->orderBy('id','desc')->get();
        $transactionsAmount = $sal_cash_register_table->sum('closing_amount');
        return Datatables::of($sal_cash_register_table)
               ->addColumn('action', function ($row) {
                    $btn =
                        '
                    <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 sal_cash_register_detail_button"  style="border: none;" data-sal_cash_register_id="' . $row->id . '" >
                            <a href="'.route('pos_detail',$row->id).'" class="text-white"> <i class="fas fa-eye ">
                            </i>
                            View
                            </a>
                        </button>
                    
                    ';
                    return $btn;
                }) 
                ->addColumn('status',function($row){
                          if($row->status == "open"){
                            $btn =  '
                             <input type="checkbox" data-toggle="switchbutton" checked data-onlabel="Open" data-offlabel="Close" data-onstyle="success" data-offstyle="danger" id="open_close_switch" class="open_close_switch"  data-width="100" data-height="25" 
                             data-id='.$row->id.'
                             >
                            ' ;
                            return $btn;
            
                          }
                          else{
                            return '<span class="badge bg-dark">close</span>';
                            
            
                          }
            
                        })->addColumn('user_id' ,function($row){
                          return $row->user->username;
            
                        })
                        ->addColumn('closed_at' ,function($row){
                          if($row->closed_at !=null){
            
                          
                          return '<span class="cash_register_date me-3">'.Carbon::parse($row->closed_at)->format('d F Y ').'</span><span class="cash_register_date">'.Carbon::parse($row->closed_at)->format('g:i A ').'</span> ';
                        }
                        else{
                          return ;
                        }
                        })->editColumn('created_at' ,function($row){
                          if($row->created_at !=null){
            
                          
                          return '<span class="cash_register_date me-3">'.Carbon::parse($row->created_at)->format('d F Y ').'</span><span class="cash_register_date">'.Carbon::parse($row->created_at)->format('g:i A ').'</span> ';
                        }
                        else{
                          return ;
                        }
                        })
                ->rawColumns([ 'action','status','user_id','closed_at','created_at'])
                ->with(['amount'=>$transactionsAmount])
      
        ->toJson();

      }
      
      
      





      
      
      
      
    }
    
    

    public function closeRegisterByAdmin(Request $request){
      // return response()->json($request->cashRegisterId);
  $registerClose =  DB::table('sal_cash_registers')->where('company_id',session('company_id'))->where('id',$request->cashRegisterId)->update([
        'status'=>'close',
        // current
        'closed_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' =>Carbon::now()->format('Y-m-d H:i:s')
      ]);

      if($registerClose){

        return response()->json('registerClose');
      }


    }

    public function posDetail(Request $request){
      // return $request->cashRegisterId;

      $data['title']='POS Detail';
      $data['navbar_headings']='POS Detail';
     $data['cashRegister'] = SalCashRegister::where('company_id',session()->get('company_id'))->where('id',$request->cashRegisterId)->get()->first();
      $taxes = collect( []);
      $taxesPercenatageArray = collect([]);
      $subTotalArray = collect( []);
      
      foreach($data['cashRegister']->transactions as $transaction ){
        $productTax = collect( []); // contain value of tax
        $productTaxSum = collect( []);
        $productSubTotal = collect([]);

        foreach( $transaction->invoice->details as $detail){
          $taxNamesArray =  explode(',',$detail->pro_taxes) ;
          $taxesArray =  DB::table('pro_taxes')->where('company_id',session('company_id'))->whereIn('tax_name',$taxNamesArray)->get();
          $productTax->push($taxesArray->pluck('percentage')->all());
          $productTaxSum->push($taxesArray->sum('percentage'));
          $productSubTotal->push($detail->sub_total);
        }
        $taxes->push($productTax->all());
        $taxesPercenatageArray->push($productTaxSum);
        $subTotalArray->push($productSubTotal);
        
      }
      $taxesPerInvoiceCollection =  $taxesPercenatageArray->map(function($arr){
        return $arr->sum();


      });
      $subTotalPerInvoiceCollection =  $subTotalArray->map(function ($arr){
        return $arr->sum();

      });

      
      

      $data['taxesPerInvoiceArray']  =  $taxesPerInvoiceCollection->all();
      $data['subTotalPerInvoiceArray']  =  $subTotalPerInvoiceCollection->all();
      $data['transactionsAmount'] =  $subTotalPerInvoiceCollection->sum();
      $data['taxesAll']= $taxes->all();


      

     return view('sale/pos_detail',$data);
    //  dd($cashRegister);
    // current
    }


    public function cashRegisterUrl(Request $request)
    {
        $url = url('cash_register_detail_print' . '/' . $request->id);
        return response()->json($url);
    }


    public function cashRegisterDetailPrint(Request $request)

    {
      $data['title']='POS Detail';
      $data['navbar_headings']='POS Detail';
     $data['cashRegister'] = SalCashRegister::where('company_id',session()->get('company_id'))->where('id',$request->id)->get()->first();
      $taxes = collect( []);
      $taxesPercenatageArray = collect([]);
      $subTotalArray = collect( []);
      
      foreach($data['cashRegister']->transactions as $transaction ){
        $productTax = collect( []); // contain value of tax
        $productTaxSum = collect( []);
        $productSubTotal = collect([]);

        foreach( $transaction->invoice->details as $detail){
          $taxNamesArray =  explode(',',$detail->pro_taxes) ;
          $taxesArray =  DB::table('pro_taxes')->where('company_id',session('company_id'))->whereIn('tax_name',$taxNamesArray)->get();
          $productTax->push($taxesArray->pluck('percentage')->all());
          $productTaxSum->push($taxesArray->sum('percentage'));
          $productSubTotal->push($detail->sub_total);
        }
        $taxes->push($productTax->all());
        $taxesPercenatageArray->push($productTaxSum);
        $subTotalArray->push($productSubTotal);
        
      }
      $taxesPerInvoiceCollection =  $taxesPercenatageArray->map(function($arr){
        return $arr->sum();


      });
      $subTotalPerInvoiceCollection =  $subTotalArray->map(function ($arr){
        return $arr->sum();

      });

      
      

      $data['taxesPerInvoiceArray']  =  $taxesPerInvoiceCollection->all();
      $data['subTotalPerInvoiceArray']  =  $subTotalPerInvoiceCollection->all();
      $data['transactionsAmount'] =  $subTotalPerInvoiceCollection->sum();
      $data['taxesAll']= $taxes->all();
      $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();

     

        $pdf = Pdf::loadView('sale/sal_cash_register_detail_print', $data);
        return $pdf->stream();




        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
        // end 
    }

    // cashier 
    public function posDetailCashier(Request $request){
      // return $request->cashRegisterId;

      $data['title']='POS Detail';
      $data['navbar_headings']='POS Detail';
     $data['cashRegister'] = SalCashRegister::where('company_id',session()->get('company_id'))->where('id',session('cashRegisterId'))->get()->first();
      $taxes = collect( []);
      $taxesPercenatageArray = collect([]);
      $subTotalArray = collect( []);
      
      foreach($data['cashRegister']->transactions as $transaction ){
        $productTax = collect( []); // contain value of tax
        $productTaxSum = collect( []);
        $productSubTotal = collect([]);

        foreach( $transaction->invoice->details as $detail){
          $taxNamesArray =  explode(',',$detail->pro_taxes) ;
          $taxesArray =  DB::table('pro_taxes')->where('company_id',session('company_id'))->whereIn('tax_name',$taxNamesArray)->get();
          $productTax->push($taxesArray->pluck('percentage')->all());
          $productTaxSum->push($taxesArray->sum('percentage'));
          $productSubTotal->push($detail->sub_total);
        }
        $taxes->push($productTax->all());
        $taxesPercenatageArray->push($productTaxSum);
        $subTotalArray->push($productSubTotal);
        
      }
      $taxesPerInvoiceCollection =  $taxesPercenatageArray->map(function($arr){
        return $arr->sum();


      });
      $subTotalPerInvoiceCollection =  $subTotalArray->map(function ($arr){
        return $arr->sum();

      });

      
      

      $data['taxesPerInvoiceArray']  =  $taxesPerInvoiceCollection->all();
      $data['subTotalPerInvoiceArray']  =  $subTotalPerInvoiceCollection->all();
      $data['transactionsAmount'] =  $subTotalPerInvoiceCollection->sum();
      $data['taxesAll']= $taxes->all();


      

     return view('sale/pos_detail_cashier',$data);
    //  dd($cashRegister);
    // current
    }



    

}
