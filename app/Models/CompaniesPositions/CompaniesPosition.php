<?php

namespace App\Models\CompaniesPositions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompaniesPosition extends Model
{
    use HasFactory;
    // insert companies positions
    public function insertCompaniesPositions($companies_positions_data){
        $companies_positions_inserted= DB::insert('insert into companies_positions (position_name,company_id) values(?,?)',[$companies_positions_data['position_name'],$companies_positions_data['company_id']]);
        if($companies_positions_inserted){
            return true;
        }
        else{
            return false;
        }
    }
    // delete companies positions
    public function deleteCompaniesPositions($companies_positions_data){
        $companies_positions_deleted= DB::table('companies_positions')->where('position_id',$companies_positions_data['delete_com_pos_id'])->delete();
        if($companies_positions_deleted){
            return true;

        }
        else{
            return false;

        }
    }
       // insert companies positions
       public function updateCompaniesPositions($companies_positions_data){
        $companies_positions_updated= DB::update('update  companies_positions set position_name=?,company_id=? where position_id=?',[$companies_positions_data['position_name'],$companies_positions_data['company_id'],$companies_positions_data['position_id']]);
        if($companies_positions_updated){
            return true;
        }
        else{
            return false;
        }
    }
    
}
