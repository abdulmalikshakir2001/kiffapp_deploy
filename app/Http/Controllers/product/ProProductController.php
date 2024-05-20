<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\product\ProProduct;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS1D;

class ProProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Product';
        $data['navbar_headings'] = 'All Product';
        return view('product/proProductView', $data);
    }
    public function getData(Request $request)

    {
        $proProduct = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        // $proProduct =  DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($proProduct)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  proProductDeleteBtn bg-white "  style="border:none;" data-pro_product_id="' . $row->product_id . '"data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary proProductEditBtn bg-white"  style="border: none;" data-pro_product_id="' . $row->product_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 proProductDetailsButton"  style="border: none;" data-pro_product_id="' . $row->product_id . '" >
                        <a href="' . route('proProductDetails', $row->product_id) . '" class="text-white"> <i class="fas fa-eye ">
                        </i>
                        View
                        </a>
                    </button>
                
                ';
                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true);
        return $allData;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Product';
        $data['navbar_headings'] = 'Create  Product';
        $data['categories'] = DB::table('pro_categories')->where('company_id', session()->get('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['units'] = DB::table('pro_units')->where('company_id', session()->get('company_id'))->get();
        $data['attributes'] = DB::table('pro_attributes as p_a')->select('p_a.attribute_id', 'p_a.name', DB::raw('GROUP_CONCAT(p_a_v.name)as value'))->leftJoin('pro_attribute_values as p_a_v', 'p_a.attribute_id', '=', 'p_a_v.attribute_id')
            ->groupBy('p_a.attribute_id', 'p_a.name')
            ->where('p_a.company_id', session()->get('company_id'))->get();
        $data['parentProduct'] = DB::table('pro_products')->where('parent_product_id', '0')->where('company_id', session()->get('company_id'))->get();
        return view('product/proProductCreate', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'product_sku' => 'required',
            'product_sale_price' => 'required',
            'product_purchase_price' => 'required',
            'product_unit' => 'required',
            'type' => 'required',
            'product_barcode_type' => 'required',
        ]);
        // product image start 



        // product image end 


        $request['company_id'] = session()->get('company_id');
        $proAttributes = []; // insert
        $attributes = explode(',', $request->attribute_input);
        $i = 0;
        foreach ($attributes as $attribute) {
            $proAttributes[$attribute] = $request->$attribute;
            unset($request[$attribute]);
        }
        unset($request['attribute_input']);
        $request['attributes'] = json_encode($proAttributes);
        $request['sell_online'] = $request->sell_online == "on" ? '1' : '0';
        $request['is_varient'] = $request->is_varient == "on" ? '1' : '0';


        // $request['product_barcode']=rand(134568934,109835402);

        if ($request->product_barcode_type == "EAN8" || $request->product_barcode_type == "EAN13") {
            $randNumber = rand(2923, 8934);
            if($request->product_code==null){
                $request['product_code'] = $randNumber;

            }
            else{
                $request['product_code'] = $request->product_code;

            }
            
            $request['product_barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, $request->product_barcode_type));
        } else {
            $randNumber = rand(1345689359, 1098354890);
            if($request->product_code==null){
                $request['product_code'] = $randNumber;

            }
            else{
                $request['product_code'] = $request->product_code;

            }
            
            $request['product_barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, $request->product_barcode_type));
        }
        if ($request->parent_product_id == null) {
            $request['parent_product_id'] = 0;
        }
        if ($request->product_taxes != null) {

            $request['product_taxes'] = implode(",", $request->product_taxes);
        } else {
            $request['product_taxes'] = null;
        }
        if ($request->product_categories != null) {
            $request['product_categories'] = implode(",", $request->product_categories);
        } else {
            $request['product_categories'] = NULL;
        }



        // return response()->json($request->all());

        $req = $request->only([
            'company_id',
            'product_name',
            'product_sku',
            'product_description',
            'product_sale_price',
            'product_purchase_price',
            'product_taxes',
            'product_categories',
            'product_unit',
            'type',
            'product_barcode_type',
            'product_code',
            'product_barcode',
            'sell_online',
            'is_varient',
            'parent_product_id',
            'attributes',

        ]);
        $productId = ProProduct::insertGetId($req);
        if ($productId) {
            if ($request->hasFile('product_image')) {
                $logo = $request->file('product_image');
                $logoName = $logo->getClientOriginalName();
                // $profileLogoName =  $logo->getClientOriginalExtension();
                if(!file_exists(public_path('app'))){
                    File::makeDirectory(public_path('app'));
                }
                if(!file_exists(public_path('app/public'))){
                    File::makeDirectory(public_path('app/public'));
                }
                
                if (!file_exists(public_path('app/public/' . 'company_id_' . session()->get('company_id') . '_products'))) {
                    File::makeDirectory(public_path('app/public/' . 'company_id_' . session()->get('company_id') . '_products'));
                }
                $request->product_image->move(public_path('app/public/' . 'company_id_' . session()->get('company_id') . '_products'), $logoName);
                // User::where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
                DB::table('pro_products')->where('product_id', $productId)->update(['product_image' => $logoName]);
            }
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function delete(Request $request)
    {
        $proProductId = $request->proProductId;

        $proProductDeleted = ProProduct::where('product_id', $proProductId)->delete();
        if ($proProductDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['product'] = ProProduct::where('product_id', $request->proProductId)->get()->first();
        $data['title'] = 'Update Product';
        $data['navbar_headings'] = 'Update  Product';
        $data['categories'] = DB::table('pro_categories')->where('company_id', session()->get('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['units'] = DB::table('pro_units')->where('company_id', session()->get('company_id'))->get();
        $data['attributes'] = DB::table('pro_attributes as p_a')->select('p_a.attribute_id', 'p_a.name', DB::raw('GROUP_CONCAT(p_a_v.name)as value'))->leftJoin('pro_attribute_values as p_a_v', 'p_a.attribute_id', '=', 'p_a_v.attribute_id')
            ->groupBy('p_a.attribute_id', 'p_a.name')
            ->where('p_a.company_id', session()->get('company_id'))->get();
        $data['parentProduct'] = DB::table('pro_products')->where('parent_product_id', '0')->where('company_id', session()->get('company_id'))->get();
        return view('product/proProductUpdate', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'product_sku' => 'required',
            'product_sale_price' => 'required',
            'product_purchase_price' => 'required',
            'product_unit' => 'required',
            'type' => 'required',
            'product_barcode_type' => 'required',
        ]);
        // product image start 
        if ($request->hasFile('product_image')) {
            $logo = $request->file('product_image');
            $logoName = $logo->getClientOriginalName();
            // $profileLogoName =  $logo->getClientOriginalExtension();
            if(!file_exists(public_path('app'))){
                File::makeDirectory(public_path('app'));
            }
            if(!file_exists(public_path('app/public'))){
                File::makeDirectory(public_path('app/public'));
            }
            if (!file_exists(public_path('app/public/' . 'company_id_' . session()->get('company_id') . '_products'))) {
                File::makeDirectory(public_path('app/public/' . 'company_id_' . session()->get('company_id') . '_products'));
            }
            $request->product_image->move(public_path('app/public/' . 'company_id_' . session()->get('company_id') . '_products'), $logoName);
            // User::where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
            DB::table('pro_products')->where('product_id', $request->product_id)->update(['product_image' => $logoName]);
        }



        // product image end 


        $request['company_id'] = session()->get('company_id');
        $proAttributes = []; // insert
        $attributes = explode(',', $request->attribute_input);
        $i = 0;
        foreach ($attributes as $attribute) {
            $proAttributes[$attribute] = $request->$attribute;
            unset($request[$attribute]);
        }
        unset($request['attribute_input']);
        // unset($request['is_varient']);
        $request['attributes'] = json_encode($proAttributes);
        $request['sell_online'] = $request->sell_online == "on" ? '1' : '0';
        $request['is_varient'] = $request->is_varient == "on" ? '1' : '0';


        // $request['product_barcode']=rand(134568934,109835402);

        if ($request->product_barcode_type == "EAN8" || $request->product_barcode_type == "EAN13") {
            $randNumber = rand(2923, 8934);
            if($request->product_code==null){
                $request['product_code'] = $randNumber;

            }
            else{
                $request['product_code'] = $request->product_code;

            }
            $request['product_barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, $request->product_barcode_type));
        } else {
            $randNumber = rand(1345689359, 1098354890);
            if($request->product_code==null){
                $request['product_code'] = $randNumber;
            }
            else{
                $request['product_code'] = $request->product_code;

            }
            $request['product_barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, $request->product_barcode_type));
        }
        if ($request->parent_product_id == null) {
            $request['parent_product_id'] = 0;
        }
        if ($request->product_taxes != null) {

            $request['product_taxes'] = implode(",", $request->product_taxes);
        } else {
            $request['product_taxes'] = NULL;
        }
        if ($request->product_categories != null) {
            $request['product_categories'] = implode(",", $request->product_categories);
        } else {
            $request['product_categories'] = NULL;
        }



        // return response()->json($request->all());

        $req = $request->only([
            'company_id',
            'product_name',
            'product_sku',
            'product_description',
            'product_sale_price',
            'product_purchase_price',
            'product_taxes',
            'product_categories',
            'product_unit',
            'type',
            'product_barcode_type',
            'product_code',
            'product_barcode',
            'sell_online',
            'is_varient',
            'parent_product_id',
            'attributes',

        ]);
        $productId = ProProduct::where('product_id',$request->product_id)->update($req);
        if ($productId) {
            
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function Details(Request $request)
    {
        $data['product'] = ProProduct::where('product_id', $request->proProductId)->get()->first();
        $data['title'] = ' Product Details';
        $data['navbar_headings'] = 'Product Details';
        $data['categories'] = DB::table('pro_categories')->where('company_id', session()->get('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['units'] = DB::table('pro_units')->where('company_id', session()->get('company_id'))->get();
        $data['attributes'] = DB::table('pro_attributes as p_a')->select('p_a.attribute_id', 'p_a.name', DB::raw('GROUP_CONCAT(p_a_v.name)as value'))->leftJoin('pro_attribute_values as p_a_v', 'p_a.attribute_id', '=', 'p_a_v.attribute_id')
            ->groupBy('p_a.attribute_id', 'p_a.name')
            ->where('p_a.company_id', session()->get('company_id'))->get();
        $data['parentProduct'] = DB::table('pro_products')->where('parent_product_id', '0')->where('company_id', session()->get('company_id'))->get();

        return view('product/proProductDetails', $data);
    }




    public function proProductUrl(Request $request)
    {
        $url = url('proProductDetailsPrint' . '/' . $request->proProductId);
        return response()->json($url);
    }


    public function proProductDetailsPrint(Request $request)

    {
        $data['product'] = ProProduct::where('product_id', $request->proProductId)->get()->first();
        $data['title'] = ' Product Details';
        $data['navbar_headings'] = 'Product Details';
        $data['categories'] = DB::table('pro_categories')->where('company_id', session()->get('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['units'] = DB::table('pro_units')->where('company_id', session()->get('company_id'))->get();
        $data['attributes'] = DB::table('pro_attributes as p_a')->select('p_a.attribute_id', 'p_a.name', DB::raw('GROUP_CONCAT(p_a_v.name)as value'))->leftJoin('pro_attribute_values as p_a_v', 'p_a.attribute_id', '=', 'p_a_v.attribute_id')
            ->groupBy('p_a.attribute_id', 'p_a.name')
            ->where('p_a.company_id', session()->get('company_id'))->get();
        $data['parentProduct'] = DB::table('pro_products')->where('parent_product_id', '0')->where('company_id', session()->get('company_id'))->get();
        // for hrm view payroll start
        $pdf = Pdf::loadView('product/proProductDetailsPrint', $data);
        return $pdf->stream();

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }


    public function isExistProductSku(Request $request){
        $existProductSku=  ProProduct::where('product_sku',$request->product_sku)->first();
    //  echo json_encode($exist_user);
     if($existProductSku){
        echo 'false';
     }
     else{
        echo 'true';
     }
    }



    public function isExistProductSkuForUpdate(Request $request){
        $exist_user=  ProProduct::where('product_id','!=',$request->product_id)->where('product_sku',$request->product_sku)->get()->count();
          //  echo json_encode($exist_user);
           if($exist_user >=1){
              echo 'false';
           }
           else{
              echo 'true';
           }
          }
}
