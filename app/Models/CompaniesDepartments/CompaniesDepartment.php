<?php

namespace App\Models\CompaniesDepartments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompaniesDepartment extends Model
{
    use HasFactory;
    // insert companies positions
    public function insertCompaniesDepartments($companies_departments_data){
        $companies_departments_inserted= DB::insert('insert into companies_departments (department_name,company_id) values(?,?)',[$companies_departments_data['department_name'],session()->get('company_id')]);
        if($companies_departments_inserted){
            return true;
        }
        else{
            return false;
        }
    }
    // delete companies positions
    public function deleteCompaniesDepartments($companies_departments_data){
        $companies_departments_deleted= DB::table('companies_departments')->where('department_id',$companies_departments_data['delete_com_dep_id'])->delete();
        if($companies_departments_deleted){
            return true;
        }
        else{
            return false;
        }
    }
       // insert companies positions
       public function updateCompaniesDepartments($companies_departments_data){
        $companies_departments_updated= DB::update('update  companies_departments set department_name=? where department_id=?',[$companies_departments_data['department_name'],$companies_departments_data['department_id']]);
        if($companies_departments_updated){
            return true;
        }
        else{
            return false;
        }
    }
    
}
