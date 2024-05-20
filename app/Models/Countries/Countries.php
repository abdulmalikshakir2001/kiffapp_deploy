<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Countries extends Model
{
    use HasFactory;
    // insert companies positions

    public function insertCountries($countries_data){
        $countries_inserted= DB::insert('insert into countries (country,currency,currency_code,currency_symbol,thousand_separator,decimal_separator) values(?,?,?,?,?,?)',
        [
            $countries_data['country'],
            $countries_data['currency'],
            $countries_data['currency_code'],
            $countries_data['currency_symbol'],
            $countries_data['thousand_separator'],
            $countries_data['decimal_separator']
        ]
    );
        if($countries_inserted){
            return true;
        }
        else{
            return false;
        }
    }
    // delete companies positions
    public function deleteCountries($countries_data){
        $countries_deleted= DB::table('countries')->where('country_id',$countries_data['delete_countries_id'])->delete();
        if($countries_deleted){
            return true;
        }
        else{
            return false;
        }
    }
       // insert companies positions
       public function updateCountries($countries_data){
        $countries_updated= DB::update('update  countries set country=?,currency=?,currency_code=?,currency_symbol=?,thousand_separator=?,decimal_separator=?  
        where country_id=?',
        [
            $countries_data['country'],
            $countries_data['currency'],
            $countries_data['currency_code'],
            $countries_data['currency_symbol'],
            $countries_data['thousand_separator'],
            $countries_data['decimal_separator'],
            $countries_data['country_id']
        ]
    );
        if($countries_updated){
            return true;
        }
        else{
            return false;
        }
    }
    
}
