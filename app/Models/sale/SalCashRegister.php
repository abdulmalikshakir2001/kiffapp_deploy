<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\sale\SalCashRegisterTransaction;

class SalCashRegister extends Model
{
    use HasFactory;
    protected $table = "sal_cash_registers";
    protected $primaryKey = "id";
    protected $fillable = [
        'company_id',
'user_id',
'location_id',
'status',
'closed_at',
'closing_amount',
'total_card_slips',
'total_cheques',
'closing_note',
    ];


    public function openRegsiter(int|string $openRegisterAmount){ // return last insert id of cash reg
        
        $cashRegisterId =  DB::table('sal_cash_registers')->insertGetId([
            'company_id' =>session()->get('company_id'),
            'user_id' =>session()->get('user_id'),
            'status' =>'open',
            'closing_amount'=>$openRegisterAmount,
            'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),
          ]);
          if($cashRegisterId){
            return $cashRegisterId;

          }
    
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(SalCashRegisterTransaction::class,'cash_register_id','id');
    }


public function scopeDataFilter($query,$from_date = null,$to_date=null){
    if(!empty($from_date)){
        $from_date = date('Y-m-d 00:00:01',strtotime($from_date));
        $to_date = (!empty($to_date)) ? date('Y-m-d 23:59:59',strtotime($to_date)) :date('Y-m-d 23:59:59');
        $query->whereBetween('created_at',[$from_date,$to_date]);

    }
    return $query;

}


}
