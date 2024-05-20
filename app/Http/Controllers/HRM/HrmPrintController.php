<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\HRM\HrmPayroll;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class HrmPrintController extends Controller
{
    //
    public function viewPayroll(int $id)
    {
        # code...
        // print_r( $request->payroll_id);
        $data['payroll'] =  HrmPayroll::with('users')->where('payroll_id', $id)->get()->first();
        $data['company_info'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        return view('hrm/hrm_print_payroll', $data);
    }
    public function viewPayrollByEmployee(Request $request)
    {
        # code...
        // print_r( $request->payroll_id);
        $data['payroll'] =  HrmPayroll::with('users')->where('payroll_id', base64_decode($request->payroll_id))->get()->first();
        return view('hrm/hrm_print_payroll', $data);
    }

    public function print_payroll_url(Request $request){
        $url= url('printPayroll'.'/'.$request->payroll_id);
        return response()->json($url);
    }
    public function printPayroll(Request $request)
    {
        $data['payroll'] = HrmPayroll::with('users')->where('payroll_id', $request->payroll_id)->get()->first();
        $data['company_info'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        // Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        $pdf = Pdf::loadView('hrm/hrm_download_print_payroll', $data);
        return $pdf->stream();
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);

        // $pdf->setPaper('a4');
        // $pdf_file_name = "payroll.pdf";


        // if (!file_exists(storage_path('app/public/hrm_prints'))) {
        //     File::makeDirectory(storage_path('app/public/hrm_prints'));
        // }
        // if (file_exists(storage_path('app/public/hrm_prints' . "/" . $pdf_file_name))) {

        //     File::delete(storage_path('app/public/hrm_prints' . "/" . $pdf_file_name));
        // }

        // $file_moved = $pdf->save(storage_path('app/public/hrm_prints' . '/' . $pdf_file_name));
        // if ($file_moved) {
        //     return response()->json('true');
        // }
    }

    // download payroll

    // public function downloadPayroll(int $id){
    //     $data['payroll']= HrmPayroll::with('users')->where('payroll_id',$id)->get()->first();
    //     $pdf = Pdf::loadView('hrm/hrm_download_print_payroll', $data);
    //     return $pdf->download('payroll.pdf');

    // }
    public function downloadPayroll(int $id)
    {
        $data['payroll'] = HrmPayroll::with('users')->where('payroll_id', $id)->get()->first();
        $data['company_info'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $pdf = Pdf::loadView('hrm/hrm_download_print_payroll', $data);
        // return $pdf->inline();
        return $pdf->download('payroll.pdf');
    }
    public function payrollPage(Request $request)
    {
        // for hrm view payroll start
        $data['payroll'] =  HrmPayroll::with('users')->where('payroll_id', $request->payroll_id)->get()->first();
        $data['company_info'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $pdf = Pdf::loadView('hrm/hrm_print_payroll', $data);
        $payroll_url = url('return_pdf' . '/' . $request->payroll_id);
         return  response()->json(base64_encode($pdf->output()))->header('Content-Disposition','inline')->header( 'Content-Type' , 'application/pdf');
       
    }
    // public function returnPdf(Request $request)
    // {
    //     // for hrm view payroll start
    //     $data['payroll'] =  HrmPayroll::with('users')->where('payroll_id', $request->payroll_id)->get()->first();
    //     $data['company_info'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
    //     $pdf = PDF::loadView('hrm/hrm_print_payroll', $data);
    //     $payroll_url = url('payroll' . '/' . $request->payroll_id);
    //     //  return  response()->json( ['pdf_output'=> base64_encode($pdf->output()),'url'=>$payroll_url]);
    //     //  return  response()->json(base64_encode($pdf->output()));
    //     return  new Response($pdf->output(), 200, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'inline; filename="file.pdf"',
    //     ]);
    //     // return response()->json('payroll view in binary form ');

    // }





    public function viewPdf()
    {
        return view('hrm/p_p');
    }
}
