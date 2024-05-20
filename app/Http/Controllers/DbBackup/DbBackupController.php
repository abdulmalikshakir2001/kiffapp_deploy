<?php

namespace App\Http\Controllers\DbBackup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DbBackup\DbBackup;
// use DataTables;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DbBackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'All Data base backups';
        $data['navbar_headings'] = 'All Data base backups';
        return view('db_backup/view_db_backup', $data);
    }
    public function getData(Request $request)

    {
        $db_backup =  DB::table('db_backups')->orderBy('db_backup_id', 'DESC')->get();
        $allData = DataTables::of($db_backup)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary db_backup_delete_btn bg-white"  style="border:none;" data-delete_db_backup_id="' . $row->db_backup_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_db_backup" data-db_backup_name="' . $row->db_backup_files . '" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button>
                <a href="' . route('download_backup', $row->db_backup_files) . '" class=""> 
                <button class="btn btn-primary btn-sm db_backup_download_btn mb-0 bg-white"  style="border: none;" data-download_db_backup_id="' . $row->db_backup_id . '" data-download_db_backup_name="' . $row->db_backup_files . '">
                        <span class="material-symbols-outlined text-success">download</span>
                    </button></a>';
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
        //
        $data['title'] = ' Data base Backup';
        $data['navbar_headings'] = 'db_backup';
        return view('db_backup/create_db_backup', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //



    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteDbBackup(Request $request)
    {
        $db_backup_deleted = DbBackup::where('db_backup_id', $request->delete_db_backup_id)->delete();
        $backup_deleted_from_server = storage_path('app/backup/') . $request->db_backup_name;
        File::delete($backup_deleted_from_server);


        // $companies_departments_tbl= new CompaniesDepartment();
        //  $companies_departments_deleted=$companies_departments_tbl->deleteCompaniesDepartments($request->all());
        if ($db_backup_deleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }


    public function getDbBackup()
    {
        Artisan::call('database:backup');
        return redirect()->back()->with('status', 'Db base backup Generated successfully');
    }
    public function downloadBackup(Request $request)
    {
        $db_file_path = storage_path('app/backup/') . $request->backup_file_name;
        return response()->download($db_file_path);
    }
}
